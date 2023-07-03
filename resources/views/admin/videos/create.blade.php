@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Video</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('videos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="url">Video URL</label>
                <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Video</button>
        </form>
    </div>
@endsection
