<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['title', 'active'];

    protected $casts = [
        'active'         => 'Boolean',
    ];

    public function tour() {
        return $this->belongsToMany('App\Service');
    }

    // service user
    public function user() {
        return $this->belongsToMany('App\User');
    }

}
