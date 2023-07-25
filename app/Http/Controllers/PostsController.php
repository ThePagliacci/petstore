<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->pluck('id');
        $posts = Post::whereIn('user_id', $users)->latest()->paginate(6);

        return view('store.lostnfound', compact('posts'));
    }

    public function create()
    {
        return view('store.create');
    }

    public function store()
    {
        $data = request()->validate([
            'description' => 'required',
            'image' => 'required|image',
            'phone' => 'required|numeric|digits:11'
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200); //resizing the images
        $image->save();

        auth()->user()->posts()->create([                       //grabbing the data that the user submitted
            'description' => $data['description'],
            'image' => $imagePath,
            'phone' => $data['phone'],
        ]); 
    
        return redirect('/lost')->with('message', "Post Saved Successfully!");
    }

    public function show(Post $post)
    {
        return view('store.show', compact('post'));
    }

    
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('store.edit', compact('post'));
    }
    
    public function update( Post $post)
    {
            $data = request()->validate([
                'description' => 'required',
                'image' => '',
                'phone' => 'required|numeric|digits:11'
            ]);
    
            if(request('image'))
            {
                $imagePath = request('image')->store('uploads', 'public');
    
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200); //resizing the images
                $image->save();
            
    
            auth()->user()->posts()->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
        }
           return redirect('/lost')->with('message', "Post Edited Successfully!");
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

        $image_path = public_path("storage/{$post->image}"); //put this code in the edit function 
                                                             //to delete the previous photo
        if(File::exists($image_path)) {

            File::delete($image_path);
        }
        $post->delete();

        return redirect('/lost')->with('message', "Post deleted Successfully!");
    }
    
}
