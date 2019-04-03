<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table='tours';
    protected $fillable = ['user_id'];
    protected $guard = ['user_id', 'active', 'status', 'properties'];

    protected $casts = [
        'languages'         => 'Array',
        'category'          => 'Number',
        'people_category'   => 'Number',
        'photo'             => 'Array'
    ];


    /**
     * relation for user 
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
