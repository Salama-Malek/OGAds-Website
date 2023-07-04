@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="player_id">Player ID</label>
            <input type="text" name="player_id" id="player_id" class="form-control" value="{{ $user->player_id }}" required>
        </div>

        <div class="form-group">
            <label for="completed_offer">Completed Offer</label>
            <input type="checkbox" name="completed_offer" id="completed_offer" value="1" {{ $user->completed_offer ? 'checked' : '' }}>
        </div>


        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection