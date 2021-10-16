@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-start">
        <div class="col-sm-3 text-center p-3 pl-md-5">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="w-100 rounded-circle" style="max-width: 175px;">
            <div class="mt-3">
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan
            </div>
        </div>
        <div class="col-sm-9 p-3">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h2">{{ $user->username }}</div>
{{--                    <button class="btn btn-primary ml-4">Follow</button>--}}
                    <follow-component user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-component>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            <div class="d-flex">
{{--                <div class="pr-5"><strong>{{ count($user->posts) }}</strong> posts</div>--}}
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title ?? 'Unnamed' }}</div>
            <div>{{ $user->profile->description ?? 'No description' }}</div>
            <div>
                @if($user->profile && $user->profile->url)
                    <a href="#">{{ $user->profile->url }}</a>
                @else
                    <span>N/A</span>
                @endif
            </div>
{{--            <div><a href="#">{{ $user->profile->url ?? 'N/A' }}</a></div>--}}
        </div>
    </div>
    <div class="row mt-3">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4 ">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" alt="" class="w-100">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
