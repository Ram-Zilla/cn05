<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Main extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'id_flat',
        'info_home',
        'exclusive_of',
        'comments',
        'date_booked',
        'who_booked',
        'access',
        'key_flat',
        'date_create',
        'date_create_unix',
        'prepayment',
        'responsible',
        'documents',
        'repairs',
        'lay_out',
        'position',
        'type_pay',
        'type_object',
        'material',
        'photos',
        'video',
        'type_house',
        'address',
        'price_quality',
        'fill_info',
        'more_info',
        'type_flats',
        'personal_information',
        'archive',
    ];

    protected $table = 'main';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
