<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invitee extends Model
{
    use HasFactory;

    protected $fillable=[
        'invitation_id',
        'name',
        'phone',
        'email',
        'invitees_number',
        'status',
    ];



    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitation_id', 'id');
    }



}
