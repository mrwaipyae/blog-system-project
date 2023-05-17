@extends('layouts/master')
@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .modal-backdrop.show {
            opacity: 0.5;
            pointer-events: none;
        }


        .liked,
        .unliked {
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

        .content img {
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
                    <a
                        href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                        <img src="{{ asset('storage/profile_images/' . $post->user->profile_image) }}" alt="User Profile"
                            class="rounded-circle me-3" width="40" height="40">
                    </a>

                    <div>
                        <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}"
                            class="nav-link">
                            <p class="fs-5 m-0 text-dark fw-medium">{{ $post->user->name }}</p>
                        </a>
                        <small class="text-muted">
                            {{ date('F j', strtotime($post->created_at)) }}
                        </small>
                        <i class="bi bi-dot text-secondary"></i>
                        <small id="reading-time{{ $post->id }}"
                            class="text-secondary fs-6 me-2">{{ $post->readingTime }} min read</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-5 border-top border-bottom py-2">
                    @auth
                        <button id="like-btn" class="btn nav-link me-5">
                            <i
                                class="bi {{ $post->isLikedByCurrentUser() ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} fs-5 me-1"></i>
                            {{ $post->likes()->count() }}
                        </button>
                    @else
                        <a href="" id="like-btn" class="btn nav-link me-5 ">
                            <i class="bi bi-hand-thumbs-up fs-5 me-1"></i>{{ $post->likes()->count() }}
                        </a>
                    @endauth

                    <!-- Button trigger offcanvas -->
                    <button id="comment" class="btn nav-link ms-3" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="bi bi-chat me-1"></i>{{ $post->comments()->count() }}
                    </button>


                    <!-- Offcanvas -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close">
                            </button>
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
                                @if ($post->comments)
                                    @foreach ($post->comments as $comment)
                                        <li class="media my-4 border-bottom pb-2">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ asset('storage/profile_images/' . $comment->user->profile_image) }}"
                                                    width="35" height="35" alt="User Profile"
                                                    class="rounded-circle me-2">
                                                <div>
                                                    <h6 class="m-0">
                                                        {{ $comment->user->name }}
                                                    </h6>
                                                    <span
                                                        class="text-muted">{{ date('F j', strtotime($post->created_at)) }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="media-body col-md-10">
                                                    {{ $comment->content }}
                                                </div>
                                                @if (Auth::check() && Auth::user()->id === $comment->user->id)
                                                    <div class="col-md-2 dropup">
                                                        <a class="" href="#" role="button"
                                                            id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots fs-4 text-secondary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="More"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-secondary"
                                                            aria-labelledby="dropdownMenuLink">
                                                            <li><a class="dropdown-item" href=""
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editCommentModal{{ $comment->id }}">Edit
                                                                    Comment</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteCommentModal{{ $comment->id }}">Delete
                                                                    Post</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif

                                            </div>
                                        </li>
                                        <div id="modal-container"></div>
                                        <!-- Edit comment Modal -->
                                        <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editTagModalLabel" aria-hidden="true"
                                            data-bs-backdrop="false">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTagModalLabel">Edit Tag</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('comment.edit', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="name"
                                                                    name="comment" value="{{ $comment->content }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete comment Modal -->
                                        <div class="modal fade" id="deleteCommentModal{{ $comment->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                            aria-hidden="true" data-bs-backdrop="false">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Comment?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('comment.destroy', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteComment(commentId) {
            const confirmation = confirm("Are you sure you want to delete this Comment?");
            if (confirmation) {
                // Perform the delete operation
                const form = document.createElement('form');
                form.action = "{{ route('comment.destroy', ':commentId') }}".replace(':commentId', commentId);
                form.method = 'POST';

                // Add CSRF token to form data
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Add _method input for DELETE request
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#comment-form');
            const commentCount = document.querySelector('#comment');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // prevent form submission behavior
                const data = new FormData(form);
                axios.post("{{ route('comments.store', $post->id) }}", data)
                    .then(function(response) {


                        const result = response.data.result;
                        console.log(result);
                        //////////////////////////////////////////////////



                        // Create a new comment element
                        const newComment = document.createElement('li');
                        newComment.classList.add('media', 'my-4', 'border-bottom', 'pb-2');
                        console.log(result.id);
                        newComment.innerHTML = `
                        <div class="d-flex align-items-center mb-3">
                          <img src="{{ asset('storage/profile_images/${result.profile}') }}" width="35" height="35" alt="User Profile" class="rounded-circle me-2">
                          <div>
                            <h6 class="m-0">${result.user}</h6>
                            <span class="text-muted">${result.date}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-10 media-body">
                            ${result.comment}
                          </div>
                          <div class="col-md-2 dropup">
                            <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bi bi-three-dots fs-4 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="More"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-secondary" aria-labelledby="dropdownMenuLink">
                              <li>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCommentModal${result.id}">
                                    Edit Post
                                  </a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" onclick="deleteComment(${result.id})">
                                  Delete Post
                                </a>
                              </li>
                            </ul>
                          </div>
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
                    .catch(function(error) {
                        console.log(error);
                    });
            });



            // Check if the user is authenticated
            const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
            // Get the like button and its icon
            const likeBtn = document.getElementById('like-btn');
            const icon = likeBtn.querySelector('i');
            // Add event listener to the like button
            likeBtn.addEventListener('click', function(e) {
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

                // var isLiked = {!! $post->isLikedByCurrentUser() ? 'true' : 'false' !!};
                // console.log(isLiked)
                var isLiked = icon.classList.contains('bi-hand-thumbs-up-fill');

                if (isLiked) {
                    // likeBtn.classList.add('liked');
                    icon.classList.replace('bi-hand-thumbs-up-fill', 'bi-hand-thumbs-up');

                } else {
                    // likeBtn.classList.remove('liked');
                    icon.classList.replace('bi-hand-thumbs-up', 'bi-hand-thumbs-up-fill');
                }

                // Make AJAX request
                axios.post("{{ route('post.like', $post->id) }}")
                    .then(function(response) {
                        // Update like count
                        var likesCount = response.data.likes_count;
                        console.log('Number of likes: ' + likesCount);
                        console.log(isLiked)
                        document.getElementById('like-btn').innerHTML =
                            '<i class="bi ' + (!isLiked ? 'bi-hand-thumbs-up-fill' :
                                'bi-hand-thumbs-up') + ' fs-5 me-1"></i> ' + likesCount;

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
                    // Show the auth check modal
                    let loginModal = new bootstrap.Modal(document.getElementById('authCheck'), {});
                    loginModal.show();
                    return;
                }
            });
        });
    </script>
@endsection

@endsection
