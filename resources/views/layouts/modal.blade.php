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
                                 name="email" value="{{ old('email') }}" required autocomplete="email"
                                 autofocus>

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
                                 class="form-control @error('password') is-invalid @enderror" name="password" required
                                 autocomplete="current-password">

                             @error('password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="row mb-0">
                         <div class="col-md-8 offset-md-4">
                             <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>

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
                 <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
                         <label for="profile_image"
                             class="form-label">{{ __('Profile Image') }}</label>


                         <input id="profile_image" type="file"
                             class="form-control @error('profile_image') is-invalid @enderror" name="profile_image">

                         @error('profile_image')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
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
                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                             required autocomplete="new-password">
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
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

 <!-- auth check Modal for like and comment -->
 <div class="modal fade" id="authCheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="alertModalBoxLabel">You must be logged in to response this post!</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p>Please login or register to continue.</p>
             </div>
             <div class="modal-footer">
                 <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                 <a href="{{ route('register') }}" class="btn btn-success">Register</a>
             </div>
         </div>
     </div>
 </div>

 <!-- auth check Modal for write -->
 <div class="modal fade" id="authCheckWrite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="alertModalBoxLabel">You must be logged in to write your idea!</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p>Please login or register to continue.</p>
             </div>
             <div class="modal-footer">
                 <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                 <a href="{{ route('register') }}" class="btn btn-success">Register</a>
             </div>
         </div>
     </div>
 </div>
