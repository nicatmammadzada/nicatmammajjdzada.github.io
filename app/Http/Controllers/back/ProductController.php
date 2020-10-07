<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promocode;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('sub')->get();

        return view('back.product.index', compact('products'));
    }


    public function create()
    {
        $categorysss = Product::where('parent_id',0)->get();
        return view('back.product.create', compact('categorysss'));
    }


    public function store(Request $request)
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


      

        $product = new Product();
   
        $product->parent_id = $request->parent_id;
      

        $slug = Str::slug($request->slug, '-');


        $product->setTranslation('name', app()->getLocale(), $request->name);
        $product->setTranslation('slug', app()->getLocale(), $slug);
        $product->setTranslation('description', app()->getLocale(), $request->description);
   
        $product->save();
        return redirect()
            ->route('admin.product.index')
            ->with('type', 'success')
            ->with('id', $product->id)
            ->with('mesaj', 'Product Created');
    }


    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $last_image_path = public_path("/uploads/product/$product->photo"); // Value is not URL but directory file path
        if (File::exists($last_image_path)) {
            File::delete($last_image_path);
        }
        $product->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }


    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categorysss = Product::where('parent_id',0)->get();
        return view('back.product.edit', compact('product', 'categorysss'));
    }

    public function promo($id)
    {
        //  $product = Product::withTrashed()->where('id', $id)->with('promo')->first();

        $product = Product::with(['promos' => function ($q) {
            $q->withTrashed();
        }])->find($id);

        return view('back.product.promo', compact('product'));
    }

    public function update(Request $request, $id)
    {


        $validate = [
            'name' => 'required',
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

        $product = Product::find($id);


        $last_image_path = public_path("/uploads/product/$product->photo"); // Value is not URL but directory file path






        $product->setTranslation('name', app()->getLocale(), $request->name);
        $product->setTranslation('slug', app()->getLocale(), $slug);
        $product->setTranslation('description', app()->getLocale(), $request->description);




        if ($request->hasFile('photo')) {
            if (File::exists($last_image_path)) {
                File::delete($last_image_path);
            }
            $image = new Image();
            $path = '/uploads/product/';
            $photoFile = $request->file('photo');
            $photo = $image->image($photoFile, '', '', $path);
            //  $image->removeImage($last_image_path);
            $product->photo = $photo;
        }
        $product->save();

        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Product updated');

    }

    public function promokod(Request $request, $id)
    {
        $validate = [
            'code' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'end_date' => 'required|date|date_format:Y-m-d|after:xxxx',
            'faiz' => 'required',
        ];
        $messages = [
            'code.required' => 'Code boş ola bilməz!',
            'start_date.required' => 'başlama tarixi boş ola bilməz!',
            'end_date.required' => 'bitmə tarixi boş ola bilməz!',
            'start_date.after' => 'baslama tarixi düzgün secilməyib!',
            'end_date.after' => ' bitme tarixi düzgün secilməyib!',

        ];

        Promocode::where('end_date', '<', now())->delete();

        $this->validate(request(), $validate, $messages);
        \request()->request->add(['product_id' => $id]);
        Promocode::create($request->all());

        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Product updated');

    }


    public function promoDestroy($id)
    {
        $promo = Promocode::where('id', $id)->first();

        $promo->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }

    public function row()
    {

        $id = \request('id');
        $value = \request('value');
        $product = Product::find($id);
        $product->row = $value;
        $product->save();
    }


}
