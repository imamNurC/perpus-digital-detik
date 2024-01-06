@extends('layouts.app')

@section('content')
    <h1>Daftar Kategori Buku</h1>

    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->nama_category }}</td>
                    <td>
                        <!-- Add delete confirmation using a form -->
                        <form action="{{ route('deleteBookCategory', ['id' => $category->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('editBookCategoryForm', ['id' => $category->id]) }}" class="btn btn-success">Edit</a>
                    </td>
                </tr>
            @endforeach
        
            <button type="submit" class="btn btn-primary" onclick="window.location.href='{{ route('createBookCategory') }}'">Tambah List Category</button>
            <button type="submit" class="btn btn-secondary" onclick="window.location.href='{{ route('listBooks') }}'">Master Data buku</button>

        </tbody>
    </table>

    <script>
        // Add your JavaScript functions here
    </script>
@endsection
