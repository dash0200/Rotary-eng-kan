<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubdistrictModel extends Model
{
    use HasFactory;

    protected $table = 'sub_district';
    protected $fillable = [
        'name', 'district'
    ];

    public function state() {
        return $this->hasOne(DistrictModel::class, 'id', 'district');
    }
}
