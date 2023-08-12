<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LCModel extends Model
{
    use HasFactory;

    protected $table = "lc";

    protected $fillable = [
        "student",
        "studied_till",
        "till_aca_year",
        "was_studying",
        "whether_qualified",
        "lt",
        "doa",
        "doil",
        "reason",
    ];

    public function studentDetails() {
        return $this->hasOne(AdmissionModel::class, 'id', 'student')->withTrashed();
    }

    public function studiedTill() {
        return $this->hasOne(AcademicYearModel::class, 'id', 'studied_till');
    }

    public function tillYear() {
        return $this->hasOne(AcademicYearModel::class, 'id', 'till_aca_year');
    }

}
