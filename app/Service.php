<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public function tour() {
        return $this->belongsToMany('App\Service');
    }

    // service user
    public function user() {
        return $this->belongsToMany('App\User');
    }

}
