<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        'customer_id',
        'company_id',
        'rider_id',
        'orderCode',
        'total',
        'shipping_charge',
        'discount',
        'rider-assigned',
        'company_accepted',
        'payment_status',
        'delivery_status',
    ];

}
