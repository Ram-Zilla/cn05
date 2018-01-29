<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'city',
        'region',
        'territory',
        'district',
        'street',
        'maps_x',
        'maps_y',
        'home',
        'housing',
        'entrance',
        'apartment_number',
        'orientir',
    ];

    protected $table = 'address';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
