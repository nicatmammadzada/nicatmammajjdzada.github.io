<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table='order';
    public $timestamps=true;
    protected $guarded=[];

    public function contact_created_at()
    {
        $date=\Carbon\Carbon::parse($this->created_at);
        return $date->isoFormat('MMM D YYYY');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
