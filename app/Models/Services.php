<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Services extends Model
{
    use HasTranslations;
    protected $table = 'services';
    public $timestamps = false;

    public $translatable = ['name','slug','description'];
    protected  $guarded=[];




}
