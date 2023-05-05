@extends('admin.layouts.master')
@section('link')
<style>
.ck-content {
    height: 240px;
}
</style>
@endsection
@section('page_title','admin')
@section('content')

<div class="container my-1">
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <h3>Create New Post</h3>
            <form method="POST" action="{{ route('admin.posts.create') }}"enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <input type="text" name="title" class="form-control form-control-lg" placeholder="Title">
                </div>
                <div class="form-group mb-2">
                    <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                name="category_id" required>
                                <option value=""> --Category-- </option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <select name="tags[]" id="tags" class="form-control">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group mb-2">
                        <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    name="image">
                    </div>
                <div class="form-group mb-2">
                    <textarea name="content" id="editor" class="form-control" rows="10"></textarea>
                </div>
        

                <div class="form-group text-center">
                    <a href="{{route('admin.posts')}}" class="btn btn-secondary btn-lg px-3">Back</a>
                    <button type="submit" class="btn btn-primary btn-lg px-3">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

