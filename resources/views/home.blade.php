<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-2 py-3 mb-2 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">InkSpire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <form class="d-flex" role="search">
                <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
            </form>
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
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto">

                </div>
                <div class="col-md-4 col-lg-4">

                </div>
            </div>
        </div>
    </main>
</body>

</html>
