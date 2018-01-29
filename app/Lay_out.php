<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lay_out extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'lay_out';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
