<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Config;
use File;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $crumbs = [
            'Parametrlər' => route('admin.config')
        ];
        $title = 'Parametrlər';
        $config = Config::first();
        return view('back.config', compact('title', 'crumbs', 'config'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logo' => 'mimes:jpeg,jpg,webp,png|max:550',
            'logo1' => 'mimes:jpeg,jpg,webp,png|max:550',
        ]);

        $config = Config::first();
        $oldLogo = $config->logo;
        $oldLogo1 = $config->logo1;


        $config->update($request->all());
        $config->setTranslation('location', app()->getLocale(), $request->location);
        $config->save();

        if (request()->hasFile('logo')) {
            $logo = request()->file('logo');
            $logoFile = time() . '.' . $logo->extension();
            $path = '/uploads/photo/';
            request()->file('logo')->move(public_path($path), $logoFile);
            $image = new Image();
            $image->removeImage($path . $oldLogo);
            $config->logo = $logoFile;
            $config->save();
        }

        if (request()->hasFile('logo1')) {
            $logo1 = request()->file('logo1');
            $logo1File = time() . '.' . $logo1->extension();
            $path = '/uploads/photo/';
            request()->file('logo1')->move(public_path($path), $logo1File);
            $image = new Image();
            $image->removeImage($path . $oldLogo1);
            $config->logo1 = $logo1File;
            $config->save();
        }


        return redirect()
            ->route('admin.config')
            ->with('type', 'success')
            ->with('mesaj', 'Dəyişikliklər yerinə yetirildi');
    }
}
