<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'kind_id', 
    ];

    public function user()
    {
        return $this->belongTo('App\User', 'id');
    }

    public function donate()
    {
    	return $this->hasMany('App\Donator');
    }
}
