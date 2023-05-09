@extends('layouts/master')
@section('link')
<style>
.liked {
    animation-name: pulse;
    animation-duration: 0.5s;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.2);
        color: gold;
    }

    100% {
        transform: scale(1);
    }
}
    .content img{
        width: 100%;
    }
</style>
@endsection
@section('content')
@include('layouts/nav')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="mb-5">{{$post->title}}</h2>
            <div class="d-flex align-items-center mb-3">
                <img src="https://via.placeholder.com/50" alt="User Profile" class="rounded-circle me-2">
                <div>
                    <h5 class="m-0">{{$post->user->name}}</h5>
                    <span class="text-muted">{{date("F j", strtotime($post->created_at))}}</span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-5 border-top border-bottom py-2">
                @auth
                <button id="like-btn" class="btn nav-link me-5">
                    <i class="bi bi-hand-thumbs-up me-1"></i> {{ $post->likes()->count() }}
                </button>
                @else
                <a href="#" id="like-btn" class="btn nav-link me-5 " data-bs-toggle="modal" data-bs-target="#loginModal" ><i class="bi bi-hand-thumbs-up fs-5 me-1"></i>{{ $post->likes()->count() }}</a>
                @endauth
                
                
                
                <button class="btn nav-link ms-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight">
                <i class="bi bi-chat me-1"></i>{{$post->comments()->count()}}
                </button>
                <!-- Button trigger offcanvas -->
               
                <!-- Offcanvas -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Comments</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Comment form -->
                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label for="content" class="form-label">Add a comment</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <hr>

                        <!-- List of comments -->
                        {{-- {{ $comment->user->profile_image_url }} --}}
                        <h6>Comments</h6>
                        <ul class="list-unstyled">
                            @if ($post->comments)
                            @foreach ($post->comments as $comment)
                            <li class="media my-4 border-bottom pb-2">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://via.placeholder.com/50" width="35" height="35" alt="User Profile"
                                        class="rounded-circle me-2">
                                    <div>
                                        <h6 class="m-0">
                                            {{$comment->user->name}}
                                        </h6>
                                        <span class="text-muted">{{date("F j", strtotime($post->created_at))}}</span>
                                    </div>
                                </div>

                                <div class="media-body">
                                    {{ $comment->content }}
                                </div>
                                
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content">
                {!!$post->content!!}
            </div>
            
        </div>
    </div>
</div>

   

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
 

    document.addEventListener('DOMContentLoaded', function() {
    
        document.getElementById('like-btn').addEventListener('click', function(e) {
            e.preventDefault(); // prevent default form submission behavior
            this.classList.toggle('liked');
            // make AJAX request
            axios.post('{{ route('post.like', $post->id) }}')
                .then(function(response) {
                    // update like coun
                    var likesCount = response.data.likes_count;
                    console.log('Number of likes: ' + likesCount);
                    document.getElementById('like-btn').innerHTML = '<i class="bi bi-hand-thumbs-up fs-5 me-1"></i> ' + likesCount;
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
        let comment = document.getElementById('content');
        console.log(comment);
        comment.addEventListener('focus', function() {
            const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
            // Check if the user is authenticated
            if (!isAuthenticated) {
                // Show the login modal
                let loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {});
                loginModal.show();

            }
        });
    }); 

   
    

</script>
@endsection
