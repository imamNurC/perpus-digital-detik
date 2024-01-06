@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('updateBookCategory', ['id' => $category->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_category">Category Name:</label>
            <input type="text" name="nama_category" value="{{ $category->nama_category }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories') }}" class="btn btn-secondary mt-2">Back to Categories</a>

    </form>
    
@endsection
