<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';
    protected $table = "payment";
    public $timestamps = false;

    protected $fillable = [
        'payment_id',
        'customer_id',
        'grand_total',
        'Jrl_No',
        'payment_status',
        'payment_method',
        'date',
        'tax',
        'service_charge',
    ];
}
