<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertifyModel extends Model
{
    use HasFactory;

    protected $table = 'ccertify';
    protected $fillable = [
        'student',
        'studying_in',
    ];
}
