<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Order;
use App\Models\Posts;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public function index()
    {
//        $orders = Order::groupBy('unique_id')->orderby('id', 'desc')->with('product','user')->get();
     $orders=   Order::
              groupBy('unique_id')->with('product')
              ->selectRaw('sum(total) as sum, price,id,unique_id,customTime,time1,time2,updated_at,id,fullname,phone,payment,street,home,content')
              -> orderBy('id', 'desc')
            ->get();
    // dd($orders);
        return view('back.order.index', compact('orders'));
    }

    public function show($uId)
    {
        $orders = Order::orderby('id', 'desc')->with('product','user')->where('unique_id',$uId)->get();


        return view('back.order.detail', compact('orders'));
    }















}
