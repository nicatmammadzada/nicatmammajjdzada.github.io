<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('back.category.index', compact('categorys'));
    }


    public function create()
    {

        return view('back.category.create');
    }


    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'slug' => 'required|unique:course',
        ]);


        $category = new Category();
        $slug = Str::slug($request->slug ,'-');

        $category->setTranslation('name', app()->getLocale(), $request->name);
        $category->setTranslation('slug', app()->getLocale(), $slug);
        $category->save();
        return redirect()
            ->route('admin.category.index')
            ->with('type', 'success')
            ->with('id', $category->id)
            ->with('mesaj', 'Category Created');
    }


    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();

        $category->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }


    public function edit($id)
    {
        $category = Category::where('id', $id)->first();

        return view('back.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {


        $this->validate(request(), [
            'slug' => 'required',
            'name' => 'required',

        ]);
        $category = Category::find($id);
        $slug = Str::slug($request->slug ,'-');



//        if ($request->hasFile('photo')) {
//
//            $image = new Image();
//            $path = '/uploads/category/';
//            $photoFile = $request->file('photo');
//            $photo = $image->image($photoFile, '', '', $path);
//            //  $image->removeImage($last_image_path);
//            $category->photo = $photo;
//        }




        $category->setTranslation('name', app()->getLocale(), $request->name);
        $category->setTranslation('slug', app()->getLocale(), $slug);
        $category->save();

        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Category updated');

    }

}
