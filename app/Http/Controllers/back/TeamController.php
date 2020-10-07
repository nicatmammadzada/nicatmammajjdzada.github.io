<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Team;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $teams= Team::orderBy('id','desc')->get();
        return view('back.team.index', compact('teams'));
    }


    public function create()
    {
        $categorys = Category::all();
        return view('back.team.create', compact('categorys'));
    }


    public function store(Request $request)
    {
        $validate = [
            'name' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:500',
            'profession' => 'required',
        ];

        $messages = [
            'name.required' => 'name boş ola bilməz!',
            'profession.required' => 'ixtisas boş ola bilməz!',
            'photo.required' => 'Şəkil boş ola bilməz!',
            'photo.mimes' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
            'photo.uploaded' => 'Bilinməyən xəta',
            'photo.image' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
        ];


        $this->validate(request(), $validate, $messages);


        $photo = request()->file('photo');
        $photoFile = time() . '.' . $photo->extension();
        request()->file('photo')->move(public_path('/uploads/team/'), $photoFile);

        $team = new Team();
        $team->photo = $photoFile;







        $team->setTranslation('name', app()->getLocale(), $request->name);
        $team->setTranslation('profession', app()->getLocale(),$request->profession);
//        $team->setTranslation('text', app()->getLocale(), $request->text);
        $team->save();
        return redirect()
            ->route('admin.team.index')
            ->with('type', 'success')
            ->with('id', $team->id)
            ->with('mesaj', ' Created');
    }


    public function destroy($id)
    {
        $product = Team::where('id', $id)->first();
        $last_image_path = public_path("/uploads/team/$product->photo"); // Value is not URL but directory file path
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
        $team = Team::where('id', $id)->first();

        return view('back.team.edit', compact('team'));
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
            'photo' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:500',
            'profession' => 'required',
        ];
        $messages = [
            'name.required' => 'name boş ola bilməz!',
            'profession.required' => 'profession boş ola bilməz!',
            'photo.required' => 'Şəkil boş ola bilməz!',
            'photo.mimes' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
            'photo.uploaded' => 'Bilinməyən xəta',
            'photo.image' => 'Yüklənə bilən formatlar jpg,jpeg,png,webp',
        ];


        $this->validate(request(), $validate, $messages);

        $slug = Str::slug($request->name, '-');

        $team = Team::find($id);


        $last_image_path = public_path("/uploads/team/$team->photo"); // Value is not URL but directory file path




        $team->setTranslation('name', app()->getLocale(), $request->name);
        $team->setTranslation('profession', app()->getLocale(),$request->profession);
        $team->setTranslation('text', app()->getLocale(), $request->text);





        if ($request->hasFile('photo')) {
            if (File::exists($last_image_path)) {
                File::delete($last_image_path);
            }
            $image = new Image();
            $path = '/uploads/team/';
            $photoFile = $request->file('photo');
            $photo = $image->image($photoFile, '', '', $path);
            //  $image->removeImage($last_image_path);
            $team->photo = $photo;
        }
        $team->save();

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
