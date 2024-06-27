<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Tambahkan use statement di sini
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as views;

class UserController extends Controller
{
    //
    // public function listBooks(): View
    // {
    //     $books = DB::table('books')->get(); // Mengambil semua data buku dari basis data
    //     // dd($books);

    //     // nama file di resources/views/user/listbooks
    //     return view('user.list_books', compact('books'));
    // }

    public function listBooks(Request $request, $selectedCategory = null): View
    {
        $categories = DB::table('categories')->get();
        $query = Book::query();

        // Memeriksa apakah ada pengguna yang terautentikasi
        if (auth()->check()) {
            // Jika pengguna adalah admin, maka tidak perlu menyaring berdasarkan user_id
            if (auth()->user()->type != 'admin') {
                // Jika bukan admin, hanya menampilkan buku yang dimiliki oleh user yang sedang login
                $query->where('user_id', Auth::id());
            }
        }

        // Menyaring berdasarkan kategori jika kategori dipilih
        if ($selectedCategory) {
            $query->where('category_id', $selectedCategory);
        }

        $books = $query->get();
                                                        
        return view('dashboard.index', compact('books', 'categories'));
    }



    

    public function createBookForm(): View
    {
        $categories = Category::all();
        return view('user.create', compact('categories'));
    }

    
    public function storeBook(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'pdf_file' => 'required|mimes:pdf|max:2048', // PDF file validation
            'cover_image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // Image file validation
        ]);

        // Handle file uploads
        $pdfPath = $request->file('pdf_file')->store('pdfs');
        $coverImagePath = $request->file('cover_image')->store('covers');

        // Create a new book record with the user_id
        Book::create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'pdf_path' => $pdfPath,
            'cover_image_path' => $coverImagePath,
            'user_id' => Auth::id(), // Get the authenticated user's ID
        ]);

        // $data = Book::create();
        // echo $data;

        return redirect()->route('listBooks')->with('status', 'Book added successfully!');
    }


    //controller hapus
    public function deleteBook($bookId)
    {
        $book = Book::find($bookId);

        if ($book) {
            $book->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    
    public function editBookForm($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all(); // Pastikan model Category sudah diimpor

        return view('user.edit_book', compact('book', 'categories'));
    }


    //controller edit
    public function updateBook(Request $request, $id)
    {
        // Validasi formulir pembaruan buku
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Mengambil buku yang akan diperbarui
        $book = Book::findOrFail($id);

        // Menyimpan perubahan pada buku
        $book->update([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        return redirect()->route('listBooks')->with('status', 'Book updated successfully!');
    }

    public function detailBook($id)
    {
        // Mengambil data buku berdasarkan ID
        $book = Book::find($id);

        // Mengecek apakah buku ditemukan
        if (!$book) {
            return abort(404); // Buku tidak ditemukan, tampilkan halaman 404
        }

        return view('user.detail_book', compact('book'));
    }   


    public function exportPdf($id)
    {
        $book = Book::find($id);
    
        if (!$book) {
            return abort(404);
        }
    
        // Load the view
        $view = views::make('user.export_pdf', compact('book'));
    
        // Convert the view to HTML
        $html = $view->render();
    
        // Generate PDF from HTML
        $pdf = PDF::loadHTML($html);
    
        // Download the PDF
        return $pdf->download('book_detail.pdf');
    }
}
