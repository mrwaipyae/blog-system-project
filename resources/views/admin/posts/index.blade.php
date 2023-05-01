@extends('admin/layouts/master')
@section('link')
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
@endsection
@section('content')
<!-- Post navigation -->
<div class="container mb-4 mt-4 p-3">
    <h5 class="col-md-6">Posts</h5>
    <div class="row mt-4">
        <div class="col-md-6">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPostModal">
                Add New Post
            </a>
        </div>
        <div class="col-md-6">
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="Enter keyword..." />
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-block" type="button">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Post table -->
@php
$no = 1;
@endphp
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">User</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th>{{$no++}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category->name}}</td>
            <td>tagggg</td>
            <td>
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- add post modal -->
<div id="addPostModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Post</h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.posts.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                        <div class="col-md-6">
                            <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                name="category_id" required>
                                <option value="">-- Select Category --</option>

                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tags">Tags:</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                        <div class="col-md-6">
                            <textarea id="editor" class="form-control @error('content') is-invalid @enderror"
                                name="content" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                                name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submi</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    ClassicEditor.create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

</script>
@endsection
