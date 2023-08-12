<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralReceiptModel extends Model
{
    use HasFactory;
    protected $table = 'general_receipt';
    protected $fillable = [
        "date",
        "amount",
        "year",
        "cause",
    ];
}
