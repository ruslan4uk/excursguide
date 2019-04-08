<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table='tours';
    protected $fillable = ['user_id'];
    protected $guard = ['user_id', 'active', 'status', 'properties'];

    protected $casts = [
        'languages'         => 'Object',
        'category'          => 'Number',
        'people_category'   => 'Number',
        'photo'             => 'Object'
    ];

    /**
     * Relation hasMany from User model
     *
     * @return void
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Relation hasMany from UserData model
     *
     * @return void
     */
    public function userData() {
        return $this->belongsTo('App\UserData', 'user_id', 'user_id');
    }

}
