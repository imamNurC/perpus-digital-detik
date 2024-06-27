<!-- resources/views/buku/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Buku, {{ auth()->user()->name }}</h1>

    <label for="kategori">Filter Kategori:</label>
    <select name="kategori" id="kategori">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
        @endforeach
    </select>
    <button type="button" onclick="filterByCategory()">Filter</button>

    <br>
    <br>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Cover Buku  </th>
                <th scope="col">Judul Buku </th>
                <th scope="col">Kategori   </th>
                <th scope="col">Deskripsi  </th>
                <th scope="col">Jumlah     </th>
                <th scope="col">Action     </th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $buku)
                <tr>
                    <td><img src="{{ asset($buku->cover_image_path) }}" width="50" height="50"></td>
                    <td>{{ $buku->title }}</td>
                    <td>{{ $buku->category ? $buku->category->nama_category : 'Tidak ada kategori' }}</td>
                    <td>{{ $buku->description }}</td>
                    <td>{{ $buku->quantity }}</td>
                    <td>
                        <a href="{{ route('detailBook', ['id' => $buku->id]) }}" class="btn btn-info">Detail</a>
                        <button class="btn btn-danger"  onclick="deleteBook({{ $buku->id }})">Delete</button>
                        <a href="{{ route('editBookForm', ['id' => $buku->id]) }}" class="btn btn-success">Edit</a>
                    </td>
                    
                </tr>
            @endforeach
            
            <button type="submit" class="btn btn-primary" onclick="window.location.href='{{ route('createBook') }}'">Tambah List buku</button>
            <button type="submit" class="btn btn-secondary" onclick="window.location.href='{{ route('categories') }}'">Master Data Kategori buku</button>
            <br>
            <br>
        </tbody>
        
    </table>

    <script>
        function filterByCategory() {
            var selectedCategory = document.getElementById('kategori').value;

            // Menentukan base URL berdasarkan tipe pengguna

            // auth()->check() && auth()->user()->type == 'admin' ? route('listBooks') :
            var baseUrl = "{{  route('listBooks') }}";
            
            // Membuat URL dengan parameter kategori
            var url = selectedCategory ? baseUrl + '/' + selectedCategory : baseUrl;

            // Mengarahkan ke URL yang dibuat
            window.location.href = url;
        }

         // Fungsi untuk menghapus buku
        // Fungsi untuk menghapus buku
        function deleteBook(bookId) {
            // Konfirmasi pengguna sebelum menghapus
            var confirmDelete = confirm('Apakah Anda yakin ingin menghapus buku ini?');

            if (confirmDelete) {
                // Mengirim permintaan AJAX untuk menghapus buku
                fetch("{{ url('/delete-book') }}/" + bookId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh halaman setelah menghapus buku
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus buku.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }



    </script>
@endsection
