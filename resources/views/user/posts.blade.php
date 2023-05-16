@extends('layouts/master')
@section('content')
@include('layouts/nav')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 overflow-auto">
                <div class="d-flex align-items-center mb-5">
                    <h1 class="fs-1 fw-bold me-2">{{$user->name}}</h1>
                </div>
                @foreach($posts as $post)
                    <div class="mb-4">
                        <a href="{{ route('post.view', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}"
                            class="text-decoration-none text-black">
                            <div class="row">

                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="">
                                            <img src="{{ asset('storage/profile_images/'.$post->user->profile_image) }}"
                                                alt="User Profile" class="rounded-circle me-2" width="30" height="30">
                                        </a>
                                        <a href="" class="nav-link">
                                            <p class="m-0">{{ $post->user->name }}</p>
                                        </a>
                                    </div>
                                    <h5>{{ $post->title }}</h5>
                                    <p class="text-gray">
                                        @php
                                            $content = strip_tags($post->content);
                                            $words = str_word_count($content, 1);
                                            $limitedWords = array_slice($words, 0, 20);
                                            $limitedContent = implode(' ', $limitedWords);
                                        @endphp
                                        {!! $limitedContent . "..." !!}
                                        <!-- {!! Str::limit(strip_tags($post->content), $limit = 150, $end = '...') !!} -->
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="text-muted me-2">{{ date("F j", strtotime($post->created_at)) }}</span>
                                            <i class="bi bi-dot text-secondary"></i>
                                            <span id="reading-time{{$post->id}}" class="text-secondary fs-6 me-2">{{$post->readingTime}} min read</span>
                                        @foreach($post->tags as $tag)
                                            <a
                                                class="btn btn-secondary text-white btn-sm rounded-pill px-2 py-0">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    @if($post->image)
                                        <img src="{{ asset('img/' . $post->image) }}"
                                            alt="{{ $post->title }}" class="img-thumbnail" style="height: 80%;">
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="col-md-4 col-lg-4">
                <div
                    class="sticky-top {{ (Auth::check())?'top-0':'top-30' }}">
                    <h5 class="mb-3">Discover more of what matters to you</h5>
                    <div class="row mb-3">
                        @foreach(App\Models\Tag::all() as $tag)
                        <div class="col-sm-4 col-md-3 col-lg-2 mx-4">
                            <a class="btn btn-light btn-sm mb-2 rounded-pill px-2"
                                href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
