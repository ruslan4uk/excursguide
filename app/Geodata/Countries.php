<?php

namespace App\Geodata;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $connection = 'mysqlgeodata';
    protected $table = 'country';
    /**
     * Получить города текущей страны
     *
     * @return void
     */
    public function cities()
    {
        return $this->hasMany('App\Geodata\Cities', 'country_id', 'country_id');
    }
    
}