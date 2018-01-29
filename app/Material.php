<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Material extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'material';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
