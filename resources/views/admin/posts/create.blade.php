@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-5">
                Create a new post
            </h1>
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                @method('POST')
                
                <div>
                    <label for="title">Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title')}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="content">Insert content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" type="text" name="content" id="content"> {!! old('content') !!} </textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button class="btn btn-success" type="submit">Create new post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
