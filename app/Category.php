<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    protected $fillable = [
        'id', 'name', 'status'
    ];

    protected $table = 'category';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
