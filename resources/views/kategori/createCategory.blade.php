<!-- resources/views/user/add_book.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Book Category') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('storeBookCategory') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="title">Buat category baru</label>
                                <input type="text" name="nama_category" id="nama_category" class="form-control" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Add Category</button>
                             <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('categories') }}'">Kembali ke daftar</button>
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

