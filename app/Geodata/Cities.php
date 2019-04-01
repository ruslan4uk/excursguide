<?php

namespace App\Geodata;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $connection = 'mysqlgeodata';
    protected $table = 'city';
    
    /**
     * Получить страну у города
     *
     * @return void
     */
    public function country()
    {
        return $this->belongsTo('App\Geodata\Countries', 'country_id', 'country_id');
    }
}
