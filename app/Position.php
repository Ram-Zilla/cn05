<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Position extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'position';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;

    static public function get_position(){
        $position = Position::where('status', 1)->get();
        return $position;
    }
}
