<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';
    protected $table = "customer";
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phoneNo',
        'password',
    ];
}