
@extends('admin.layouts.master')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h4>{{ $user->name }}</h4>
                <p>Email: {{ $user->email }}</p>
                <p>Total Posts: {{ $totalPosts }}</p>
            
                @foreach($userPosts as $post)
                <a href="{{ route('post.show', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}" class="text-decoration-none text-black">
                    <div class="row">
                        <div class="col-md-9">
                            <h5>{{ $post->title }}</h5>
                        
                            <p class="text-gray">
                                {!! Str::limit(strip_tags($post->content), $limit = 200, $end = '...') !!}
                            </p>
                            <div>
                                @foreach ($post->tags as $tag)
                                <a href="#" class="text-decoration-none text-black">
                                    <span class="badge bg-secondary text-center pb-2">{{ $tag->name }}</span>
                                </a>

                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            @if($post->image)
                                <img src="{{ asset('img/' . $post->image) }}"
                                    alt="{{ $post->title }}" class="img-thumbnail">
                            @endif
                        </div>
                    </div>
                </a>
                <hr>
                @endforeach
            </div>
        </div>
    </div>

@endsection

