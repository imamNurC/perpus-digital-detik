<!-- resources/views/buku/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Buku</h1>

    <label for="kategori">Filter Kategori:</label>
    <select name="kategori" id="kategori">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
        @endforeach
    </select>
    <button type="button" onclick="filterByCategory()">Filter</button>


    <table>
        <thead>
            <tr>
                <th>Cover Buku |</th>
                <th>Judul Buku |</th>
                <th>Kategori   |</th>
                <th>Deskripsi  |</th>
                <th>Jumlah     |</th>
                <th>Action     |</th>
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
                    </td>
                    <td>
                        <!-- Tambahkan tombol Delete dengan memanggil fungsi deleteBook -->
                        <button class="btn btn-danger"  onclick="deleteBook({{ $buku->id }})">Delete</button>
                    </td>
                    <td>
                        <a href="{{ route('editBookForm', ['id' => $buku->id]) }}" class="btn btn-success">Edit</a>
                    </td>
                </tr>
            @endforeach
        
            <button type="submit" class="btn btn-primary" onclick="window.location.href='{{ route('createBook') }}'">Tambah List buku</button>
            <button type="submit" class="btn btn-secondary" onclick="window.location.href='{{ route('categories') }}'">Master Data Kategori buku</button>

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
