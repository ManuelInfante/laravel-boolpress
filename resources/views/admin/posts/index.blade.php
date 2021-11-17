@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-start mb-4">
                <h1>Elenco posts</h1>
                <a href="{{ route('admin.posts.create') }}">
                    <button class="btn btn-primary mx-5">Create new post</button>
                </a>
            </div>

            @if (session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td>
                                <a href="{{route('admin.posts.show', $post->id)}}">
                                    <button class="btn btn-success">View post</button>
                                </a>
                                <a href="{{route('admin.posts.edit', $post->id)}}">
                                    <button class="btn btn-warning">Modify</button>
                                </a>
                                <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="d-inline-block delete-post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection