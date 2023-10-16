<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scanned extends Model
{
    use HasFactory;
    protected $fillable=[
        'invitation_id',
        'invitee_id',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function invitee(){
        return $this->belongsTo(Invitee::class);
    }

}
