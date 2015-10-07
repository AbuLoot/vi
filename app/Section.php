<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'section_id');
    }

    public function profiles()
    {
    	return $this->hasMany('App\Profile', 'section_id');
    }
}
