<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
    use HasFactory;

    protected $fillable=[
        'invitation_id',
        'name',
        'phone',
        'invitees_number',
        'status',
    ];



    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitation_id', 'id');
    }

}
