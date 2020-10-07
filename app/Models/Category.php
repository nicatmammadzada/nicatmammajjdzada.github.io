<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    protected $table = 'category';
    public $timestamps = false;
    //  use SoftDeletes;
    public $translatable = ['name','slug'];
    protected  $guarded=[];

    public function services()
    {
        return $this->hasMany(Services::class, 'category_id');
    }




}
