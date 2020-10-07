<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;
    protected $table = 'product';
    public $timestamps = true;
    use SoftDeletes;
    public $translatable = ['name','slug','description'];
    protected  $guarded=[];

    public function sub()
    {
        return $this->belongsTo(Product::class, 'parent_id','id');
    }

    public function subProduct()
    {
        return $this->hasMany(Product::class,'parent_id','id');
    }


    public function product_updated_at()
    {
        $date=\Carbon\Carbon::parse($this->updated_at);
        return $date->isoFormat('MMM D YYYY');
    }




}
