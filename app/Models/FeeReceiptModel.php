<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeReceiptModel extends Model
{
    use HasFactory;

    protected $table = "fee_receipt";

    protected $dates = ['created_at'];

    protected $fillable = [
            "student",
            "amt_paid",
            "receipt_no",
            "year",
            "class",
            "created_at"
    ];

    public function studentDetail() {
        return $this->hasOne(AdmissionModel::class, 'id', 'student')->withTrashed();
    }

    public function classes() {
        return $this->hasOne(ClassesModel::class, 'id', 'class');
    }

    public function years() {
        return $this->hasOne(AcademicYearModel::class, 'id', 'year');
    }
}
