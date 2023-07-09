<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'body',
        'invitee_id',
        'invitation_id',
        'user_id',
        'image',
        'type',
    ];

}
