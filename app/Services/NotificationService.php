<?php


namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Notifications;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationService
{


    private User $user;
    private $messaging;

    private Notifications $notifications;

    public function __construct()
    {
        $this->user = new User();
        $serviceAccountPath = storage_path(env('FIREBASE_CREDENTIALS'));

        $factory = (new Factory)
            ->withServiceAccount($serviceAccountPath);

        $this->messaging = $factory->createMessaging();
        $this->notifications = new Notifications();
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

    public function sendNotificationQuisioner($data)
    {
        DB::beginTransaction();
        foreach ($data as $value) {
            $user = $this->user->where('id', $value->id)->first();
            # code...
            if (isset($value->fcm_token)) {
                try {
                    $user->update([
                        'account_status' => false
                    ]);
                    //code...
                    $messageBody = 'Halo, Silahkan Mengisi Quisioner Kemajuan Quisioner Sekarang ' . $value->presentasi . "/9";
                    $message = CloudMessage::new()
                        ->withTarget('token', $value->fcm_token) // Replace with the recipient's FCM token
                        ->withNotification([
                            'title' => 'Quisioner',
                            'body' => $messageBody,
                        ])
                        ->withData(['type' => 'quisioner']);
                    $this->messaging->send($message);
                    $created = $this->notifications->create(
                        [
                            'type' => 'quisioner',
                            'user_id' => $value->id,
                            'message' => $messageBody,
                            'id_body' => null
                        ]
                    );
                    if (isset($created)) {
                        Db::commit();
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    throw new WebException($th->getMessage());
                }
            }
        }
    }


    public function sendNotificationsNews($title, $idNews)
    {
        try {
            //code...
            $message = CloudMessage::new()
                ->withTarget('topic', 'all') // Replace with the recipient's FCM token
                ->withNotification([
                    'title' => 'Ada Berita Baru Nih !',
                    'body' => $title,
                ])
                ->withData(['type' => 'news']);
            $this->messaging->send($message);
            $users = $this->user->all()->toArray();
            foreach ($users as $value) {
                # code...
                $created = $this->notifications->create(
                    [
                        'type' => 'news',
                        'user_id' => $value['id'],    
                        'message' => $title,
                        'id_body' => $idNews
                    ]
                );
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


    public function findAllNotificationsUser($id)
    {
        $data = $this->user->with('notifications')->where('id', $id)->get()->collect()->map(function ($user) {
            return $this->castToUser($user);
        })->first();
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

    public function castToUser($user)
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
            'account_status' => $user['account_status'],
            'notifications' => $user['notifications']->toArray()
        ];
    }
}