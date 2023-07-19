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

    // protected $casts = [
    //     'title' => 'array'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    ##  Mutators and Accessors
    public function getImageAttribute()
    {
        return isset($this->attributes['image']) ? get_file($this->attributes['image']) : "";
    }

    public function invitees(){
        return $this->hasMany(Invitee::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }


    public function scanned(){
        return $this->hasMany(Scanned::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany if status = 2
     */
    public function confirmed(){
        return $this->hasMany(Invitee::class)->where(['status'=> 2]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany if status = 3
     */
    public function apologized(){
        return $this->hasMany(Invitee::class)->where(['status'=> 3]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany if status = 1
     */
    public function waiting(){
        return $this->hasMany(Invitee::class)->where(['status'=> 1]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany if status = 4
     */
    public function not_sent(){
        return $this->hasMany(Invitee::class)->where(['status'=> 4]);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany if status = 5
     */

    public function failed(){
        return $this->hasMany(Invitee::class)->where(['status'=> 5]);
    }

    public function not_sent_whatsapp(){
        return $this->hasMany(Status::class)->where(['status'=> 1, 'type' => 'whatsapp']);
    }

    public function received_whatsapp(){
        return $this->hasMany(Status::class)->where(['status'=> 2, 'type' => 'whatsapp']);
    }

    public function readIt_whatsapp(){
        return $this->hasMany(Status::class)->where(['status'=> 3, 'type' => 'whatsapp']);
    }

    public function faild_whatsapp(){
        return $this->hasMany(Status::class)->where(['status'=> 4, 'type' => 'whatsapp']);
    }
    public function not_received_qr(){
        return $this->hasMany(Status::class)->where(['status'=> 1, 'type' => 'qr_code']);
    }

    public function received_qr(){
        return $this->hasMany(Status::class)->where(['status'=> 2, 'type' => 'qr_code']);
    }

    public function read_it_qr(){
        return $this->hasMany(Status::class)->where(['status'=> 3, 'type' => 'qr_code']);
    }

    public function faild_qr(){
        return $this->hasMany(Status::class)->where(['status'=> 4, 'type' => 'qr_code']);
    }
}
