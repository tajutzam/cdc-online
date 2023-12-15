<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuisionerLevel extends Model
{
    use HasFactory, Uuids;

    protected $table = 'quisioner_level';

    protected $fillable = [
        'user_id',
        'identitas_section',
        'main_section',
        'furthe_study_section',
        'competent_level_section',
        'study_method_section',
        'jobs_street_section',
        'how_find_jobs_section',
        'company_applied_section',
        'job_suitability_section',
        'level',
        'expired',
        'not_fillable_again'
    ];

    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function identity()
    {
        return $this->belongsTo(Identity::class, 'identitas_section');
    }

    public function main()
    {
        return $this->belongsTo(MainSection::class, 'main_section');
    }

    public function furthe_study()
    {
        return $this->belongsTo(FurtheStudy::class, 'furthe_study_section');
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class, 'competent_level_section');
    }

    public function studymethod()
    {
        return $this->belongsTo(StudyMethod::class, 'study_method_section');
    }

    public function startsearchjobs()
    {
        return $this->belongsTo(StartSearchJob::class, 'jobs_street_section');
    }

    public function howtofindjobs()
    {
        return $this->belongsTo(HowFindJob::class, 'how_find_jobs_section');
    }

    public function companyapplied()
    {
        return $this->belongsTo(CompanyApplied::class, 'company_applied_section');
    }

    public function jobsuitability()
    {
        return $this->belongsTo(JobSuitability::class, 'job_suitability_section');
    }

    // QuisionerLevel.php (Model)
    public function scopeAllColumnsFilledAndExpired($query)
    {
        $columnsToCheck = [
            'identitas_section',
            'main_section',
            'furthe_study_section',
            'competent_level_section',
            'study_method_section',
            'jobs_street_section',
            'how_find_jobs_section',
            'company_applied_section',
            'job_suitability_section',
            'id',
            'user_id'
        ];

        foreach ($columnsToCheck as $column) {
            $query->whereNotNull($column);
        }
        return $query->where('expired', '<', Carbon::now())->where('not_fillable_again', true)->groupBy('user_id');
    }




}