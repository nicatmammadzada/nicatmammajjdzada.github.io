<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\About;
use App\Models\Delivery;
use App\Models\Pandemia;
use File;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function edit()
    {


        $delivery = Delivery::first();
        return view('back.delivery', compact('delivery'));
    }

    public function store(Request $request)
    {
        $about = Delivery::first();
       // $oldPhoto = $about->photo;


        $about->setTranslation('text', app()->getLocale(), $request->text);
        $about->save();

//        if (request()->hasFile('photo')) {
//            $photo = request()->file('photo');
//            $photoFile = time() . '.' . $photo->extension();
//            $path = '/uploads/photo/';
//            request()->file('photo')->move(public_path($path), $photoFile);
//            $image = new Image();
//            $image->removeImage($path . $oldPhoto);
//            $about->photo = $photoFile;
//            $about->save();
//        }

        return redirect()
            ->route('admin.delivery')
            ->with('type', 'success')
            ->with('mesaj', 'Dəyişikliklər yerinə yetirildi');
    }



}
