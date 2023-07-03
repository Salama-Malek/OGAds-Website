@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Video</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('videos.update', $video) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="url">Video URL</label>
                <input type="text" name="url" id="url" class="form-control" value="{{ $video->url }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Video</button>
        </form>
    </div>
@endsection
