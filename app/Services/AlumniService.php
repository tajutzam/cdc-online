<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\WebException;
use App\Models\Alumni;
use App\Models\AlumniSubmissions;
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
            try {
                //code...
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
                        $success = false;
                        throw new WebException($e->getMessage());
                    }
                } else {
                    throw new WebException('Terjadi kesalahan pada Api Referensi');
                }
            } catch (Throwable $th) {
                //throw $th;
                throw new WebException($th->getMessage());
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

        try {
            //code...
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
        } catch (Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
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


    public function verivicationUser($request){
        $alumni = $this->alumni->where('nim', $request['nim'])->orWhere('email', $request['email'])->first();
        if(!isset($alumni)){
            throw new BadRequestException("Ops, Nampaknya Data Yaang Kamu berikan bukanlah alumni dari Politeknik Negeri Jember silahkan ajukan data alumni pada menu yang sudah ditentukan");
        }
        return $alumni; 
    }


    public function getCountPerDay()
    {

        $data = [];
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        while ($startDate <= $endDate) {
            $count = $this->alumni
                ->whereDate('created_at', $startDate->toDateString())
                ->count();

            $data[$startDate->format('Y-m-d')] = $count;

            $startDate->addDay();
        }
        return $data;
    }

    public function getTotalAdditionOneWeek()
    {
        $endDate = Carbon::now(); // Current date and time
        $startDate = $endDate->copy()->startOfWeek(); // Start of the current week (Monday)
        $endDate = $endDate->copy()->endOfWeek(); // End of the current week (Saturday)

        // Query to count alumni added within the current week
        $countNewAlumni = $this->alumni
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return $countNewAlumni;
    }



}