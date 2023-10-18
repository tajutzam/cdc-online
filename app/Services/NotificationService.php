<?php


namespace App\Services;

use App\Models\User;

class NotificationService
{


    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }


    public function findAllUserNeedNotifications()
    {
        $users = $this->user->with('quisioners', 'prodi')->get();
        $data = collect($users)->map(function ($user) {
            $dataUser = $this->castToUserResponseFromArray($user);
            $dataUser['status_quisioner'] = '0 bulan';
            $dataUser['presentasi'] = "0";
            $dataUser['all_quisioner'] = [];
            $dataUser['precent'] = 0;
            if (isset($user['quisioners'])) {
                if (sizeof($user['quisioners']) == 1) {
                    $dataUser['status_quisioner'] = '0  bulan';
                } else if (sizeof($user['quisioners']) == 2) {
                    $dataUser['status_quisioner'] = '6  bulan';
                } else if (sizeof($user['quisioners']) == 3) {
                    $dataUser['status_quisioner'] = '12 bulan';
                }
                $user['last_quisioner'] = $user['quisioners']->sortByDesc('created_at')->first();
                $dataUser['all_quisioner'] = $user['quisioners']->sortBy('created_at')->toArray();
                $trueCount = 0; // Inisialisasi count
                // Array atribut
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
                    if (isset($user['last_quisioner'])) {
                        if ($user['quisioners'][0][$attribute] == 1) {
                            $trueCount++;
                        }
                    }
                }
            }
            $dataUser['presentasi'] = $trueCount;
            return $dataUser;
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