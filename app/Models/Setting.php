<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table ='settings';

    protected $fillable=[
        'title',
        'logo',
        'phone',
        'terms',
        'privacy',
        'facebook',
        'youtube',
        'linkedin',
        'instagram',
        'twitter',
        'whatsapp',
    ];

    public $timestamps = false;

}
