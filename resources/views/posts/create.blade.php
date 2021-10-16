@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <form method="POST" action="/p" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <h2>Add New Post</h2>
                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-form-label">{{ __('Post Caption') }}</label>
                        <input id="caption"
                               type="text"
                               class="form-control @error('caption') is-invalid @enderror"
                               name="caption" value="{{ old('caption') }}"
                               autocomplete="caption" autofocus>
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-form-label">{{ __('Post Description') }}</label>
                        <input id="description"
                               type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description" value="{{ old('description') }}"
                               autocomplete="description">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-form-label">{{ __('Post Image') }}</label>
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
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
