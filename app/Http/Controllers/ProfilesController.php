<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);
        $follows = auth()->user() ? auth()->user()->following->contains($user_id) : false;

        // remember(key, how log to store cache, callback closure function)
        $postCount = Cache::remember(
            'count.posts'.$user_id,
            now()->addSeconds(30),
            function () use($user) {
                return $user->posts->count();
            }
        );
        $followersCount = Cache::remember(
            'count.followers'.$user_id,
            now()->addSeconds(30),
            function () use($user) {
                return $user->profile->follower->count();
            }
        );
        $followingCount = Cache::remember(
            'count.following'.$user_id,
            now()->addSeconds(30),
            function () use($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', [
            'user'=>$user,
            'follows'=>$follows,
            'postCount'=>$postCount,
            'followersCount'=>$followersCount,
            'followingCount'=>$followingCount
        ]);
    }

    public function edit(User $user) {
        // authorize an update on the particular profile
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'nullable|url',
            'image'=>'image'
        ]);

        if(request('image')) {
            $imagePath = request('image')->store('profile', 'public') ;
            $image = Image::make(public_path("storage/$imagePath"))->fit(250, 250);
            $image->save();
            $imageArray = ['image'=>$imagePath];
        }

//        $user->profile()->update($data);

//        auth() adds an extra layer of protection by making sure that the $user is the authenticated one
//        auth()->user()->profile()->update($data);

//        Add `protected $guarded = [];` in Profile model to use `profile` instead of `profile()`

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/$user->id");
    }
}
