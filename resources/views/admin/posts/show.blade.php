@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>{{$post->title}}</h1>
            <p class="my-5">{!! $post->content !!}</p>
            <h4>Slug: {{$post->slug}}</h4>
        </div>
    </div>
</div>
@endsection