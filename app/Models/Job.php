<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Job extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'jobs';

    protected $guarded = [];

    public function getExpiresAtAttribute() {
        return (new Carbon($this->expiration_at))->format('Y-m-d');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'emp_type_id', 'id');
    }

    public function experienceLevel()
    {
        return $this->belongsTo(JobExperienceLevel::class, 'experience_level_id', 'id');
    }
}
