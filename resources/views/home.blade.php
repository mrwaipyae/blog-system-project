@extends('layouts.master')
@section('content')

@include('layouts.nav')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 overflow-auto">
                @foreach($posts as $post)
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center mb-2">
                                    <a
                                        href="{{ route('user.posts',[ '@'.str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                                        <img src="{{ $post->user->profile_image ? asset('storage/profile_images/'.$post->user->profile_image) : 'https://example.com/default-profile-image.jpg' }}"
                                            alt="User Profile" class="rounded-circle me-2" width="30" height="30">
                                    </a>
                                    <a href="" class="nav-link">
                                        <p class="m-0">{{ $post->user->name }}</p>
                                    </a>
                                </div>
                                <a href="{{ route('post.view', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}"
                                    class="text-decoration-none text-black">
                                    <h5>{{ $post->title }}</h5>

                                    <p class="text-gray">
                                        @php
                                            $content = strip_tags($post->content);
                                            $words = str_word_count($content, 1);
                                            $limitedWords = array_slice($words, 0, 20);
                                            $limitedContent = implode(' ', $limitedWords);
                                        @endphp
                                        {!! $limitedContent . "..." !!}
                                    </p>
                                </a>
                                <div class="d-flex align-items-center">
                                    <span class="text-muted me-2">
                                        {{ date("F j", strtotime($post->created_at)) }}
                                    </span>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('tag.show',$tag->name) }}" class="btn btn-outline-dark btn-sm rounded-pill px-2 py-0 mx-1">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                @if($post->image)
                                    <img src="{{ asset('img/' . $post->image) }}"
                                        alt="{{ $post->title }}" class="img-fluid" style="height:80%; width:80%">
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>

                @endforeach
            </div>
            <div class="col-md-4 col-lg-4">
                <div
                    class="sticky-top {{ (Auth::check())?'top-0':'top-30' }}">
                    <div class="py-3">
                        <h5 class="text-muted py-1">Trending Posts</h5>
                        <ul class="list-unstyled">
                            @foreach($popularPosts as $popularPost)
                                <li class="mb-2 py-1">
                                    <img src="{{ asset('storage/profile_images/'.$popularPost->user->profile_image) }}"
                                        alt="User Profile" class="rounded-circle me-2" width="20" height="20">
                                    <span class="text-dark">{{ $popularPost->user->name }}</span>
                                    in
                                    @foreach($popularPost->tags as $tag)
                                        <span class="text-dark">{{ $tag->name }}</span>
                                    @endforeach
                                    <a href="" class="text-dark text-decoration-none">
                                        <p class="fs-6 fw-bold">{{ $popularPost->title }}</p>
                                    </a>
                                    <!-- <p class="text-muted mb-0">{{ $post->created_at->diffForHumans() }}</p> -->
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <h5 class="mb-3">Discover more of what matters to you</h5>
                    <div class="row mb-3">
                        @foreach(App\Models\Tag::all() as $tag)
                            <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                    href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="py-3">
                        <h5 class="text-muted py-1">Recent Posts</h5>
                        <ul class="list-unstyled">
                            @foreach($recentPosts as $post)
                                <li class="mb-3">
                                    <a href="" class="text-dark text-decoration-none">
                                        <h6>{{ $post->title }}</h6>
                                    </a>
                                    <p class="text-muted mb-0">{{ $post->created_at->diffForHumans() }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
