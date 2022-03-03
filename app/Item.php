<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'price', 'category_id', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function likedUsers()
    {
        return $this->belongsToMany('App\User', 'likes');
    }

    public function isLikedBy($user)
    {
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }

    //最新順
    public function scopeLatest($query)
    {
        return $query->latest()->limit(5);
    }

    //購入画面
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function orderUsers()
    {
        return $this->belongsToMany('App\User', 'orders');
    }

    public function isOrders($user)
    {
        $result = $this->orderUsers->pluck('id')->contains($user->id);
        return $result;
    }
}
