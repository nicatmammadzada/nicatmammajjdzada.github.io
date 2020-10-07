<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $table='users';
    protected $guarded=[];
    public $timestamps=true;

    public function locations()
    {
        return $this->hasMany('App\Models\UserDetail','user_id');
    }

    public function location()
    {
        return $this->hasMany('App\Models\UserDetail','user_id')->where('is_main',1);
    }

    public function user_updated_at()
    {
        $date=\Carbon\Carbon::parse($this->updated_at);
        return $date->isoFormat('MMM D YYYY');
    }
}
