<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use HasTranslations;
    protected $table = 'team';
    public $timestamps = false;

    public $translatable = ['name','text','profession'];
    protected  $guarded=[];


}
