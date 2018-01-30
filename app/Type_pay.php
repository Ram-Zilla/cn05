<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Type_pay extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'type_pay';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;

    static public function get_type_pay(){
        $type_pay = Type_pay::where('status', 1)->get();
        return $type_pay;
    }
}
