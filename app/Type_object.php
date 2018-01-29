<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Type_object extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'type_object';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
