<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';
    protected $fillable = ['user_id', 'about'];
    protected $guard = ['id', 'user_id', 'active', 'status', 'properties'];

    protected $casts = [
        'languages' => 'Array',
        'locations' => 'Array',
        'contacts'  => 'Array',
        'services'  => 'Array',
        'user_files' => 'Array',
    ];


    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
