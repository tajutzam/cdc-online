<?php


namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class NotificationService
{


    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }


    public function findAllUserNeedNotifications()
    {
        /*
        kriteria quisioner
        1. user belum mengisi quisioner , quisioner == null
        2. masa isi quisioner habis
        3, 
        */
        $relations = [
            "identitas_section",
            "main_section",
            "furthe_study_section",
            "competent_level_section",
            "study_method_section",
            "jobs_street_section",
            "how_find_jobs_section",
            "company_applied_section",
            "job_suitability_section"
        ];

        $dataUser = $this->user->with([
            'quisioner_level' => function ($query) {
                $query->orderBy('created_at', 'desc')->first(); // Ini mengambil item pertama
            },
            'prodi'
        ])->whereDoesntHave('quisioner_level') // Menambahkan kondisi: tidak memiliki quisioner_level
            ->orWhereHas('quisioner_level', function ($query) {
                $query->where('expired', '<', now()); // Menambahkan kondisi: masa expired quisioner_level habis
            })->get()->toArray();
        foreach ($dataUser as $key => $value) {
            # code...
            if (sizeof($value['quisioner_level']) == 0) {
                $dataUser[$key]['presentasi'] = 0;
                $dataUser[$key]['status_quisioner'] = false;
            } else {
                $countPresentasi = 0;
                foreach ($relations as $valueQuisioner) {
                    # code...
                    if (isset($value['quisioner_level'][0][$valueQuisioner])) {
                        $countPresentasi++;
                    }
                }
                $dataUser[$key]['presentasi'] = $countPresentasi;
            }
        }
        return $dataUser;
    }


    public function castToUserResponseFromArray($user)
    {

        $url = url('/') . "/users/" . $user['foto'];
        return [
            "id" => $user['id'],
            "fullname" => $user['visible_fullname'] == 1 ? $user['fullname'] : "***",
            "email" => $user['visible_email'] == 1 ? $user['email'] : "***",
            "nik" => $user['visible_nik'] == 1 ? $user['nik'] : "***",
            "no_telp" => $user['visible_no_telp'] == 1 ? $user['no_telp'] : "***",
            "foto" => $url,
            'ttl' => $user['ttl'],
            'alamat' => $user['visible_alamat'] == 1 ? $user['alamat'] : "***",
            "about" => $user['about'],
            "gender" => $user['gender'],
            "level" => $user['level'],
            'nim' => $user['nim'],
            "linkedin" => $user['linkedin'],
            "facebook" => $user['facebook'],
            "instagram" => $user['instagram'],
            'twiter' => $user['twiter'],
            'prodi' => $user['prodi'],
            'account_status' => $user['account_status'],
            'quisioner' => $user['quisioners']->toArray()
        ];
    }
}