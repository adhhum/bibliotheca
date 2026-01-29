<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /* ============ Публичная часть ============ */

    public function pdf(Book $book)
    {
        if (!$book->pdf_path) {
            abort(404, 'PDF не прикреплён');
        }

        $fullPath = Storage::disk('public')->path($book->pdf_path);

        if (!file_exists($fullPath)) {
            abort(404, 'PDF файл не найден');
        }

        // Открыть в браузере (inline)
        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="book.pdf"',
        ]);
    }

    // Список книг
    public function index()
    {
        // берём книги
        $books = Book::latest()->paginate(20);

        // если URL начинается с admin/..., значит мы в админке
        if (request()->is('admin/*')) {
            return view('admin.books.index', compact('books'));
        }

        // иначе — обычная публичная страница
        return view('books.index', compact('books'));
    }

    // Страница книги
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Чтение онлайн
    public function read(Book $book)
    {
        if (!$book->pdf_path) {
            abort(404, 'Для этой книги нет PDF-файла.');
        }

        // iframe будет открывать маршрут, а не storage URL
        $pdfUrl = route('books.pdf', $book);

        return view('books.read', [
            'book' => $book,
            'pdfUrl' => $pdfUrl,
        ]);
    }

    // Скачивание PDF
    public function download(Book $book)
    {
        if (!$book->pdf_path) {
            abort(404, 'PDF не прикреплён');
        }

        $fullPath = Storage::disk('public')->path($book->pdf_path);

        if (!file_exists($fullPath)) {
            abort(404, 'PDF файл не найден');
        }

        // Скачать (attachment)
        return response()->download($fullPath, $book->title . '.pdf');
    }

    /* ============ Админка ============ */

    // список книг (используется в admin.books.index)
    public function indexAdmin()
    {
        $books = Book::latest()->paginate(20);

        return view('admin.books.index', compact('books'));
    }

    // Но так как у нас resource маршруты, реальный index для админки будет вот этот:
    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'text' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf',
        ]);

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('books', 'public');
        }

        $book = Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Книга создана');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'text' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf',
        ]);

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Книга обновлена');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Книга удалена');
    }
}