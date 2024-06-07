<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_id';
    protected $table = "events";
    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'event_name',
        'description',
        'image',
    ];
}
