<?php

namespace App\Services;

use App\Models\PasswordReset;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordResetService
{

    private PasswordReset $passwordReset;


    public function __construct()
    {
        $this->passwordReset = new PasswordReset();
    }


    public function save($email, $userId)
    {
        $expired = Carbon::now()->addHour();
        try {
            //code...
            Db::beginTransaction();
            $created = $this->passwordReset->create([
                'user_id' => $userId,
                'email' => $email,
                'expire' => $expired,
                'token' => Str::random(100)
            ]);
            if (isset($created)) {
                DB::commit();
                return $created;
            }
            throw new Exception('Ops , Gagal Membuat Token');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function findByToken($token)
    {

        $passwordReset = $this->passwordReset->where('token', $token)->first();

        Db::beginTransaction();
        if (isset($passwordReset)) {
            $now = Carbon::now();
            $expired = Carbon::parse($passwordReset->expire);
            if ($now->isAfter($expired)) {
                $passwordReset->delete();
                Db::commit();
                throw new NotFoundHttpException("Ops , Token kamu sudah tidak valid silahkan lakukan reset password ulang");
            }
            return $passwordReset;
        }
        throw new NotFoundHttpException("Ops , Url Reset Password Kamu tidak valid");
    }

    public function delete($token)
    {
        $passwordReset = $this->passwordReset->where('token', $token)->first();
        Db::beginTransaction();
        if (isset($passwordReset)) {
            $passwordReset->delete();
            Db::commit();
        }
    }

}