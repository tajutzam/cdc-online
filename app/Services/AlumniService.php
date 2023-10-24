<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\WebException;
use App\Models\Alumni;
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
        $responseToken = $this->generateToken();
        $header = [
            'Authorization' => 'Bearer ' . $responseToken->access_token,
            'Accept' => 'application/json',
            'User-Agent' => '/Postman/i'
        ];
        $response = Http::withHeaders($header)->get('http://api.polije.ac.id/resources/akademik/mahasiswa/wisuda', [
            'debug' => true,
        ]);
        if ($response->successful()) {
            $data = $response->json();
            Alumni::truncate();
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
                    return redirect()->back()->with('success', 'berhasil memperbarui data alumni referensi');
                }
            } catch (Throwable $e) {
                throw new WebException($e->getMessage());
            }
        }
        throw new WebException('');
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

    public function findAllAlumni()
    {
        return $this->alumni->all();
    }

}