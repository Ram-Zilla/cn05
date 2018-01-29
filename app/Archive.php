<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Archive extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'status',
        'cause',
        'date',
    ];

    protected $table = 'archive';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
