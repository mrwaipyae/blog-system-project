@extends('layouts.master')
@section('link')
<style>
    .ck-content {
        height: 230px;
    }

</style>
@endsection
@section('content')
@include('layouts/nav')
<div class="container my-1 py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <form method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" name="title" class="form-control form-control-lg" placeholder="Title">
                </div>
                <div class="form-group mb-3">
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        <option value="">Choose Tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="thumbnail" class="form-label fs-5 me-5">Thumbnail:</label>
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                        name="image">
                </div>
                <div class="form-group mb-3">
                    <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group text-center">
                    <a href="{{ route('admin.posts') }}"
                        class="btn btn-secondary btn-lg px-4 me-3">Back</a>
                    <button type="submit" class="btn btn-primary btn-lg px-4">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
