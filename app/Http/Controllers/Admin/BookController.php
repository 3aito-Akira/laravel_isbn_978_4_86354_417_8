<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Book;

class BookController extends Controller
{
    //
    public function index(): Collection {
        $books = Book::all();

        return $books;
    }

    public function show(string $id): Book {
        $book = Book::findOrFail($id);
        
        return $book;
    }

    public function create(): View {
        $categories = Category::all();

        return view('admin/book/create',['categories' => $categories]);
    }
}
