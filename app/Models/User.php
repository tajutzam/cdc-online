<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable;
    use Uuids;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'ttl',
        'nik',
        'no_telp',
        'foto',
        'linkedin',
        'twiter',
        'instagram',
        'facebook',
        'level',
        'token',
        'visible_email',
        'visible_nik',
        'visible_ttl',
        'visible_no_telp',
        'alamat',
        'visible_fullname',
        'gender',
        'about',
        'email_verivied',
        'expire_email',
        'account_status',
        'kode_prodi',
        'nim',
        'state_quisioner',
        'fcm_token',
        'longtitude',
        'latitude'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];


    protected $table = 'users';

    protected $hidden = [
        'password'
    ];

    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    public function educations()
    {
        return $this->hasMany(Education::class, "user_id");
    }

    public function jobs()
    {
        return $this->hasMany(Jobs::class, "user_id");
    }

    public function followed()
    {
        return $this->hasMany(Followed::class, 'folowed_id');

    }

    public function post()
    {
        return $this->hasMany(Post::class, 'user_id');
    }


    public function prodi()
    {
        return $this->belongsTo(QuisionerProdi::class, 'kode_prodi');
    }


    public function quisioners()
    {
        return $this->hasMany(QuisionerLevel::class, "user_id");
    }

    public function identity_quisioner()
    {
        return $this->hasMany(Identity::class, 'user_id');
    }

    public function main_quisioner()
    {
        return $this->hasMany(MainSection::class, "user_id");
    }

    public function furthe_study_quisioner()
    {
        return $this->hasMany(FurtheStudy::class, "user_id");
    }



    public function competence()
    {
        return $this->hasMany(Competence::class, "user_id");
    }

    public function study_method()
    {
        return $this->hasMany(StudyMethod::class, "user_id");
    }

    public function jobStreet()
    {
        return $this->hasMany(StartSearchJob::class, "user_id");
    }

    public function howToFindJobs()
    {
        return $this->hasMany(HowFindJob::class, "user_id");
    }

    public function companyApplied()
    {
        return $this->hasMany(CompanyApplied::class, "user_id");
    }

    public function jobSuitability()
    {
        return $this->hasMany(JobSuitability::class, "user_id");
    }


    public function quisioner_level(){
        return $this->hasMany(QuisionerLevel::class, "user_id");

    }



}