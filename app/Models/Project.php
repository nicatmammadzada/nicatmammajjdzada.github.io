<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;
    protected $table = 'project';
    public $timestamps = false;

    public $translatable = ['name','slug','description'];
    protected  $guarded=[];






    public function product_updated_at()
    {
        $date=\Carbon\Carbon::parse($this->updated_at);
        return $date->isoFormat('MMM D YYYY');
    }




}
