<!-- resources/views/user/detail_book.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container floating-detail">
        <h1 class="enlarged-font">Detail Buku</h1>

        <!-- Tampilkan detail buku di sini -->
        <div class="enlarged-font">
            <p><strong>Cover:</strong></p>
            <img src="{{ asset($book->cover_image_path) }}" width="100" height="100">

            <p><strong>Judul:</strong> {{ $book->title }}</p>
            <p><strong>Kategori:</strong> {{ $book->category ? $book->category->nama_category : 'Tidak ada kategori' }}</p>
            <p><strong>Deskripsi:</strong> {{ $book->description }}</p>
            <p><strong>Jumlah:</strong> {{ $book->quantity }}</p>
            <!-- Tambahkan informasi lain yang ingin Anda tampilkan -->
        </div>

        <!-- Tambahkan tombol untuk mengekspor PDF -->
        <a href="{{ route('exportPdf', ['id' => $book->id]) }}" class="btn btn-primary">Export as PDF</a>
        <button type="button" onclick="window.location.href='{{ route('listBooks') }}'">Kembali ke daftar</button>

    </div>
@endsection
