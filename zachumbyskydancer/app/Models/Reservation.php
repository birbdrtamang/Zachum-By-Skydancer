<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $primaryKey = 'reservation_id';
    protected $table = "reservation";
    public $timestamps = false;

    protected $fillable = [
        'reservation_id',
        'customer_id',
        'date',
        'time',
        'description',
    ];
}
