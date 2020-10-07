<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;

class SliderController extends Controller
{


    public function index()
    {

        $sliders = Slider::all();
        return view('back.slider.index', compact('sliders'));
    }


    public function add()
    {
        $this->validate(request(), [
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:300',
        ]);


        $photo = request()->file('photo');
        $photoFile = time() . '.' . $photo->extension();
        request()->file('photo')->move(public_path('/uploads/slider/'), $photoFile);
        $slider= new Slider();
        $slider->setTranslation('photo', app()->getLocale(), $photoFile);
        $slider->save();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'updated');
    }




    public function delete($id)
    {
        $slider = Slider::where('id', $id)->first();
        $last_image_path = public_path("/uploads/slider/$slider->photo"); // Value is not URL but directory file path
        if (File::exists($last_image_path)) {
            File::delete($last_image_path);
        }
        $slider->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }

}
