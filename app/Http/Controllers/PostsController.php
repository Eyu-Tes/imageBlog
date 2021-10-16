<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Return only the 'user_id' s of all the profiles that the currently logged user follows
        // Make sure to specify which 'user_id' is required b|c laravel is confused b|n
        // profiles table or profile_user table
        $users = auth()->user()->following()->pluck('profiles.user_id');
        // Get every attribute of the posts whose user is found in $users
        // $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        // latest() is shorthand for orderBy('created_at' 'DESC')
        // $posts = Post::whereIn('user_id', $users)->latest()->get();
        // Pagination (number of records per page
        // $posts = Post::whereIn('user_id', $users)->latest()->paginate(3);
        // Load the posts along with the related user
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(3);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption'=>'required',
            'description'=>"",
            'image'=>['required', 'image']
        ]);

        // eg. imagePath will be 'uploads/filename.jpg'
        $imagePath = request('image')->store('uploads', 'public');

        // fit(width, height)
        $image = Image::make(public_path("storage/$imagePath"))->fit(250, 250);
        $image->save();

        // create post through it's relationship (user)
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'description' => $data['description'],
            'image' => $imagePath
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post)
    {
//        return view('posts.show', [
//            'post' => $post
//        ]);

//        shorthand
        return view('posts.show', compact('post'));
    }
}
