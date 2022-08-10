<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
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
    
    public function customer() {
        return $this->belongsTo(Customer::class, 'id');
    }

}
