<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesDetailsModel extends Model
{
    use HasFactory;

    protected $table = 'fees_details';
    protected $fillable = [
        'year','fee_head','class','tuition','amount','amt_per_annum'
    ];

    public function feeHead() {
        return $this->hasOne(FeesHeadModel::class, 'id', 'fee_head');
    }
}
