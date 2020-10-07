<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Delivery extends Model
{
    use HasTranslations;
    protected $table='delivery';
    public $timestamps=false;
    protected $guarded=[];
    public $translatable = ['text'];

}
