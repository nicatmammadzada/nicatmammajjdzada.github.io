<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserLocations extends Authenticatable
{

    protected $table='user_locations';
    protected $guarded=[];
    public $timestamps=false;



    public function user_updated_at()
    {
        $date=\Carbon\Carbon::parse($this->updated_at);
        return $date->isoFormat('MMM D YYYY');
    }
}
