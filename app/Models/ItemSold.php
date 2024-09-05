<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSold extends Model
{
    use HasFactory;

    protected $table = "item_solds";
    public $timestamps = false;
    protected $fillable = [
        "transactionId",
        "productCode",
        "isPaid"
    ];
}
