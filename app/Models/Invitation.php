<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable=[
        'date',
        'title',
        'image',
        'has_barcode',
        'barcode',
        'send_date',
        'address',
        'longitude',
        'latitude',
        'password',
        'user_id',
        'status',
    ];

}
