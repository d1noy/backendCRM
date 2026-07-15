<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'price',
        'webhook_url',
        'status'
    ];
    public function getRouteKeyName(): string
    {
        return 'order_id';
    }
}
