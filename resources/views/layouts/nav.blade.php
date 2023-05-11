@if(Auth::check())
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 py-2 mb-2  border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">InkSpire</a>
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
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.new') }}"><i
                                class="bi bi-pencil-square me-2"></i>Write</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link btn dropdown-toggle pb-1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('storage/profile_images/'.Auth::user()->profile_image) }}"
                                alt="User Profile" class="rounded-circle" width="35" height="35">
                        </a>
                        <ul class="dropdown-menu" style=" overflow-y: auto; left:-100px; top: 50px">
                            <li>
                                <a class="dropdown-item btn" data-bs-toggle="modal"
                                    data-bs-target="#logoutModal">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 py-2 mb-2 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">InkSpire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <form class="d-flex">
                            <div class="input-group">
                                <input class="form-control rounded-pill" type="search" placeholder="Search"
                                    aria-label="Search">
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.new') }}">
                            <i class="bi bi-pencil-square me-2"></i>Write
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link btn dropdown-toggle pb-1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('storage/profile_images/'.Auth::user()->profile_image) }}"
                                alt="User Profile" class="rounded-circle" width="35" height="35">
                        </a>
                        <ul class="dropdown-menu" style="overflow-y: auto; left:-100px; top: 50px">
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 py-2 mb-2 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">InkSpire</a>
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
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-pencil-square"></i>
                            Write
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="btn btn-success rounded-pill py-1" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Sign
                            up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


@endif
