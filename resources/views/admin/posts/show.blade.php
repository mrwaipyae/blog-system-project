@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>By {{ $post->user->name }}</p>
    <hr>
    {!! $post->content !!}
</div>
@endsection
