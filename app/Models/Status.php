<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type',
        'invitation_id',
        'invitee_id',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitatio_id', 'id');
    }

    public function invitee()
    {
        return $this->belongsTo(Invitee::class, 'invitee_id', 'id');
    }
}
