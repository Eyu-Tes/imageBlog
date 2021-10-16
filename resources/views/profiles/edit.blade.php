@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <form method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <h2>Edit Profile</h2>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-form-label">{{ __('Title') }}</label>
                        <input id="title"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') ?? $user->profile->title }}"
                               autocomplete="title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-form-label">{{ __('Description') }}</label>
                        <input id="description"
                               type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description" value="{{ old('description') ?? $user->profile->description }}"
                               autocomplete="description">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-form-label">{{ __('Url') }}</label>
                        <input id="url"
                               type="text"
                               class="form-control @error('url') is-invalid @enderror"
                               name="url" value="{{ old('url') ?? $user->profile->url }}"
                               autocomplete="url">
                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-form-label">{{ __('Profile Image') }}</label>
                        <input id="image"
                               type="file"
                               class="form-control-file @error('image') is-invalid @enderror"
                               name="image" value="{{ old('image') }}"
                               autocomplete="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row mb-0 pt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save Profile') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
