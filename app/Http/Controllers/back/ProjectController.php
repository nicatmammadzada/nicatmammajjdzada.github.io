<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Services;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
      $professions=Project::all();
        return view('back.project.index', compact('professions'));
    }


    public function create()
    {
           return view('back.project.create');
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
        $servis = new Project();
        $slug = Str::slug($request->slug, '-');


        $servis->setTranslation('name', app()->getLocale(), $request->name);
        $servis->setTranslation('slug', app()->getLocale(), $slug);
        $servis->setTranslation('description', app()->getLocale(), $request->description);
        // $servis->category_id=$request->category_id;
            $servis->icon=$request->icon;

        
        
        
        $servis->save();
        return redirect()
            ->route('admin.project.index')
            ->with('type', 'success')
            ->with('id', $servis->id)
            ->with('mesaj', ' Created');
    }


    public function remove($id)
    {
        $product = Project::where('id', $id)->first();

        $product->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }


    public function edit($id)
    {
        $product = Project::where('id', $id)->first();

        return view('back.project.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validate = [
            'name' => 'required',
            'slug' => 'required',
        ];
        $messages = [
            'name.required' => 'name boş ola bilməz!',
            'slug.required' => 'slug boş ola bilməz!',
            'photo.required' => 'Şəkil boş ola bilməz!',
            'photo.mimes' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
            'photo.uploaded' => 'Bilinməyən xəta',
            'photo.image' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
        ];


        $this->validate(request(), $validate, $messages);
      
        
        $slug = Str::slug($request->name, '-');
        $product = Project::find($id);
        $product->setTranslation('name', app()->getLocale(), $request->name);
        $product->setTranslation('slug', app()->getLocale(), $slug);
        $product->setTranslation('description', app()->getLocale(), $request->description);

        $product->icon=$request->icon;



        $product->save();

        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', ' updated');

    }





}
