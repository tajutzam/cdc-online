<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\WebException;
use App\Models\Alumni;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class AlumniService
{



    private Alumni $alumni;

    public function __construct()
    {
        $this->alumni = new Alumni();
    }



    public function updateDataAlumni()
    {
        $nowDate = Carbon::now();
        $nowYears = $nowDate->year;

        $interval = $nowYears - 3; // get 3 tahun terakhir
        $success = false;
        Alumni::truncate(); // delete data before update
        while ($interval != $nowYears) {
            $responseToken = $this->generateToken();
            $header = [
                'Authorization' => 'Bearer ' . $responseToken->access_token,
                'Accept' => 'application/json',
                'User-Agent' => '/Postman/i'
            ];
            $response = Http::withHeaders($header)->timeout(200)->get('http://api.polije.ac.id/resources/akademik/mahasiswa/wisuda', [
                'debug' => true,
                'tahun_lulus' => $interval
            ]);
            if ($response->successful()) {
                $data = $response->json();
                DB::beginTransaction();
                try {
                    $data = $response->json();
                    foreach ($data as $key => $value) {
                        # code...
                        $data[$key]['id'] = Str::uuid()->toString();
                    }
                    $created = Alumni::insert($data);
                    if ($created) {
                        DB::commit();
                        $interval++;
                        $success = true;
                    }
                } catch (Throwable $e) {
                    dd($e->getMessage());
                    $success = false;
                    throw new WebException($e->getMessage());
                }
            } else {
                throw new WebException('ngen');
            }
        }
        if ($success) {
            return true;
        } else {
            throw new WebException('gagal mengupdate data alumni');
        }
    }


    private function generateToken()
    {

        $grant_type = env('TOKEN_API_GRANT_TYPE');
        $client_id = env('TOKEN_API_CLIENT_ID');
        $client_secreet = env('TOKEN_API_CLIENT_SCREET');

        if (!isset($grant_type) || !isset($client_id) || !isset($client_secreet)) {
            throw new Exception('ops , your env not included the token');
        }

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'http://api.polije.ac.id/oauth/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('grant_type' => $grant_type, 'client_id' => $client_id, 'client_secret' => $client_secreet),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }


    public function verifikasiNimOrEmail($request)
    {
        $alumni = $this->alumni->where('nim', $request['key'])->orWhere('email', $request['key'])->first();

        if (isset($alumni)) {
            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success verifikasi nim',
                'data' => $alumni->toArray()
            ];
        } else {
            throw new BadRequestException(
                'ops , data nim atau email kamu tidak ditemukan silahkan ajukan pengajuan data alumni'
            );
        }
    }


    public function createAlumni($request)
    {
        $created = $this->alumni->create([
            'id' => Str::uuid()->toString(),
            'alamat_domisili' => $request['alamat_domisili'],
            'angkatan' => $request['angkatan'],
            'email' => $request['email'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'jurusan' => $request['jurusan'],
            'nama_lengkap' => $request['nama_lengkap'],
            'nim' => $request['nim'],
            'no_telp' => $request['no_telp'],
            'program_studi' => $request['program_studi'],
            'tahun_lulus' => $request['tahun_lulus'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'tempat_lahir' => $request['tempat_lahir'],
            'rowrank' => "9",
        ]);
        if ($created) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllAlumni()
    {
        return $this->alumni->all();
    }

}