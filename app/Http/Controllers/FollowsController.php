<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    // make follows controller routes require authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user) {
        // return the authenticated users followings and toggle the specific user's profile from the r|nship
        return auth()->user()->following()->toggle($user->profile);
    }
}
