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

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'parent');
    }

    public function addFavorite($post_id)
    {
        $favorites = json_decode($this->favorites);
        if ($favorites) {
            $favorites[]= $post_id;
        } else {
            $favorites = [$post_id];
        }
        $favorites = array_unique($favorites);
        $this->favorites = json_encode($favorites);
        $this->save();
    }

    public function getFavorites()
    {
        return json_decode($this->favorites);
    }

    public function deleteFavorite($post_id)
    {
        $favorites = json_decode($this->favorites);

        if ($favorites) {
            $post_position = array_search($post_id, $favorites);

            if($post_position !== false) {
                unset($favorites[$post_position]);
                $this->favorites  = json_encode($favorites);
                $this->save();
            }
        }
        return $this->favorites;
    }
}
