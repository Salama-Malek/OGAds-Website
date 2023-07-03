<!-- logos/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Logo</h1>

        <form action="{{ route('logos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
