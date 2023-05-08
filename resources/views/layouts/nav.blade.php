<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @section('link')

    @show
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
                            <a class="nav-link" href="{{ route('post.new') }}"><i
                                    class="bi bi-pencil-square me-2"></i>Write</a>
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
    @section('content')

    @show

</body>

</html>
