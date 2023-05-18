<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @section('link')

    @show
    <title>InkSpire - A place to share knowledge</title>
    <link rel="icon" type="image/png" href="{{ url('img/profile/pen.png') }}" />
    <link rel="stylesheet" href="{{ url('css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .top-30 {
            top: 120px !important;
        }

        nav li {
            margin-right: 1rem;
        }

        .navbar {
            position: relative;
            z-index: 1;
        }

        #search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 999;
            width: 100%;
            padding: 0;
            margin: 0;

            background-color: #fff;
            list-style-type: none;
        }

        #search-suggestions li {
            padding: 10px;
            border: 1px solid #ccc;
        }

        #search-suggestions li:last-child {
            border-bottom: 1px solid #ccc;
        }

        #search-suggestions li a {
            color: #333;
            text-decoration: none;
        }

        #search-suggestions li a:hover {
            color: #fff;
            background-color: #333;
        }
    </style>

</head>

<body>

    @section('content')

    @show
    @section('script')
    @show
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    @include('layouts.modal')
    @include('scripts.script')
    @include('scripts.cke')
</body>

</html>
