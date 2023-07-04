@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Player ID</th>
                    <th>Completed Offer</th> <!-- Added column header -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->player_id }}</td>
                        <td>{{ $user->completed_offer ? 'Yes' : 'No' }}</td> <!-- Display completed_offer -->
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
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
