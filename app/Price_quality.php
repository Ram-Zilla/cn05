<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Price_quality extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'price_quality';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
