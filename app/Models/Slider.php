<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;
    protected $table='slider';
    public $timestamps=false;
    protected $guarded=[];
    protected $translatable=['photo'];
}
