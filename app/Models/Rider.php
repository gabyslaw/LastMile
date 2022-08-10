<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()  {
        parent::boot();
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) \Str::uuid();
        });
    }

    protected $fillable = [
        "riderCode",
        "first_name",
        "last_name",
        "email",
        "phone_number",
        "password",
        "vehicle_reg_number",
        "identity_card",
        "address",
        "status",
        "isVerified",
        "profile_photo",
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
