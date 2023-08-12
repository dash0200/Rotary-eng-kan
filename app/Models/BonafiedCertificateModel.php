<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonafiedCertificateModel extends Model
{
    use HasFactory;

    protected $table = "cbonafied";

    protected $fillable = [
            "student",
            "studying_in",
            "year",
    ];

    public function studentDetails() {
        return $this->hasOne(AdmissionModel::class, 'id', 'student')->withTrashed();
    }
}
