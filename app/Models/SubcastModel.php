<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcastModel extends Model
{
    use HasFactory;

    protected $table = 'sub_caste';
    protected $fillable = [
        'caste','name'
    ];
}
