@extends('layouts.master')
@section('link')
<style>
    .ck-content {
        height: 240px;
    }

</style>
@endsection
@section('content')
@include('layouts.nav')
<div class="container my-1">
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <h3>Edit Post</h3>
            <form method="POST"
                action="{{ route('post.update',['id'=>$post->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-2">
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}"
                        required>
                </div>
                <div class="form-group mb-2">
                    <select class="form-control" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @if (in_array($tag->id,
                                $post->tags->pluck('id')->toArray())) selected @endif>{{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                        name="image">
                    @if($post->image)
                        <div class="mt-2">
                            <img src="{{ asset('img/' . $post->image) }}" alt="Post Image"
                                width="200">
                        </div>
                    @endif
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <textarea class="form-control" id="editor" name="content" required>{{ $post->content }}</textarea>
                </div>

                <div class="form-group text-center">
                    <a href="{{ route('admin.posts') }}" class="btn btn-secondary btn-lg px-3">Back to
                        post</a>
                    <button type="submit" class="btn btn-primary btn-lg px-3">Save and publish</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



@section('script')
@endsection