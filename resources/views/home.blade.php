@extends('layouts.master')
@section('content')
    @include('layouts.nav')
    <section class="">
        <div class="container">
            <div class="row">
                <!-- main content -->
                <div class="col-md-8 col-lg-8 overflow-auto border-end py-5 pe-4">
                    @foreach ($posts as $post)
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <span class="text-muted mb-3">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                    <div class="d-flex align-items-center mb-2">
                                        <a
                                            href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                                            <img src="{{ $post->user->profile_image ? asset('storage/profile_images/' . $post->user->profile_image) : 'https://example.com/default-profile-image.jpg' }}"
                                                alt="User Profile" class="rounded-circle me-2" width="30"
                                                height="30">
                                        </a>
                                        <a href="" class="nav-link">
                                            <p class="m-0">{{ $post->user->name }}</p>
                                        </a>
                                    </div>
                                    <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title) . '-' . $post->id]) }}"
                                        class="text-decoration-none text-black">
                                        <h5>{{ $post->title }}</h5>

                                        <p class="text-gray">
                                            @php
                                                $content = strip_tags($post->content);
                                                $words = str_word_count($content, 1);
                                                $limitedWords = array_slice($words, 0, 20);
                                                $limitedContent = implode(' ', $limitedWords);
                                            @endphp
                                            {!! $limitedContent . '...' !!}
                                        </p>
                                    </a>
                                    <div class="d-flex align-items-center">

                                        @foreach ($post->tags as $tag)
                                            <a href="{{ route('tag.show', $tag->name) }}"
                                                class="btn btn-secondary btn-sm rounded-pill px-2 py-0 me-2">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                        <i class="bi bi-dot text-secondary"></i>
                                        <span id="reading-time{{ $post->id }}"
                                            class="text-secondary fs-6 me-2">{{ $post->readingTime }} min read</span>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    @if ($post->image)
                                        <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}"
                                            class="img-fluid" style="width:80%; height:70%">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <!-- Category section -->
                <div class="col-md-4 col-lg-4 ps-4 py-3">
                    <div class="sticky-top {{ Auth::check() ? 'top-0' : 'top-30' }}">
                        <!-- trending post -->
                        <div class="py-3">
                            <h5 class="text-muted py-1"><i class="bi bi-graph-up-arrow fs-5 me-3"></i>Trending Posts</h5>
                            <ul class="list-unstyled">
                                @foreach ($popularPosts as $popularPost)
                                    <li class="mb-2 py-2">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($popularPost->user->name)), $popularPost->user->id]) }}"
                                                class="">
                                                <img src="{{ asset('storage/profile_images/' . $popularPost->user->profile_image) }}"
                                                    alt="User Profile" class="rounded-circle me-2" width="20"
                                                    height="20">
                                            </a>
                                            <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($popularPost->user->name)), $popularPost->user->id]) }}"
                                                class="nav-link d-inline">
                                                <small class="text-dark fw-medium">{{ $popularPost->user->name }}</small>
                                            </a>
                                        </div>
                                        <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($popularPost->user->name)), Str::slug($popularPost->title) . '-' . $popularPost->id]) }}"
                                            class="text-dark text-decoration-none">
                                            <p class="fs-6 fw-medium py-0 my-0">{{ $popularPost->title }}</p>
                                        </a>
                                        <small>{{ $popularPost->created_at->diffForHumans() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Topics -->
                        <div class="border-top py-4">
                            <h5 class="mb-3">Discover more of what matters to you</h5>
                            <div class="row mb-3 pt-2">
                                @foreach (App\Models\Tag::all() as $tag)
                                    <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                        <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                            href="{{ route('tag.show', $tag->name) }}">{{ $tag->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Recent post -->
                        <div class="border-top py-3">
                            <h5 class="text-muted pt-3"><i class="bi bi-clock-history me-2 fs-5"></i>Recent Posts</h5>
                            <ul class="list-unstyled">
                                @foreach ($recentPosts as $recentPost)
                                    <li class="mb-1 py-2">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($recentPost->user->name)), $recentPost->user->id]) }}"
                                                class="">
                                                <img src="{{ asset('storage/profile_images/' . $recentPost->user->profile_image) }}"
                                                    alt="User Profile" class="rounded-circle me-2" width="20"
                                                    height="20">
                                            </a>
                                            <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($recentPost->user->name)), $recentPost->user->id]) }}"
                                                class="nav-link d-inline">
                                                <small class="text-dark fw-medium">{{ $recentPost->user->name }}</small>
                                            </a>
                                        </div>
                                        <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($recentPost->user->name)), Str::slug($recentPost->title) . '-' . $recentPost->id]) }}"
                                            class="text-dark text-decoration-none">
                                            <p class="fs-6 fw-medium pt-1 pb-0 mb-0">{{ $recentPost->title }}</p>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            <small
                                                class="text-muted me-2">{{ $recentPost->created_at->diffForHumans() }}</small>
                                            <i class="bi bi-dot text-secondary"></i>
                                            <small class="text-muted me-2">
                                                {{ $recentPost->readingTime }} min read
                                            </small>
                                        </div>
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
