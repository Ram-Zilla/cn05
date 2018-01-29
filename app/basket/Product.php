<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;

    protected $fillable = [
        'id', 'id_material', 'id_category', 'name', 'description', 'photo', 'price', 'size', 'guarantees',  'date', 'status', 'popular', 'recommended'
    ];

    protected $table = 'products';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(\App\Category::class, 'id_category');
    }

    public function material(){
        return $this->belongsTo(\App\Category::class, 'id_material');
    }
}
