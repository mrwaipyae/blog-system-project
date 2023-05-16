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
        transform: scale(1.3);
        color: black;
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
          <div id="alert-container"></div>
            <h2 class="mb-5">{{ $post->title }}</h2>
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('storage/profile_images/'.$post->user->profile_image) }}"
                    alt="User Profile" class="rounded-circle me-3" width="35" height="35">
                <div>
                    <h5 class="m-0">{{ $post->user->name }}</h5>
                    <span
                        class="text-muted">{{ date("F j", strtotime($post->created_at)) }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-5 border-top border-bottom py-2">
                {{-- @auth
                    <button id="like-btn" class="btn nav-link me-5">
                        <i class="bi bi-hand-thumbs-up me-1"></i> {{ $post->likes()->count() }}
                    </button>
                @else
                    <a href="" id="like-btn" class="btn nav-link me-5 " ><i
                            class="bi bi-hand-thumbs-up fs-5 me-1"></i>{{ $post->likes()->count() }}</a>
                @endauth --}}
                @auth
                  <button id="like-btn" class="btn nav-link me-5">
                  <i class="bi bi-hand-thumbs-up fs-5 me-1"></i> {{ $post->likes()->count() }}
                  </button>
                @else
                  <a href="" id="like-btn" class="btn nav-link me-5 ">
                  <i class="bi bi-hand-thumbs-up fs-5 me-1"></i>{{ $post->likes()->count() }}
                  </a>
                @endauth




                <button id="comment" class="btn nav-link ms-3" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="bi bi-chat me-1"></i>{{ $post->comments()->count() }}
                </button>
                <!-- Button trigger offcanvas -->

                <!-- Offcanvas -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Comment form -->
                        <form method="post" action="{{ route('comments.store') }}" id="comment-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label for="content" class="form-label">Add a comment</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                        <hr>

                        <!-- List of comments -->
                        <h6>Comments</h6>
                        <ul class="list-unstyled" id="comment-list">
                            @if($post->comments)
                                @foreach($post->comments as $comment)
                                    <li class="media my-4 border-bottom pb-2">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('storage/profile_images/'.$comment->user->profile_image) }}"
                                                width="35" height="35" alt="User Profile" class="rounded-circle me-2">
                                            <div>
                                                <h6 class="m-0">
                                                    {{ $comment->user->name }}
                                                </h6>
                                                <span
                                                    class="text-muted">{{ date("F j", strtotime($post->created_at)) }}</span>
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
    document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('#comment-form');
  const commentCount = document.querySelector('#comment');
  form.addEventListener('submit', function (event) {
    event.preventDefault(); // prevent form submission behavior
    const data = new FormData(form);
    axios.post("{{ route('comments.store',$post->id) }}", data)
      .then(function (response) {
        console.log(response.data.result); // log the response from the server
        const result = response.data.result;

        // Create a new comment element
        const newComment = document.createElement('li');
        newComment.classList.add('media', 'my-4', 'border-bottom', 'pb-2');
        newComment.innerHTML = `
          <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('storage/profile_images/${result.profile}') }}" width="35" height="35" alt="User Profile" class="rounded-circle me-2">
            <div>
              <h6 class="m-0">${result.user}</h6>
              <span class="text-muted">${result.date}</span>
            </div>
          </div>
          <div class="media-body">
            ${result.comment}
          </div>
        `;

        // Update the comments section with the new comment
        const commentList = document.querySelector('#comment-list');
        console.log(newComment);
        if (commentList.firstChild) {
          commentList.insertBefore(newComment, commentList.firstChild);
        } else {
          commentList.appendChild(newComment);
        }
        // Update the comment count
        commentCount.innerHTML = `<i class="bi bi-chat me-1"></i>${result.count}`;
        // Clear the comment form
        form.reset();
      })
      .catch(function (error) {
        console.log(error);
      });
  });
  
// document.getElementById('like-btn').addEventListener('click', function (e) {
//   e.preventDefault(); // prevent default form submission behavior
  
//   // Check if the user is authenticated
//   const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
  
//   // If the user is not authenticated, show the alert box with login and register buttons
//   if (!isAuthenticated) {
//      // Show the auth check modal
//     let loginModal = new bootstrap.Modal(document.getElementById('authCheck'), {});
//     loginModal.show();
//     return;
//   }
  
//   // If the user is authenticated, toggle the like button
//   this.classList.toggle('liked');
//   var icon = this.querySelector('i');
//   var isLiked = this.classList.contains('liked');
//   if (isLiked) {
//     icon.classList.replace('bi-hand-thumbs-up', 'bi-hand-thumbs-up-fill');
//   } else {
//     icon.classList.replace('bi-hand-thumbs-up-fill', 'bi-hand-thumbs-up');
//   }
  
//   // Make AJAX request
//   axios.post("{{ route('post.like', $post->id) }}")
//     .then(function (response) {
//       // Update like count
//       var likesCount = response.data.likes_count;
//       console.log('Number of likes: ' + likesCount);
//       document.getElementById('like-btn').innerHTML =
//         '<i class="bi ' + (isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up') + ' fs-5 me-1"></i> ' + likesCount;
//     })
//     .catch(function (error) {
//       console.log(error);
//     });
// });


// Check if the user is authenticated
const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

// Get the like button and its icon
const likeBtn = document.getElementById('like-btn');
const icon = likeBtn.querySelector('i');

// Check if the post has been liked before
const postId = {{ $post->id }};
let likedPosts = JSON.parse(localStorage.getItem('likedPosts')) || [];
let isLiked = likedPosts.includes(postId);
if (isLiked) {
  likeBtn.classList.add('liked');
  icon.classList.replace('bi-hand-thumbs-up', 'bi-hand-thumbs-up-fill');
} else {
  likeBtn.classList.remove('liked');
  icon.classList.replace('bi-hand-thumbs-up-fill', 'bi-hand-thumbs-up');
}

// Add event listener to the like button
likeBtn.addEventListener('click', function (e) {
  e.preventDefault(); // prevent default form submission behavior

  // If the user is not authenticated, show the alert box with login and register buttons
  if (!isAuthenticated) {
    // Show the auth check modal
    let loginModal = new bootstrap.Modal(document.getElementById('authCheck'), {});
    loginModal.show();
    return;
  }

  // Toggle the like button and its icon
  this.classList.toggle('liked');
  isLiked = this.classList.contains('liked');
  if (isLiked) {
    icon.classList.replace('bi-hand-thumbs-up', 'bi-hand-thumbs-up-fill');
    likedPosts.push(postId);
  } else {
    icon.classList.replace('bi-hand-thumbs-up-fill', 'bi-hand-thumbs-up');
    likedPosts = likedPosts.filter(id => id !== postId);
  }

  // Store the state of the like button
  localStorage.setItem('likedPosts', JSON.stringify(likedPosts));

  // Make AJAX request
  axios.post("{{ route('post.like', $post->id) }}")
    .then(function (response) {
      // Update like count
      var likesCount = response.data.likes_count;
      console.log('Number of likes: ' + likesCount);
      document.getElementById('like-btn').innerHTML =
        '<i class="bi ' + (isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up') + ' fs-5 me-1"></i> ' + likesCount;
    })
    .catch(function (error) {
      console.log(error);
    });
});

// Remove the like state from non-authenticated users
if (!{{ Auth::check() ? 'true' : 'false' }}) {
  localStorage.removeItem('likedPosts');
}


  let comment = document.getElementById('content');
  console.log(comment);
  comment.addEventListener('focus', function () {
    const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
    // Check if the user is authenticated
    if (!isAuthenticated) {
      // Show the auth check modal
      let loginModal = new bootstrap.Modal(document.getElementById('authCheck'), {});
      loginModal.show();
      return;
    }
  });
});

</script>
@endsection
