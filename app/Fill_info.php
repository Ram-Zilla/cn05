<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Fill_info extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'fill_info';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}