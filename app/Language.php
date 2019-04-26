<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = ['name', 'iso_code', 'active'];

    protected $casts = [
        'active'         => 'Boolean',
    ];
}
