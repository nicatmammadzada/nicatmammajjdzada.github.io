<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Mail\MailForClients;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::
//        with('orders.product.category')
        with(['orders' => function ($query) {
            $query
                ->groupBy('client_id')
                ->with('product.category')
                ->selectRaw(' *,sum(total) as sum');
        }])
            ->orderBy('id', 'desc')
            ->where('is_active', 1)->get();

        $categorys = Category::all();
        $products = Product::where('category_id', 1)->get();

        return view('back.client.index', compact('clients', 'categorys', 'products'));
    }

    public function show($uId)
    {
        $orders = Order::orderby('id', 'desc')->with('product', 'user')->where('unique_id', $uId)->get();


        return view('back.order.detail', compact('orders'));
    }

    public function mail(Request $request)
    {
        set_time_limit(2220);
        $client = Client::where('id', $request->clients[1])->first();
        //  dd($client);
        for ($i = 0; $i < count($request->clients); $i++) {
            $client = Client::where('id', $request->clients[$i])->first();
            Mail::to("$client->email")->send(new MailForClients($client, $request->mesaj));
            sleep(1);

        }


        return redirect()->back()->with('type', 'success')->with('mesaj', 'mil gonderildi');
    }

    public function filter(Request $request)
    {
        $pr = \request('product_id');





        $clients = Client::
        with(['orders' => function ($query) use ($pr) {
            $query
                ->groupBy('client_id')
                ->where('product_id',$pr)
                ->with('product.category')
                ->selectRaw(' *,sum(total) as sum');
        }])
            ->orderBy('id', 'desc')
            ->where('is_active', 1)->get();

        $categorys = Category::all();
        $products = Product::where('category_id', 1)->get();

        return view('back.client.index', compact('clients', 'categorys', 'products'));

    }


}
