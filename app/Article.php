<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['title', 'text', 'country_id', 'city_id', 'avatar', 'active'];

    protected $casts = [
        'avatar'     => 'Object',
        'active'     => 'Boolean'
    ];
}
