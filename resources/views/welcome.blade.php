<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>InkSpire - A place to share knowledge</title>
    <link rel="icon" type="image/png" href="{{ url('img/profile/pen.png') }}" />
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
        body {
            font-family: Pyidaungsu, sans-serif;
        }

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
                        <a class="nav-link" href="{{ route('about') }}">Our Story</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Write</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn text-white nav-link rounded-pill px-3 bg-dark">Get
                            Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="bg-light mt-5">
        <div class="container py-5">
            <div class="row align-items-center py-3">
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
                    <img src="{{ asset('img/welcome/inkspire.gif') }}" class="img-fluid rounded"
                        alt="Medium homepage hero section image" height="80%">
                </div>
            </div>
        </div>
    </section>
    <!-- trending post -->
    <section class="py-4 border-bottom">
        <div class="container">
            <h5 class="py-4"><i class="bi bi-graph-up-arrow me-3 fs-5"></i>Trending on InkSpire</h5>
            <div class="row row-cols-1 row-cols-md-3 g-5">
                @foreach ($popularPosts as $popularPost)
                    <div class="col">
                        <div class="card-body" style="height: 130px;">
                            <div class="mb-2 text-muted">
                                <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($popularPost->user->name)), $popularPost->user->id]) }}"
                                    class="nav-link d-inline-block">
                                    <img src="{{ $popularPost->user->profile_image ? asset('storage/profile_images/' . $popularPost->user->profile_image) : 'https://example.com/default-profile-image.jpg' }}"
                                        alt="User Profile" class="rounded-circle me-2" width="30" height="30">
                                </a>
                                <small class="text-dark fw-bold">{{ $popularPost->user->name }}</small>
                                <small>in</small>
                                @foreach ($popularPost->tags as $tag)
                                    <small class="text-dark me-1 fw-bold">{{ $tag->name }}</small>
                                @endforeach
                            </div>
                            <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($popularPost->user->name)), Str::slug($popularPost->title) . '-' . $popularPost->id]) }}"
                                class="text-decoration-none text-black">
                                <p class="card-title mb-2 fw-bold">{{ $popularPost->title }}</p>
                            </a>
                            <div class="">
                                <small
                                    class="text-muted">{{ date('F j', strtotime($popularPost->created_at)) }}</small>
                                <i class="bi bi-dot text-secondary"></i>
                                <small class="text-muted fs-6 me-2">{{ $popularPost->readingTime }} min read</small>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--All posts-->
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto py-5 border-end pe-4">
                    @foreach ($posts as $post)
                        <div class="mb-4 pt-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-2">
                                        <a
                                            href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                                            <img src="{{ $post->user->profile_image ? asset('storage/profile_images/' . $post->user->profile_image) : 'https://example.com/default-profile-image.jpg' }}"
                                                alt="User Profile" class="rounded-circle me-2" width="30"
                                                height="30">
                                        </a>
                                        <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}"
                                            class="nav-link">
                                            <p class="m-0">{{ $post->user->name }}</p>
                                        </a>
                                    </div>
                                    <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title) . '-' . $post->id]) }}"
                                        class="text-decoration-none text-black">
                                        <h5 class="fw-bold">{{ $post->title }}</h5>
                                        <p class="text-muted" id="post-content{{ $post->id }}">
                                            @php
                                                $content = strip_tags($post->content);
                                                $words = str_word_count($content, 1);
                                                $limitedWords = array_slice($words, 0, 20);
                                                $limitedContent = implode(' ', $limitedWords);
                                            @endphp
                                            {!! $limitedContent . '...' !!}
                                        </p>
                                    </a>
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted me-1 fs-6">
                                            {{ date('F j', strtotime($post->created_at)) }}
                                        </span>
                                        <i class="bi bi-dot text-secondary"></i>
                                        <span id="reading-time{{ $post->id }}"
                                            class="text-secondary fs-6 me-2">{{ $post->readingTime }} min read</span>
                                        @foreach ($post->tags as $tag)
                                            <a class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 mx-1"
                                                href="{{ route('tag.show', $tag->name) }}">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    @if ($post->image)
                                        <a
                                            href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title) . '-' . $post->id]) }}">
                                            <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}"
                                                class="img-fluid" style="width:90%;">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <!--navigation section-->
                <div class="col-md-4 col-lg-4 ps-4 py-4">
                    <div class="sticky-top {{ Auth::check() ? 'top-0' : 'top-30' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row mb-3">
                            @foreach (App\Models\Tag::inRandomOrder()->limit(10)->get() as $tag)
                                <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                    <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                        href="{{ route('tag.show', $tag->name) }}">
                                        {{ $tag->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <h5 class="text-muted py-3">Recent Posts</h5>
                            <ul class="list-unstyled">
                                @foreach ($recentPosts as $recentPost)
                                    <li class="mb-1 pb-3">
                                        <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($recentPost->user->name)), $recentPost->user->id]) }}"
                                            class="nav-link d-inline">
                                            <img src="{{ asset('storage/profile_images/' . $recentPost->user->profile_image) }}"
                                                alt="User Profile" class="rounded-circle me-2" width="20"
                                                height="20">
                                        </a>
                                        <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($recentPost->user->name)), $recentPost->user->id]) }}"
                                            class="nav-link d-inline">
                                            <small class="text-dark fw-medium">{{ $recentPost->user->name }}</small>
                                        </a>
                                        <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($recentPost->user->name)), Str::slug($recentPost->title) . '-' . $recentPost->id]) }}"
                                            class="text-dark text-decoration-none">
                                            <p class="fs-6 fw-medium pt-1 pb-0 mb-0">{{ $recentPost->title }}</p>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            <small
                                                class="text-muted me-2">{{ $recentPost->created_at->diffForHumans() }}</small>
                                            <i class="bi bi-dot text-secondary"></i>
                                            <small class="text-muted me-2">
                                                {{ $recentPost->readingTime }} min read
                                            </small>
                                        </div>
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
