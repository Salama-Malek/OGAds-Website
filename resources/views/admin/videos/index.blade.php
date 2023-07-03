@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Videos</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('videos.create') }}" class="btn btn-primary mb-3">Add Video</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->url }}</td>
                        <td>
                            <a href="{{ route('videos.edit', $video) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('videos.destroy', $video) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
