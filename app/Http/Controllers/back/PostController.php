<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Posts;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function index()
    {
        $posts = Posts::orderby('id', 'desc')->get();
        $crumbs = [
            'Post' => route('admin.post'),
        ];

        $title = 'Post';
        return view('back.post.index', compact('posts', 'title', 'crumbs'));
    }

    public function create()
    {
        $crumbs = [
            'Post' => route('admin.post'),
            'Yeni' => route('admin.post.create')
        ];

        $categorys = Category::where('parent_id', '!=', 0)->get();
        $title = 'Yeni Post';
        $users=User::where('is_active',1)->where('is_admin',1)->get();


        return view('back.post.create', compact('crumbs', 'title', 'categorys','users'));
    }


    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|unique:post',
            'small_text' => 'required',
            'description1' => 'required',
        ]);




        DB::transaction(function () {
            $data = [
                'title' => request('title'),
                'small_text' => request('small_text'),
                'description1' => request('description1'),
                'category_id' => request('category_id'),
                'author_id' => request('author_id'),
            ];
            $data['slug'] = Str::slug(request('title'));
//            if (Posts::whereSlug($data['slug'])->count() > 0) {
//
//                return back()
//                    ->withInput()
//                    ->withErrors(['slug' => 'Bazada bu adda post vardır']);
//
//            }
            $category_id = request('category_id');
            if (request()->hasFile('photo')) {
                $photo = request()->file('photo');
                $photoFile = time() . '.' . $photo->extension();
                request()->file('photo')->move(public_path('/uploads/post/'), $photoFile);
                $data['photo'] = $photoFile;
            }
            $post = Posts::create($data);
            if (!$post)
                return redirect()->back()->with('type', 'danger')->with('mesaj', 'post yuklenerken xeta bas verdi!');
            $category = Category::find($category_id);

            if ($category->parent_id != 0) {
                CategoryPost::create(['category_id' => $category->parent_id, 'posts_id' => $post->id]);
                CategoryPost::create(['category_id' => $category->id, 'posts_id' => $post->id]);

            } else {
                CategoryPost::create(['category_id' => $category->id, 'posts_id' => $post->id]);
            }

        });

        return redirect()
            ->route('admin.post.create')
            ->with('type', 'success')
            ->with('mesaj', 'Yeni post əlavə edildi');
    }


    public function destroy($slug)
    {
        $post = Posts::where('slug', $slug)->first();

        $last_image_path = public_path("/uploads/post/$post->photo"); // Value is not URL but directory file path
        if (File::exists($last_image_path)) {
            File::delete($last_image_path);
        }


        $post->delete();
        return redirect()
            ->route('admin.post')
            ->with('type', 'success')
            ->with('mesaj', 'Silinmə tamamlandı');
    }

    public function edit($slug)
    {
        $users=User::where('is_active',1)->where('is_admin',1)->get();

        $post = Posts::where('slug', $slug)->first();
        $categorys = Category::where('parent_id', '!=', 0)->get();
        $crumbs = [
            'Post' => route('admin.post'),
            $post->title => route('admin.post.create')
        ];
        $title = $post->title;

        return view('back.post.edit', compact('crumbs', 'title', 'post', 'categorys','users'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate(request(), [
            'title' => 'required',
            'small_text' => 'required',
            'description1' => 'required',

        ]);


        $post = Posts::where('slug', $slug)->first();
        $post->update($request->all());
        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');

            if ($photo->isValid()) {
                $image = new Image();
                $path = '/uploads/post/';
                $file_name = $image->image($photo, '', '', $path);
                $image->removeImage($path . $post->photo);
                $post->photo = $file_name;
                $post->save();
            }
        }
        return redirect()
            ->route('admin.post.edit', $post->slug)
            ->with('type', 'success')
            ->with('mesaj', 'Dəyişikliklər yerinə yetirildi');

    }


    public function choose1()
    {
        $id = \request('id');
        $value = \request('value');
        $post = Posts::find($id);
        $post->choose1 = $value;
        $post->save();
    }

    public function choose2()
    {
        $id = \request('id');
        $value = \request('value');

        $post = Posts::find($id);
        $post->choose2 = $value;
        $post->save();
    }

    public function event()
    {
        $id = \request('id');
        $value = \request('value');

        $post = Posts::find($id);
        $post->event = $value;
        $post->save();
    }

    public function analitika1()
    {
        $id = \request('id');
        $value = \request('value');

        $post = Posts::find($id);
        $post->analitika1 = $value;
        $post->save();
    }


    public function analitika2()
    {
        $id = \request('id');
        $value = \request('value');

        $post = Posts::find($id);
        $post->analitika2 = $value;
        $post->save();
    }

    public function mobile()
    {
        $id = \request('id');
        $value = \request('value');

        $post = Posts::find($id);
        $post->mobile = $value;
        $post->save();
    }
    public function sem()
    {
        $id = \request('id');
        $value = \request('value');
        Posts::where('id','>',0)->update(['sem' => 0]);
        $post = Posts::find($id);
        $post->sem = $value;
        $post->save();
    }


}
