@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-5">
                Modify post: {{$post->title}}
            </h1>
            <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="title">Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="content">Insert content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" type="text" name="content" id="content"> {!! old('content', $post->content) !!} </textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button class="btn btn-success" type="submit">Modify post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection