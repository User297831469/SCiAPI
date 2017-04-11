<?php

/**
 * Created by PhpStorm.
 * User: marcusedwards
 * Date: 2017-04-07
 * Time: 12:24 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    protected $table = "widgets";

    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
}