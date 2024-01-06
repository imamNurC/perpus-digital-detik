<!-- resources/views/user/edit_book.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Buku</h1>

        <form method="POST" action="{{ route('updateBook', ['id' => $book->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                            {{ $category->nama_category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $book->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $book->quantity }}" required>
            </div>


            <button type="submit" class="btn btn-success">Update Book</button>
            <button type="button" onclick="window.location.href='{{ route('listBooks') }}'">Kembali ke daftar</button>
        </form>
    </div>
@endsection
