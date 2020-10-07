<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClientDetail extends Authenticatable
{

    protected $table='client_detail';
    protected $guarded=[];
    public $timestamps=false;



    public function client_updated_at()
    {
        $date=\Carbon\Carbon::parse($this->updated_at);
        return $date->isoFormat('MMM D YYYY');
    }
}
