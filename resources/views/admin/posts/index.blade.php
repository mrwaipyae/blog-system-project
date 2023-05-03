@extends('admin/layouts/master')
@section('link')
@endsection
@section('content')
<!-- Post navigation -->
<div class="container mb-4 mt-4 p-3">
    <h2 class="col-md-6">Posts</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <a href="{{ route('admin.posts.new') }}" class="btn btn-success">
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
<table class="table table-bordered table-striped">
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
        @foreach($posts as $post)
        <tr>
            <th>{{ $no++ }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
                @foreach($post->tags as $tag)
                {{ $tag->name }}
                @endforeach
            </td>
            <td>
                <button type="button" class="btn btn-info" data-toggle="modal"
                    data-target="#viewPostModal{{ $post->id }}">
                    <i class="fa fa-eye"></i>
                </button>
                <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}" class="btn btn-warning"><i
                        class="fa fa-edit"></i> </a>
                <button type="button" class="btn btn-danger" data-toggle="modal"
                    data-target="#deletePostModal{{ $post->id }}">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn {{ (!$post->deleted_at)?'btn-secondary':'btn-success' }}"
                    data-toggle="modal" data-target="#publishPostModal{{ $post->id }}">
                    @if(!$post->deleted_at)
                    Unpublish
                    @else
                    Publish
                    @endif
                </button>


            </td>
        </tr>
        <!-- Post view modal -->
        <div class="modal fade" id="viewPostModal{{ $post->id }}" tabindex="-1" role="dialog"
            aria-labelledby="postViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postViewModalLabel">{{ $post->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $post->image_url }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">

                                <p></p>
                                <p>Category: {{ $post->category->name }},
                                    Tags:
                                    @foreach($post->tags as $tag)
                                    {{ $tag->name }}
                                    @endforeach
                                </p>
                                {!! $post->content!!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Post Edit Modal -->
        <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editPostForm" action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $post->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="editor" name="content"
                                    required>{{ $post->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id ===
                                        $post->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select class="form-control" id="tags" name="tags[]" multiple>
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @if (in_array($tag->id,
                                        $post->tags->pluck('id')->toArray())) selected @endif>{{ $tag->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete Post Modal -->
        <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publish unpublish Post Modal -->
        <div class="modal fade" id="publishPostModal{{ $post->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to
                        <span>
                            @if(!$post->deleted_at)
                            Unpublish
                            @else
                            Publish
                            @endif
                        </span>
                        this Post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.posts.publish', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

<!-- add post modal -->
<div id="addPostModal" class="modal fade">
    <div class="modal-dialog modal-lg">
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

                    <div class="form-group row mb-3">
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
                    <div class="form-group row mb-3">
                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}
                        </label>
                        <div class="col-md-6">
                            <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                name="category_id" required>
                                <option value="">-- Select Category --</option>

                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
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
                    <div class="form-group row mb-3">
                        <label for="tags" class="col-md-4 col-form-label text-md-right">Tags:</label>
                        <div class="col-md-6">
                            <select name="tags[]" id="tags" class="form-control">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3 ">
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
                    <div class="form-group mb-2 ">

                        <textarea id="editor" class="form-control @error('content') is-invalid @enderror" name="content"
                            rows="10">{{ old('content') }}</textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
@section('script')
@endsection
