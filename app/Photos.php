<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Photos extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'photos';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
