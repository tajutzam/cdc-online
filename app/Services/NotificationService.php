<?php


namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Notifications;
use App\Models\PaketKuesioner;
use App\Models\QuesionerAnswerDetail;
use App\Models\QuisionerLevel;
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


    public function findAllUserNeedNotifications() //todo
    {
        $data = [];
        //1. cek user dengan table kuesioner 
        $userQuesioner = User::with('prodi','alumni', 'answer_detail', 'answer_detail.paket')->get();
  
        foreach ($userQuesioner as $key => $value) {
            // $data[$key] = $value;
            if (isset($value->answer_detail)) {
                // //1. jika ada kuesionernya maka, cek kesionernya sudah boleh mengisi atau tidak, jika sudha boleh mengisi ambil data
                    foreach ($value->answer_detail as $key1 => $value1) {
                        //keluarkan semua anser detail milik user
                        if (isset($value1->id_paket_kuesioner)) {
                            //apakah ada datanya?
                            $bolehMengisi = $this->cekStatusKuesionerUser($value->id, $value1->id_paket_kuesioner);

                            //cek satus boleh mengisi atau tidak, jika 1 sudah boleh mengisi lagi
                            if ($bolehMengisi == 1) {
                                //tampilkan data yang sudah saatnya mengisi lagi?
                                $data[$key1]["users"] = $value;
                                $data[$key1]["quesioner_name"] = $value1->paket->judul;
                                $data[$key1]["level"] = $value1->level;
                            }
                        // $data[$key1]["users"] = $value;
                        // $data[$key1]["quesioner_name"] = $value1->paket->judul;
                        // $data[$key1]["level"] = $value1->level;
                        }
                    }
            }
        }

        return $data;
    }

    public function findAllUpdateNotification()
    {

        $data = QuisionerLevel::select('user_id', DB::raw('MAX(id) as max_id'))
            ->where('expired', '<', Carbon::now())
            ->where('not_fillable_again', true)
            ->groupBy('user_id')
            ->get();

        // Retrieve the full records based on the maximum id for each user
        $records = QuisionerLevel::whereIn('id', $data->pluck('max_id')->toArray())
            ->where('expired', '<', Carbon::now())
            ->get();
        foreach ($records as $key => $value) {
            # code...
            $user = User::where('id', $value->user_id)->first();
            $user->account_status = 0;
            $user->required_to_fill = 1;
            $user->save();
            Db::commit();
            try {
                $messageBody = 'Silahkan mengisi Quisioner untuk memperbarui status akun kamu ya';

                $message = CloudMessage::new()
                    ->withTarget('token', $user->fcm_token) // Replace with the recipient's FCM token
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
                return true;
            } catch (\Throwable $th) {
                //throw $th;
                // throw new WebException($th->getMessage());
            }
        }

    }



    public function sendNotificationQuisioner($data)
    {
        Db::beginTransaction();
        foreach ($data as $key => $value) {
            $user = $this->user->where('id', $value->users->id)->first();
            # code...
            if (isset($value->users->fcm_token)) {
                try {
                    $user->update([
                        'account_status' => false
                    ]);
                    Db::commit();

                    //code...
                    $messageBody = 'Halo, Sudah saatnya anda mengisi Kuesioner ' . $value->quesioner_name . "/9";

                    $message = CloudMessage::new()
                        ->withTarget('token', $value->users->fcm_token) // Replace with the recipient's FCM token
                        ->withNotification([
                            'title' => 'Quisioner',
                            'body' => $messageBody,
                        ])
                        ->withData(['type' => 'quisioner']);

                    $this->messaging->send($message);
                    $created = $this->notifications->create(
                        [
                            'type' => 'quisioner',
                            'user_id' => $value->users->id,
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
            } else {
                throw new WebException("Terdapat user tidak memiliki fcm token");
            }
        }
    }


    public function sendNotificationPost($user, $title, $body, $idPost)
    {
        if (!isset($user->fcm_token)) {
            throw new WebException("User Belum Mengupdate Fcm Token");
        }
        Db::beginTransaction();
        try {
            //code...
            $message = CloudMessage::new()
                ->withTarget('token', $user->fcm_token) // Replace with the recipient's FCM token
                ->withNotification([
                    'title' => $title,
                    'body' => $body,
                ])
                ->withData(['type' => 'news']);
            $this->messaging->send($message);
            $users = $this->user->all()->toArray();
            foreach ($users as $value) {
                # code...
                $created = $this->notifications->create(
                    [
                        'type' => 'post',
                        'user_id' => $value['id'],
                        'message' => $body,
                        'id_body' => $idPost
                    ]
                );
                if (isset($created)) {
                    Db::commit();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
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

    public function cekStatusKuesionerUser($user_id, $id_paket)
    {
        //status 1: boleh mengisi
        //status 2: tidak bisa mengisi

        $jenisQuesioner = PaketKuesioner::where('id', $id_paket)->first()->tipe;

        if ($jenisQuesioner == "Tracer Study") {
            //tracer study di isi 3 kali (bulan 1, bulan 6, bulan 12)
            //apakah sudah mengisi?
            $cekTracerStudy = QuesionerAnswerDetail::where('user_id', $user_id)
                ->where('id_paket_kuesioner', $id_paket)->count();
            if ($cekTracerStudy > 0) {
                //jika sudah
                if ($cekTracerStudy >= 3) {
                    //sudah mengisi 3 kali
                    $created_at_terakhir = QuesionerAnswerDetail::where('user_id', $user_id)
                        ->where('id_paket_kuesioner', $id_paket)->latest('id')->first()->created_at;
                    return 0;
                } else {
                    //baru mengisi 1 atau 2
                    //cek bulan pengisian terakhir, apakah jika ditambah 3 bulan sudah sama denga bulan sekarang
                    $created_at_terakhir = QuesionerAnswerDetail::where('user_id', $user_id)
                        ->where('id_paket_kuesioner', $id_paket)->latest('id')->first()->created_at;

                    $JadwalMengisi = Carbon::parse($created_at_terakhir)->addMonths(6);
                    $current_date_time = Carbon::now();
                    if ($current_date_time->gte($JadwalMengisi)) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
            } else {
                //jka belum
                //megnisi yang pertama
                return 1;
            }
        } else {
            //survey khsuus di isi 1 kali
            $cekSurveyKhusus = QuesionerAnswerDetail::where('user_id', $user_id)
                ->where('id_paket_kuesioner', $id_paket)->count();
            if ($cekSurveyKhusus < 1) {
                return 1;
            } else {
                return 0;
            }
        }
    }
}