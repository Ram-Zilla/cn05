<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_home extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'flat',
        'floor',
        'house',
        'area',
        'green_area',
        'total_area',
        'count_balcony',
        'host_price',
        'price',
        'price_one_area',
        'furniture',
        'area_house',
        'area_yard',
        'description_client',
        'description_workers',
    ];

    protected $table = 'info_home';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
