<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterModel extends Model
{
    use HasFactory;

    protected $table = "ccharacter";

    protected $fillable = [
        "student",
        "studied_from",
        "studied_to",
        "year_from",
        "year_to",
    ];
    public function studentDetails() {
        return $this->hasOne(AdmissionModel::class, 'id', 'student')->withTrashed();
    }
}
