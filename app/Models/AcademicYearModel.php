<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYearModel extends Model
{
    use HasFactory;

    protected $table = 'academic_year';
    protected $fillable = [
        'year',
    ];
}
