<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyCertificate extends Model
{
    use HasFactory;

    protected $table = "cstudy";

    protected $fillable = [
            "student",
            "from_stdy",
            "to_stdy",
            "from_year",
            "to_year",
            "mother_lang",
            'cast',
            'subcast',
            'religion'
    ];

    public function studentDetails() {
        return $this->hasOne(AdmissionModel::class, 'id', 'student')->withTrashed();
    }
}
