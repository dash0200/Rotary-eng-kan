<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasteCertificateModel extends Model
{
    use HasFactory;
    protected $table = 'ccaste';
    protected $fillable = [
        'student','studying_in'
    ];
}
