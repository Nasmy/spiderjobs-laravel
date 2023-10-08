<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperienceLevel extends Model
{
    use HasFactory;

    protected $table = 'experience_levels';

    protected $fillable = ['name', 'ident', 'description'];

}
