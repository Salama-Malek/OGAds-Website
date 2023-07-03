@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit code</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('codes.update', $code) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $code->code }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update code</button>
        </form>
    </div>
@endsection
