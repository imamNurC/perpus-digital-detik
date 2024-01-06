<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoryController extends Controller
{
    public function listDataKategori()
    {
        $categories = Category::all();

        return view('kategori.data_kategori', compact('categories'));
    }

    public function createBookCategoryForm(): View
    {
        $categories = Category::all();
        return view('kategori.createCategory', compact('categories'));
    }

    public function storeBookCategory(Request $request)
    {
        // Validate the form data
        $request->validate([
            'nama_category' => 'required|string|max:255'
        ]);

        // Create a new book category record
        Category::create([
            'nama_category' => $request->input('nama_category'),
        ]);

        return redirect()->route('categories')->with('status', 'Category added successfully!');
    }

    public function deleteBookCategory(int $id): RedirectResponse
{
    // Find the category by ID and delete it
    $category = Category::find($id);

    if ($category) {
        $category->delete();
        return redirect()->route('categories')->with('status', 'Category deleted successfully!');
    } else {
        return redirect()->route('categories')->with('error', 'Category not found!');
    }
}

    public function editBookCategoryForm(int $id): View
    {
        $category = Category::find($id);

        if ($category) {
            return view('kategori.editCategory', compact('category'));
        } else {
            return redirect()->route('categories')->with('error', 'Category not found!');
        }
    }

    public function updateBookCategory(Request $request, int $id): RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'nama_category' => 'required|string|max:255',
        ]);

        // Find the category by ID and update it
        $category = Category::find($id);

        if ($category) {
            $category->update([
                'nama_category' => $request->input('nama_category'),
            ]);
            return redirect()->route('categories')->with('status', 'Category updated successfully!');
        } else {
            return redirect()->route('categories')->with('error', 'Category not found!');
        }
    }



}
