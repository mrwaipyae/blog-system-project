<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC - @yield('page_title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @section('script')
        
    @show
</head>
<body>
    <div class="container-fluid">
        
        <div class="row">
            <!-- left -->
            <div class="col-md-2 bg-brown text-white">
                <div class="text-center pt-2">
                    <img src="{{url('images/admin.jpg')}}" alt="" class="img img-fluid img-thumbnail accountImg" width="90">
                    <p class="text-center">Admin_Name</p>
                </div>                
                <nav class="adminNav">
                    <a href="#"><i class="bi bi-house me-1"></i>Dashboard</a>
                    <a href="{{url('admin/posts')}}"><i class="bi bi-clipboard-check me-1"></i>Post Management</a>
                    <a href="{{route('admin.categories')}}"><i class="bi bi-plus-circle me-1"></i>Category Management</a>
                    <a href="#"><i class="bi bi-key me-1"></i>User Management</a>
                    <a href="#"><i class="bi bi-brush me-1"></i>Tag management</a>
                    <a href="#"><i class="bi bi-justify me-1"></i>Reports</a>
                    <a href="#"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
                </nav>
            </div>

            <!-- right -->
            <div class="col-md-10 bg-white">
                <div class="row bg-dark">
                    <div class="col-md-6">
                        <h5 class="text-white text-start py-3">
                            <i class="bi bi-person-check-fill me-1"></i>Admin Pannel
                        </h5>
                    </div>

                    <div class="col-md-6">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                            <ul class="navbar-nav py-1 text-end">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="text-white">John</span>
                                        <i class="fa-solid fa-user-gear text-white"></i>
                                    </a>
                                    <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item text-white dpdetail" href="#">
                                            <i class="fa-solid fa-gear"></i>
                                            Setting                               
                                        </a></li>
                                        <li><a class="dropdown-item text-white dpdetail" href="#">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            Logout
                                        </a></li>
                                    </ul>                                
                                </li>
                            </ul>
                        </nav>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                    @section('content')
                        
                    @show
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
  ></script>
 
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"
  ></script>
</body>
</html>