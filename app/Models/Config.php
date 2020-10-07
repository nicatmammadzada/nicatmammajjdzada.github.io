<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Config extends Model
{
    use HasTranslations;
    protected $table='config';
    public $timestamps=false;
    public $translatable = ['location'];
    protected $fillable=['location','email','phone','facebook','instagram','youtube','twitter','logo','logo2','reklam','lat','long','reklam2','reklam3','reklam4'];
}
