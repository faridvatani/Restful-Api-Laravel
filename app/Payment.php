<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'resnumber',
        'course_id',
        'price',
        'payment'
    ];
}
