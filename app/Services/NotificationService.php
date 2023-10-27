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

        $dataUser = $this->user->with([
            'quisioners' => function ($query) {
                $query->orderBy('created_at', 'desc')->first(); // This retrieves the first item
            },
            'prodi'
        ])->where('account_status', 0)->get();

        $data = collect($dataUser)->map(function ($user) {
            if (sizeof($user['quisioners']) > 0) {
                if (Carbon::now()->isBefore($user['quisioners'][0]['expired'])) { // get first quisioner
                    $temp = $this->castToUserResponseFromArray($user);
                    $countTrueAttributes = 0;

                    $attributes = [
                        'identitas_section',
                        'main_section',
                        'furthe_study_section',
                        'competent_level_section',
                        'study_method_section',
                        'jobs_street_section',
                        'how_find_jobs_section',
                        'company_applied_section',
                        'job_suitability_section',
                    ];

                    foreach ($attributes as $attribute) {
                        if ($user['quisioners'][0][$attribute] == 1) {
                            $countTrueAttributes++;
                        }
                    }
                    $temp['status_quisioner'] = $user['quisioners'][0]['level'] . " Bulan";

                    $temp['presentasi'] = $countTrueAttributes;
                    return $temp;
                }
            } else {
                $temp = $this->castToUserResponseFromArray($user);
                $temp['presentasi'] = 0;
                $temp['status_quisioner'] = '0 Bulan';
                return $temp;
            }
        })->toArray();

        return $data;
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