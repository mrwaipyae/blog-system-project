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
    <style>
        .top-30 {
            top: 120px !important;
        }

    </style>
</head>

<body>
    @if(Auth::check())
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 py-3 mb-2 border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">InkSpire</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <form class="d-flex" role="search">
                    <div class="">
                        <input class="form-control me-2 rounded-pill" type="search" placeholder="Search"
                            aria-label="Search">
                    </div>

                </form>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-pencil-square me-2"></i>Write</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="" class="btn me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item btn" data-bs-toggle="modal"
                                        data-bs-target="#logoutModal">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @else
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
                            <a class="btn text-white nav-link rounded-pill px-3 bg-dark" data-bs-toggle="modal"
                                data-bs-target="#registerModal">Get Started</a>
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
                                <a class="btn text-white nav-link rounded-pill py-2 fs-5 bg-dark" href="#">Start
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
        <section class="py-5 border-bottom">
            <div class="container">
                <h2 class="mb-4">Popular Posts</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 text-muted">by <a href="#">John Doe</a> in <a href="#">Technology</a>
                                </div>
                                <h5 class="card-title mb-3">How to Build a Website from Scratch</h5>
                                <div class="mb-2"><small class="text-muted">May 4</small></div>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                                    gravida
                                    felis sed blandit ultrices. Suspendisse potenti.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 text-muted">by <a href="#">Jane Smith</a> in <a href="#">Culture</a>
                                </div>
                                <h5 class="card-title mb-3">The Art of Listening: A Guide to Active Listening</h5>
                                <div class="mb-2"><small class="text-muted">May 3</small></div>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                                    gravida
                                    felis sed blandit ultrices. Suspendisse potenti.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 text-muted">by <a href="#">David Lee</a> in <a href="#">Business</a>
                                </div>
                                <h5 class="card-title mb-3">10 Tips for Effective Time Management</h5>
                                <div class="mb-2"><small class="text-muted">May 2</small></div>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                                    gravida
                                    felis sed blandit ultrices. Suspendisse potenti.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat the above code block 3 more times for a total of 6 posts -->
                </div>
            </div>
        </section>
    @endif


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto">
                    @foreach($posts as $post)
                        <div>
                            <a href="{{ route('post.view', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}"
                                class="text-decoration-none text-black">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h5>{{ $post->title }}</h5>

                                        <p class="text-gray">
                                            {!! Str::limit(strip_tags($post->content), $limit = 200, $end = '...') !!}
                                        </p>
                                        <div>
                                            @foreach($post->tags as $tag)
                                                <a href="#" class="text-decoration-none text-black">
                                                    <span
                                                        class="badge bg-secondary text-center pb-2">{{ $tag->name }}</span>
                                                </a>

                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if($post->image)
                                            <img src="{{ asset('img/' . $post->image) }}"
                                                alt="{{ $post->title }}" class="img-thumbnail">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>

                        <hr>
                    @endforeach
                </div>
                <div class="col-md-4 col-lg-4">
                    <div
                        class="sticky-top {{ (Auth::check())?'top-0':'top-30' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row">
                            <div class="col-sm-6 col-md-12 col-lg-4">
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 1</button>
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 2</button>
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 3</button>
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-4">
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 4</button>
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 5</button>
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 6</button>
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-4">
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 7</button>
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 8</button>
                                <button type="button" class="btn btn-secondary btn-sm mb-2">Topic 9</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"
                                    class="btn btn-primary">{{ __('Login') }}</button>

                                @if(Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                autofocus>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm"
                                class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                class="btn btn-primary">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Confirm Logout
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
