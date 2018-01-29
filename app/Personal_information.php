<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Personal_information extends Model
{
    use Notifiable;

    protected $fillable = [
        'id',
        'phone',
        'more_phone',
        'name_agent',
        'phone_agent',
        'date_recall',
        'name',
    ];

    protected $table = 'personal_information';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
}
