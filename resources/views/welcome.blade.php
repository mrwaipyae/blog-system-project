<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('css/variables.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <style>
        .search-container {
            position: relative;
        }

        #search-suggestions {

            position: absolute;
            top: 100%;
            left: 0;
            z-index: 999;
            width: 100%;
            background-color: #fff;

            border-radius: 0 0 0.5rem 0.5rem;

            margin-top: 0.5rem;
        }

        #search-suggestions li {
            list-style: none;
            margin: 0;
            padding: 0;

        }

        #search-suggestions li a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 0;
        }

        #search-suggestions li a:hover {
            background-color: #eee;
        }

    </style>
</head>

<body>
    @include('layouts.modal')
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top px-5 py-4 mb-2 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">InkSpire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Our Story</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Write</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                            class="btn text-white nav-link rounded-pill px-3 bg-dark">Get
                            Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="bg-light mt-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1 class="display-4 fw-bold mb-4">A place to share knowledge and better understand the world
                    </h1>
                    <p class="lead mb-4">Sign up to read and write thoughtful stories and essays on topics that
                        matter
                    </p>

                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <a class="btn text-white nav-link rounded-pill py-2 fs-5 bg-dark"
                                href="{{ route('register') }}">Start
                                Reading</a>
                        </div>
                    </div>

                </div>
                <div class="col-md-5">
                    <img src="https://via.placeholder.com/600x400" class="img-fluid rounded"
                        alt="Medium homepage hero section image">
                </div>
            </div>
        </div>
    </section>
    <!-- trending post -->
    <section class="py-5 border-bottom">
        <div class="container">
            <h2 class="mb-4">Trending on InkSpire</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($popularPosts as $popularPost)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2 text-muted">
                                    <img src="{{ asset('storage/profile_images/'.$popularPost->user->profile_image) }}"
                                        alt="User Profile" class="rounded-circle me-2" width="30" height="30">
                                    <span class="text-dark">{{ $popularPost->user->name }}</span>
                                    in
                                    @foreach($popularPost->tags as $tag)
                                        <span class="text-dark me-1">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <h5 class="card-title mb-3">How to Build a Website from Scratch</h5>
                                <div class="mb-2"><small class="text-muted">May 4</small></div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--All posts-->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto">
                    @foreach($posts as $post)
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-2">
                                        <a
                                            href="{{ route('user.posts',[ '@'.str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                                            <img src="{{ asset('storage/profile_images/'.$post->user->profile_image) }}"
                                                alt="User Profile" class="rounded-circle me-2" width="30" height="30">
                                        </a>
                                        <a href="" class="nav-link">
                                            <p class="m-0">{{ $post->user->name }}</p>
                                        </a>
                                    </div>
                                    <a href="{{ route('post.view', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}"
                                        class="text-decoration-none text-black">
                                        <h5>{{ $post->title }}</h5>

                                        <p class="text-gray">
                                            @php
                                                $content = strip_tags($post->content);
                                                $words = str_word_count($content, 1);
                                                $limitedWords = array_slice($words, 0, 20);
                                                $limitedContent = implode(' ', $limitedWords);
                                            @endphp
                                            {!! $limitedContent . "..." !!}
                                        </p>
                                    </a>
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted me-2">
                                            {{ date("F j", strtotime($post->created_at)) }}
                                        </span>
                                        @foreach($post->tags as $tag)
                                            <a class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 mx-1">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    @if($post->image)
                                        <img src="{{ asset('img/' . $post->image) }}"
                                            alt="{{ $post->title }}" class="img-fluid" style="width:90%;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>

                    @endforeach
                </div>
                <!--navigation section-->
                <div class="col-md-4 col-lg-4">
                    <div
                        class="sticky-top {{ (Auth::check())?'top-0':'top-30' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row mb-3">
                            @foreach(App\Models\Tag::all() as $tag)
                                <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                    <a class="btn btn-outline-dark btn-sm mb-2 rounded-pill px-2"
                                        href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <h5 class="text-muted py-3">Recent Posts</h5>
                            <ul class="list-unstyled">
                                @foreach($recentPosts as $post)
                                    <li class="mb-3">
                                        <a href="" class="text-dark text-decoration-none">
                                            <h6>{{ $post->title }}</h6>
                                        </a>
                                        <p class="text-muted mb-0">{{ $post->created_at->diffForHumans() }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
