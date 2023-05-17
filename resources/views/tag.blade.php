@extends('layouts/master')

@section('content')
    @include('layouts/nav')

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto border-end">
                    <div class="d-flex align-items-center mb-5">
                        <h1 class="fs-1 fw-bold me-2">{{ $tag->name }}</h1><i class="bi bi-tag-fill fs-3"></i>
                    </div>
                    @if (isset($posts))
                        @foreach ($posts as $post)
                            <div class="mb-4">
                                <a href="{{ route('post.view', ['@' . str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title) . '-' . $post->id]) }}"
                                    class="text-decoration-none text-black">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center mb-2">
                                                <a
                                                    href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                                                    <img src="{{ asset('storage/profile_images/' . $post->user->profile_image) }}"
                                                        alt="User Profile" class="rounded-circle me-2" width="30"
                                                        height="30">
                                                </a>
                                                <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}"
                                                    class="nav-link">
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
                                                    <!-- {!! Str::limit(strip_tags($post->content), $limit = 150, $end = '...') !!} -->
                                                </p>
                                            </a>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="text-muted me-2">{{ date('F j', strtotime($post->created_at)) }}</span>
                                                <i class="bi bi-dot text-secondary"></i>
                                                <span id="reading-time{{ $post->id }}"
                                                    class="text-secondary fs-6 me-2">{{ $post->readingTime }} min
                                                    read</span>
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ route('tag.show', $tag->name) }}"
                                                        class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 mx-1">{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            @if ($post->image)
                                                <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}"
                                                    class="img-fluid" style="height: 80%;">
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <h3>There is no posts yet!</h3>
                    @endif

                </div>
                <!-- side navigation -->
                <div class="col-md-4 col-lg-4">
                    <div class="row d-flex align-items-center text-center border-bottom ms-3 py-5">
                        <div class="col-md-6">
                            <p class="fw-medium fs-5">{{ $totalPosts }}</p>
                            <h5>Total Posts</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="fw-medium fs-5">{{ $totalUsers }}</p>
                            <h5>Total Users</h5>
                        </div>
                    </div>

                    <div class="py-5 ps-2 sticky-top {{ Auth::check() ? 'top-0' : 'top-30' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row mb-3">
                            @foreach (App\Models\Tag::inRandomOrder()->limit(10)->get() as $tag)
                                <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                                    <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                        href="{{ route('tag.show', $tag->name) }}">
                                        {{ $tag->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <h1 class="mb-4">Top Writers</h1>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($topWriters as $writer)
                                <div class="d-flex align-items-center">
                                    <span class="fs-3 fw-bold text-secondary mx-3">{{ $no++ }}.</span>
                                    <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($writer->name)), $writer->id]) }}"
                                        class="nav-link d-inline">
                                        <img src="{{ asset('storage/profile_images/' . $writer->profile_image) }}"
                                            alt="User Profile" class="rounded-circle me-2" width="40" height="40">
                                    </a>
                                    <a href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($writer->name)), $writer->id]) }}"
                                        class="nav-link d-inline">
                                        <span class="d-inline fs-5 fw-medium">{{ $writer->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
