<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Photos;
use App\Models\Posts;
use Illuminate\Http\Request;
use File;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photos::orderby('id','desc')->get();
        return view('back.photo.index', compact('photos'));
    }
    public function create(Request $request)
    {
        request()->validate([
            'photo.*' => 'required|mimes:jpeg,png,jpg,JPG,gif,svg,webp|max:400',
        ]);
        foreach ($request->photo as $photo) {
            $image = new Image();
            $path = '/uploads/gallery/';
            $photoFile = $image->image($photo, '', '', $path);
            Photos::create(['name'=>$photoFile]);
        }
        return redirect()->back()->with('type', 'success')->with('mesaj', 'photo added');
    }
    public function remove($id)
    {
        $photo = Photos::where('id', $id)->first();

        $last_image_path = public_path("/uploads/gallery/$photo->name"); // Value is not URL but directory file path
        if (File::exists($last_image_path)) {
            File::delete($last_image_path);
        }
        $photo->delete();
        return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }
    public function store(Request $request,$id)
    {
          request()->validate([
            'photo' => 'required|mimes:jpeg,png,jpg,JPG,gif,svg,webp|max:500',
        ]);
                $oldPhoto = Photos::where('id', $id)->first(); 
                
      if (File::exists(public_path("/uploads/gallery/$oldPhoto->name"))) {
            File::delete(public_path("/uploads/gallery/$oldPhoto->name"));
        }
                
          $photo= $request->photo;
               $path = '/uploads/gallery/';
        $new_photo_name = \Intervention\Image\Facades\Image::make($photo);
        $new_photo_path = public_path() . $path;
        $new_photo_name->save($new_photo_path . $oldPhoto->name);
      
        $new_photo_name = $new_photo_name->basename;
       
        
         
             $oldPhoto->name=$new_photo_name;
             $oldPhoto->save();
              return redirect()
            ->back()
            ->with('type', 'success')
            ->with('mesaj', 'Updated');
        
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $photo = Photos::where('id', $id)->first();
    
        return view('back.photo.edit', compact('photo'));
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
