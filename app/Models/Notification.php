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
        'invitation_id',
        'user_id',
        'image',
        'type',
    ];


    protected $casts = [
        'user_id' => 'json',
    ];

    ##  Mutators and Accessors
    public function getImageAttribute()
    {
        return isset($this->attributes['image']) ? get_file($this->attributes['image']) : "";
    }


}
