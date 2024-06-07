<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $table = "orders";
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'order_date',
        'customer_id',
        'payment_id',
        'contactNo',
        'customer_address',
        'additional_notes',
        'item_ids',
        'order_status',
    ];
}
