
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <style>
        /* You can add additional styling here if needed */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        p {
            margin-bottom: 10px;
        }
        /* .cover-image {
            max-width: 200px;
            max-height: 200px;
        } */
    </style>
</head>
<body>

<h1>Detail Buku</h1>

<p><strong>Cover:</strong></p>
{{-- <img src="{{ asset($book->cover_image_path) }}" class="cover-image"> --}}
<p><strong>Title:</strong> {{ $book->title }}</p>
<p><strong>Category:</strong> {{ $book->category ? $book->category->nama_category : 'Tidak ada kategori' }}</p>
<p><strong>Description:</strong> {{ $book->description }}</p>
<p><strong>Quantity:</strong> {{ $book->quantity }}</p>
<!-- Add any other information you want to include in the PDF -->

