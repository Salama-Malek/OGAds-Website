<!-- users/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="form-group">
                <label for="player_id">Player ID</label>
                <input type="text" name="player_id" id="player_id" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
