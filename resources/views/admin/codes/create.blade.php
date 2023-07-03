<!-- codes/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create code</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('codes.store') }}">
            @csrf

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create code</button>
        </form>
    </div>
@endsection
