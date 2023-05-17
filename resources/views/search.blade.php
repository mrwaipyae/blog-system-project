@extends('layouts/master')
@section('content')
    @include('layouts/nav')

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 overflow-auto border-end">
                    <h1 class="py-5 border-bottom"><span class="text-secondary">Results for</span> {{ $query }}</h1>
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="py-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center mb-2">
                                            <a
                                                href="{{ route('user.posts', ['@' . str_replace(' ', '', strtolower($post->user->name)), $post->user->id]) }}">
                                                <img src="{{ asset('storage/profile_images/' . $post->user->profile_image) }}"
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
                                        <div class="d-flex align-items-center p-3">
                                            <span class="text-muted me-2">
                                                {{ date('F j', strtotime($post->created_at)) }}
                                            </span>
                                            @foreach ($post->tags as $tag)
                                                <a class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0 mx-1"
                                                    href="{{ route('tag.show', $tag->name) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        @if ($post->image)
                                            <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->title }}"
                                                class="img-fluid" style="width:90%;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <p>No posts found.</p>
                    @endif
                </div>
                <div class="col-md-4 col-lg-4 py-5">
                    <div class="sticky-top {{ Auth::check() ? 'top-0' : 'top-30' }}">
                        <h5 class="mb-3">Discover more of what matters to you</h5>
                        <div class="row">
                            @foreach (App\Models\Tag::all() as $tag)
                                <div class="col-sm-4 col-md-3 col-lg-2 mx-3">
                                    <a class="btn btn-dark btn-sm mb-2 rounded-pill px-3"
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
