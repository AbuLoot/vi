<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = 'profiles';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'parent');
    }
}
