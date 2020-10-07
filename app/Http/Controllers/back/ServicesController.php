<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Services;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::all();

        return view('back.services.index', compact('services'));
    }


    public function create($id)
    {


        return view('back.services.create');
    }


    public function store(Request $request)
    {
        $validate = [
            'slug' => 'required',
            'name' => 'required',
        ];

        $messages = [
            'slug.required' => 'slug boş ola bilməz!',
            'name.required' => 'name boş ola bilməz!',

        ];


        $this->validate(request(), $validate, $messages);



        $servis = new Services();




        $slug = Str::slug($request->slug, '-');


        $servis->setTranslation('name', app()->getLocale(), $request->name);
        $servis->setTranslation('slug', app()->getLocale(), $slug);
        $servis->setTranslation('description', app()->getLocale(), $request->description);
        $servis->category_id=$request->category_id;
        $servis->save();
        return redirect()
            ->route('admin.services.index',$servis->category_id)
            ->with('type', 'success')
            ->with('id', $servis->id)
            ->with('mesaj', ' Created');
    }


    public function remove($id)
    {
        $product = Services::where('id', $id)->first();

        $product->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }


    public function edit($id)
    {
        $servis = Services::where('id', $id)->first();

        return view('back.services.edit', compact('servis'));
    }



    public function update(Request $request, $id)
    {


        $validate = [
            'name' => 'required',
            'slug' => 'required',
        ];
        $messages = [
            'name.required' => 'name boş ola bilməz!',
            'photo.required' => 'Şəkil boş ola bilməz!',
            'photo.mimes' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
            'photo.uploaded' => 'Bilinməyən xəta',
            'photo.image' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
        ];


        $this->validate(request(), $validate, $messages);

        $slug = Str::slug($request->name, '-');

        $product = Services::find($id);

        $oldPhoto=$product->photo;



        $product->setTranslation('name', app()->getLocale(), $request->name);
        $product->setTranslation('slug', app()->getLocale(), $slug);
        $product->setTranslation('description', app()->getLocale(), $request->description);


        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');
            $photoFile = time() . '.' . $photo->extension();
            $path = '/uploads/services/';
            request()->file('photo')->move(public_path($path), $photoFile);
            $image = new Image();
            $image->removeImage($path . $oldPhoto);
            $product->photo = $photoFile;
            $product->save();
        }


        $product->save();

        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Product updated');

    }





}
