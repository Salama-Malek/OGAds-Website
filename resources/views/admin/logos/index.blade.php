@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Logo Management</h1>

        <a href="{{ route('logos.create') }}" class="btn btn-primary">Add New Logo</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logos as $logo)
                <tr>
                    <td>{{ $logo->id }}</td>
                    <td><img src="{{ asset('storage/logos/' . $logo->image) }}" alt="Logo" style="max-width: 100px;"></td>
                    <td>
                        <a href="{{ route('logos.edit', $logo->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('logos.destroy', $logo->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this logo?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
