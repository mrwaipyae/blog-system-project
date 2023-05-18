@extends('layouts/master')
@section('content')
    @include('layouts/nav')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto pt-4 border-end">
                    <!-- Alert message (start) -->
                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <!-- Alert message (end) -->
                    <div class="d-flex align-items-center mb-5 border-bottom">
                        <h1 class="fs-1 fw-bold me-2">{{ $user->name }}</h1>
                    </div>
                    @foreach ($posts as $post)
                        <div class="mb-4">
                            <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title) . '-' . $post->id]) }}"
                                class="text-decoration-none text-black">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-muted">
                                            {{ date('F j', strtotime($post->created_at)) }}
                                        </p>
                                        <h5>{{ $post->title }}</h5>
                                        <p class="text-gray" id="post-content">
                                            @php
                                                $content = strip_tags($post->content);
                                                $words = str_word_count($content, 1);
                                                $limitedWords = array_slice($words, 0, 20);
                                                $limitedContent = implode(' ', $limitedWords);
                                                
                                            @endphp
                                            {!! $limitedContent . '...' !!}
                                        </p>
                                        <div class="row pt-2">
                                            <div class="col-md-10 d-flex align-items-center">
                                                @foreach ($post->tags as $tag)
                                                    <a class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 mx-1"
                                                        href="{{ route('tag.show', $tag->name) }}">
                                                        {{ $tag->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                            <div class="col-md-2 dropdown dropend">
                                                <a class="" href="#" role="button" id="dropdownMenuLink"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots fs-4 text-secondary" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="More"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-dark"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('post.edit', $post->id) }}">Edit
                                                            Post</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#deletePostModal{{ $post->id }}">Delete
                                                            Post</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        @if ($post->image)
                                            <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}"
                                                class="img-fluid" style="width:80%; height:70%">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        <hr>
                        <!-- Delete Post Modal -->
                        <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this Post?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="py-4 ps-3 text-center">
                        <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($user->name)), $user->id]) }}"
                            class="nav-link d-inline">
                            <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="User Profile"
                                class="rounded-circle me-2" width="90" height="90">
                        </a>
                        <p class="fw-medium fs-4 pt-2 ">{{ $user->name }}</p>
                        <a class="dropdown-item fs-6 text-muted" href="#" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">Edit Profile
                        </a>
                        <div class="row d-flex align-items-center text-center border-bottom ms-3 py-5">
                            <div class="col-md-6">
                                <p class="fw-medium fs-5">{{ $totalPosts }}</p>
                                <h5>Total Posts</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="fw-medium fs-5">{{ $totalLikes }}</p>
                                <h5>Total Likes</h5>
                            </div>
                        </div>
                    </div>
                    <div class="sticky-top py-4 {{ Auth::check() ? 'top-0' : 'top-10' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row mb-3">
                            @foreach (App\Models\Tag::all() as $tag)
                                <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                    <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                        href="{{ route('tag.show', $tag->name) }}">{{ $tag->name }}</a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Profile Form -->
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Profile Image -->
                            <div class="mb-3">
                                <label for="profileImage" class="form-label">
                                    <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}"
                                        alt="User Profile" class="rounded-circle me-2" width="80" height="80">
                                </label>
                                <input id="profileImage" type="file" class="form-control-file" name="profile_image">
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ $user->name }}">
                                @if ($errors->has('name') && $errors->first('name') == 'The name field is required.')
                                    <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                @elseif ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $user->email }}">
                                @if ($errors->has('email') && $errors->first('email') == 'The email field is required.')
                                    <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                                @elseif ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
