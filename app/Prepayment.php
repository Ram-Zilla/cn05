<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prepayment extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'prepayment';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
