<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table = "manager";
    public $timestamps = false;
    protected $primaryKey = 'manager_id';

    protected $fillable = [
        'manager_id',
        'name',
        'email',
        'phoneNo',
        'password',
    ];
}
