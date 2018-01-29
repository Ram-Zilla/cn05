<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Furniture extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'furniture';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
