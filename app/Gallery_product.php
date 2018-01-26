<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Gallery_product extends Model
{
    use Notifiable;

    protected $fillable = [
        'id', 'id_product', 'photo', 'status'
    ];

    protected $table = 'gallery_product';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;

}
