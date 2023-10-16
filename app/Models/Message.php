<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;
    protected $fillable=[
        'invitation_id',
        'invitee_id',
        'title',
        'message',
    ];


    public function invitee(): BelongsTo{
        return $this->belongsTo(Invitee::class,'invitee_id','id');
    }

}
