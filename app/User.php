<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get user_data
     *
     * @return void
     */
    public function userData() 
    {
        return $this->hasOne('App\UserData', 'user_id', 'id');
    }

    /**
     * Return has admin
     *
     * @return boolean
     */
    public function isAdmin() 
    {     
        return $this->userData->status === '999' ? true : false;
    }

    /**
     * Get tour for user
     *
     * @return void
     */
    public function userTour() 
    {
        return $this->hasMany('App\Tour', 'user_id', 'id');
    }

    /**
     * Get active tour for user
     *
     * @return void
     */
    public function activeTours()
    {
        return $this->userTour()->where('active', 2);
    }

    /**
     * Get services for user data 
     *
     * @return void
     */ 
    public function services() {
        return $this->belongsToMany('App\Service');
    }

    /**
     * Get comment for user page
     *
     * @return void
     */
    public function comments() {
        return $this->hasMany('App\Comment', 'page_id');
    }

    /**
     * get user commetns
     *
     * @return void
     */
    public function commentUser() {
        return $this->hasMany('App\Comment', 'user_id');
    }

    
}
