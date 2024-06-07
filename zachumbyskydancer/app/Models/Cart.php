<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'cart_id';
    protected $table = "cart";
    public $timestamps = false;

    protected $fillable = [
        'cart_id',
        'customer_id',
        'menu_id',
        'quanti',
        'price',
        'image',
        'status',
    ];
}
