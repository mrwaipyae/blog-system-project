@extends('layouts/master')
@section('content')
    @include('layouts/nav')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto border-end py-5">
                    <div class="d-flex align-items-center mb-5 border-bottom pb-3">
                        <h1 class="fs-1 fw-bold me-2">{{ $user->name }}</h1>
                    </div>
                    @foreach ($posts as $post)
                        <div class="mb-4">
                            <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title) . '-' . $post->id]) }}"
                                class="text-decoration-none text-black">
                                <div class="row">

                                    <div class="col-md-8">
                                        <span class="text-muted me-2">{{ $post->created_at->diffForHumans() }}</span>
                                        <h5 class="pt-1">{{ $post->title }}</h5>
                                        <p class="text-gray">
                                            @php
                                                $content = strip_tags($post->content);
                                                $words = str_word_count($content, 1);
                                                $limitedWords = array_slice($words, 0, 20);
                                                $limitedContent = implode(' ', $limitedWords);
                                            @endphp
                                            {!! $limitedContent . '...' !!}
                                            <!-- {!! Str::limit(strip_tags($post->content), $limit = 150, $end = '...') !!} -->
                                        </p>
                                        <div class="d-flex align-items-center">
                                            @foreach ($post->tags as $tag)
                                                <a
                                                    class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 me-2">{{ $tag->name }}</a>
                                            @endforeach
                                            <span id="reading-time{{ $post->id }}"
                                                class="text-secondary fs-6 me-2">{{ $post->readingTime }} min read</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        @if ($post->image)
                                            <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}"
                                                class="img-fluid" style="height: 80%; width:90%">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <div class="col-md-4 col-lg-4 ps-4">
                    <div class="py-4 ps-3">
                        <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($user->name)), $user->id]) }}"
                            class="nav-link d-inline">
                            <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="User Profile"
                                class="rounded-circle me-2" width="90" height="90">
                        </a>
                        <p class="fw-medium fs-4 py-3 ps-3">{{ $user->name }}</p>
                        <div class="row d-flex align-items-center text-center border-bottom ms-3 py-5">
                            <div class="col-md-6">
                                <p class="fw-medium fs-5">{{ $totalPosts }}</p>
                                <h5>Total Posts</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="fw-medium fs-5">{{ $totalLikes }}</p>
                                <h5>Total Likes</h5>
                            </div>
                        </div>
                    </div>
                    <div class="sticky-top py-4 {{ Auth::check() ? 'top-0' : 'top-10' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row mb-3">
                            @foreach (App\Models\Tag::all() as $tag)
                                <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                    <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                        href="{{ route('tag.show', $tag->name) }}">{{ $tag->name }}</a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
