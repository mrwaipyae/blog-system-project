@extends('layouts/master')
@section('content')
@include('layouts/nav')
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 overflow-auto pt-4 border-end">
                <div class="d-flex align-items-center mb-5">
                    <h1 class="fs-1 fw-bold me-2">{{ $user->name }}</h1>
                </div>

                @foreach($userPosts as $post)
                    <div class="mb-4">
                        <a href="{{ route('post.view', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}"
                            class="text-decoration-none text-black">
                            <div class="row">


                                <div class="col-md-8">
                                    <p class="text-muted">
                                        {{ date("F j", strtotime($post->created_at)) }}
                                    </p>
                                    <!-- <div class="d-flex align-items-center mb-2">
                                        <a href="">
                                            <img src="{{ asset('storage/profile_images/'.$post->user->profile_image) }}"
                                                alt="User Profile" class="rounded-circle me-2" width="30" height="30">
                                        </a>
                                        <a href="" class="nav-link">
                                            <p class="m-0">{{ $post->user->name }}</p>
                                        </a>

                                    </div> -->



                                    <h5>{{ $post->title }}</h5>

                                    <p class="text-gray" id="post-content">
                                        @php
                                            $content = strip_tags($post->content);
                                            $words = str_word_count($content, 1);
                                            $limitedWords = array_slice($words, 0, 20);
                                            $limitedContent = implode(' ', $limitedWords);

                                        @endphp
                                        {!! $limitedContent . "..." !!}
                                        <!-- {!! Str::limit(strip_tags($post->content), $limit = 150, $end = '...') !!} -->
                                    </p>
                                    <div class="row pt-2">
                                        <div class="col-md-10 d-flex align-items-center">
                                            @foreach($post->tags as $tag)
                                                <a class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 mx-1"
                                                    href="{{ route('tag.show',$tag->name) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                            <span id="reading-time" class="text-secondary"></span>
                                        </div>
                                        <div class="col-md-2 dropdown dropend">
                                            <a class="" href="#" role="button" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-three-dots fs-4 text-secondary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="More"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-dark"
                                                aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('post.edit',$post->id) }}">Edit
                                                        Post</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deletePostModal{{ $post->id }}">Delete
                                                        Post</a>
                                                </li>
                                            </ul>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    @if($post->image)
                                        <img src="{{ asset('img/' . $post->image) }}"
                                            alt="{{ $post->title }}" class="img-thumbnail" style="height: 70%;">
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    <hr>
                    <!-- Delete Post Modal -->
                    <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('post.destroy', $post->id) }}"
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
            </div>
            <div class="col-md-4 col-lg-4">
                circular Profile image
            </div>
        </div>
    </div>
</section>
<script>
    // Get the post content element
    const postContent = document.querySelector('#post-content');

    // Calculate the reading time
    const wordsPerMinute = 200; // Change this value as desired
    const postContentText = postContent.textContent.trim();
    const wordCount = postContentText.split(/\s+/g).length;
    const readingTimeMinutes = Math.ceil(wordCount / wordsPerMinute);

    // Display the reading time
    const readingTimeElement = document.querySelector('#reading-time');
    readingTimeElement.textContent = `${readingTimeMinutes} min read`;

</script>
@endsection
