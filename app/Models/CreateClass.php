<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateClass extends Model
{
    use HasFactory;

    protected $table = "create_class";
    protected $fillable = [
            "year",
            "standard",
            "student",
            "total",
            "paid",
            "balance",
    ];

    public function getStudent() {
        return $this->hasOne(AdmissionModel::class, 'id', 'student')->withTrashed();
    }

    public function acaYear() {
        return $this->hasOne(AcademicYearModel::class, 'id', 'year');
    }

    public function standardClass() {
        return $this->hasOne(ClassesModel::class, 'id', 'standard');
    }

}
