<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuisionerLevel extends Model
{
    use HasFactory;

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
    ];

    protected $primaryKey = 'id';

}