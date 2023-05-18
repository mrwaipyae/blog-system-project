@extends('admin.layouts.master')
@section('link')
    <style>
        .ck-content {
            height: 300px;
        }
    </style>
@endsection
@section('page_title', 'admin')
@section('content')

    <div class="container my-1">
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <h3 class="mb-4">Create New Post</h3>
                <form method="POST" action="{{ route('admin.posts.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Title"
                            value="{{ old('title') }}">
                        @if ($errors->has('title') && $errors->first('title') == 'The title field is required.')
                            <div class="invalid-feedback d-block">{{ $errors->first('title') }}</div>
                        @elseif ($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="tags" class="form-label">Topics</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tags[]"
                                        id="tag{{ $tag->id }}" value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @if ($errors->has('tags') && $errors->first('tags') == 'The tags field is required.')
                            <div class="invalid-feedback d-block">{{ $errors->first('tags') }}</div>
                        @elseif ($errors->has('tags'))
                            <div class="invalid-feedback">{{ $errors->first('tags') }}</div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                            name="image">
                        @if ($errors->has('image') && $errors->first('image') == 'The image field is required.')
                            <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                        @elseif ($errors->has('image'))
                            <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content') }}</textarea>
                        @if ($errors->has('content') && $errors->first('content') == 'The content field is required.')
                            <div class="invalid-feedback d-block">{{ $errors->first('content') }}</div>
                        @elseif ($errors->has('content'))
                            <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('admin.posts') }}" class="btn btn-secondary btn-lg px-3">Back</a>
                        <button type="submit" class="btn btn-primary btn-lg px-3">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
