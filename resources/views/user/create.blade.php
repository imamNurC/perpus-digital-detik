<!-- resources/views/user/add_book.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Book') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('storeBook') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="pdf_file">PDF File</label>
                                <input type="file" name="pdf_file" id="pdf_file" class="form-control-file" accept=".pdf" required>
                            </div>

                            <div class="form-group">
                                <label for="cover_image">Cover Image</label>
                                <input type="file" name="cover_image" id="cover_image" class="form-control-file" accept=".jpeg, .jpg, .png" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Book</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('listBooks') }}'">Kembali ke daftar</button>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

