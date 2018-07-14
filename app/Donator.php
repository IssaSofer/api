<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    //
    protected $fillable = [
        'user_id', 'post_id', 
    ];


    public function post()
    {
    	return $this->belongTo('App\Posts', 'id');
    }


    public function users()
    {
    	return $this->belongTo('App\User', 'id');
    }
}
