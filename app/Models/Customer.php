<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected  $fillable = [
        'first_name', 'last_name', 'phone_number', 'email', 'name', 'password', 'status', 'isVerified', 'profile_photo'
        ];

    protected static function boot()  {
        parent::boot();
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) \Str::uuid();
        });
    }

    public function orders() {
        return $this->hasMany(Order::class, 'id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
