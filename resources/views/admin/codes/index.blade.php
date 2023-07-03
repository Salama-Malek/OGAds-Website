@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>codes</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('codes.create') }}" class="btn btn-primary mb-3">Add code</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($codes as $code)
                    <tr>
                        <td>{{ $code->id }}</td>
                        <td>{{ $code->code }}</td>
                        <td>
                            <a href="{{ route('codes.edit', $code) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('codes.destroy', $code) }}" method="POST" class="d-inline">
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
