<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;
    protected $table='about';
    public $timestamps=false;
    protected $guarded=[];
    public $translatable = ['text','text1'];

}
