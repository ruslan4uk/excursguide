<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'page_id', 'text', 'active'];

    /**
     * Get user 
     *
     * @return void
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get user data
     *
     * @return void
     */
    public function userData() {
        return $this->belongsTo('App\UserData', 'user_id', 'user_id');
    }

    /**
     * Get page user to comment
     *
     * @return void
     */
    public function pageUser() {
        return $this->belongsTo('App\User', 'page_id', 'id');
    }
}
