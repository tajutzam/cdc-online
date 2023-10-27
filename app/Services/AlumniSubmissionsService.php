<?php


namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Alumni;
use App\Models\AlumniSubmissions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AlumniSubmissionsService
{
    private AlumniSubmissions $alumniSubmissions;
    private EmailService $emailService;

    private AlumniService $alumniService;

    public function __construct()
    {
        $this->alumniSubmissions = new AlumniSubmissions();
        $this->emailService = new EmailService();
        $this->alumniService = new AlumniService();
    }


    public function showSubmissions()
    {
        return $this->alumniSubmissions->all()->collect()->map(function ($submission) {
            return $this->castToResponse($submission);
        })->toArray();
    }

    public function submit($request, $image)
    {
        $folder = "alumni/submissions";
        $fileName = time() . '.' . $image->extension();
        $urlResource = $image->move($folder, $fileName);

        if (isset($urlResource)) {
            DB::beginTransaction();
            $created = $this->alumniSubmissions->create([
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
                'ijazah' => $fileName,
            ]);
            if ($created) {
                Db::commit();
                $response = [];
                $response['data'] = $this->castToResponse($created);
                $response['status'] = true;
                $response['code'] = 200;
                $response['message'] = 'success mengirim pengajuan';
                return $response;
            }
        }
    }


    private function castToResponse($submissons)
    {

        $url = url('/') . "/alumni/submissions/" . $submissons['ijazah'];

        return [
            'id' => $submissons['id'],
            'alamat_domisili' => $submissons['alamat_domisili'],
            'angkatan' => $submissons['angkatan'],
            'email' => $submissons['email'],
            'jenis_kelamin' => $submissons['jenis_kelamin'],
            'jurusan' => $submissons['jurusan'],
            'nama_lengkap' => $submissons['nama_lengkap'],
            'nim' => $submissons['nim'],
            'no_telp' => $submissons['no_telp'],
            'program_studi' => $submissons['program_studi'],
            'tahun_lulus' => $submissons['tahun_lulus'],
            'tanggal_lahir' => $submissons['tanggal_lahir'],
            'tempat_lahir' => $submissons['tempat_lahir'],
            'ijazah' => $url,

        ];
    }



    public function accOrReject($case, $id)
    {

        $alumniSubmissions = $this->alumniSubmissions->where('id', $id)->first();
        try {
            //code...
            if (!isset($alumniSubmissions)) {
                throw new WebException('ops , pengajuan alumni tidak ditemukan');
            }
            if ($case == 'acc') {
                $data = $alumniSubmissions->toArray();
                $created = $this->alumniService->createAlumni($data);
                if ($created) {
                    $this->emailService->sendEmailSubmissions($alumniSubmissions->email, '<p>NIM Anda sekarang aktif dan dapat digunakan. .</p>
                    <p>Langkah-langkah untuk memulai:</p>
                    <ol>
                        <li>Silahkan Buka Applikasi CDC kami.</li>
                
                        <li>Masuk ke dalam registrasi akun.</li>
                
                        <li>Masukan NIM untuk verifikasi ulang.</li>
                
                        <li>Buat Akun: Setelah tautan verifikasi diklik, Anda akan diarahkan ke halaman pendaftaran aplikasi CDC. Silakan lengkapi informasi yang diperlukan, seperti nama pengguna dan kata sandi, untuk membuat akun.</li>
                
                        <li>Selesaikan Pendaftaran: Ikuti langkah-langkah pendaftaran yang diberikan di aplikasi CDC untuk menyelesaikan proses pendaftaran.</li>
                    </ol>
                
                    <p>Setelah Anda berhasil mendaftar dan masuk ke dalam aplikasi CDC, Anda akan dapat mengakses semua layanan dan fitur yang kami sediakan. Jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut, tim dukungan pelanggan kami siap membantu.</p>
                
                    <p>Selamat menggunakan aplikasi CDC kami!</p>');
                    $alumniSubmissions->delete();
                    return [
                        'status' => true,
                        'message' => 'success menerima pengajuan alumni',
                        'case' => 'acc'
                    ];
                } else {
                    throw new WebException('ops , gagal menambahkan alumni');
                }
            } else {
                $email = $alumniSubmissions->email;
                $isDeleted = $alumniSubmissions->delete();
                if ($isDeleted) {
                    $this->emailService->sendEmailSubmissions($email, ' <p><strong>Kepada yang Terhormat,</strong></p>
    
                    <p>Kami sangat menghargai minat Anda dalam mengakses data alumni kami. Namun, saat ini kami tidak dapat memenuhi permohonan tersebut karena alasan tertentu. Mohon maaf atas ketidaknyamanan ini.</p>
                
                    <p>Kami selalu berusaha untuk melindungi privasi dan informasi pribadi alumni kami. Kami berkomitmen untuk menjaga kepercayaan alumni kami serta mengikuti semua hukum dan peraturan yang berlaku terkait dengan privasi data.</p>
                
                    <p>Terima kasih atas pemahaman Anda dan terima kasih telah menghubungi kami.</p>
                
                    <p><strong>Salam hormat,</strong><br>
                        <em>CDC ONLINE</em></p>
                    ');
                    return [
                        'status' => true,
                        'message' => 'success menolak pengajuan alumni',
                        'case' => 'reject'
                    ];
                } else {
                    throw new WebException('ops , gagal menolak pengajuan alumni terjadi kesalahan');
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }



    


    public function findAllAlumniReference(){
        return $this->alumniSubmissions->all();
    }

}