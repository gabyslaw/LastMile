<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "phone_number",
        "email",
        "location",
        "longitude",
        "latitude",
        "isVerified",
        "r_status",
        "status",
        "password",
        "city",
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()  {
        parent::boot();
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) \Str::uuid();
        });
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'id');
    }
}
