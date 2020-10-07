<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Services;
use App\Models\Team;

class PageController extends Controller
{
    public function contact()
    {
        return view("front.contact");
    }


    public function about()
    {
        $about = About::first();
        return view("front.about", compact('about'));
    }

    public function team()
    {
        $teams = Team::get();
        return view("front.team", compact('teams'));
    }

    public function servisDetail($slug)
    {
        $servis=Services::where('slug->'.app()->getLocale(),$slug)->first();



        return view("front.servis-detail", compact('servis'));
    }


}
