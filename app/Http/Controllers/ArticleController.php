<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Главная страница: последние статьи и книги
    public function home()
    {
        $articles = Article::latest()->take(5)->get();
        $books    = Book::latest()->take(5)->get();

        return view('home', compact('articles', 'books'));
    }

    // Список статей (публично)
    public function index()
{
    $articles = Article::latest()->paginate(20);

    // Если мы в админке (URL начинается с admin/...), отдаём админский шаблон
    if (request()->is('admin/*')) {
        return view('admin.articles.index', compact('articles'));
    }

    // Иначе — публичный список статей
    return view('articles.index', compact('articles'));
}

    // Одна статья (публично)
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /* ================= Админка ================= */

    // Список статей в админке
    public function adminIndex()
    {
        $articles = Article::latest()->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    // Поскольку мы используем resource роуты, index() в админке у нас будет обычный index()
    // но отделять можно через префиксы роутов. Здесь оставим стандартный набор.

    // Переопределим index только для админки через route 'admin.articles.index'
    // Ловим это в routes/web.php: names('admin.articles')
    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body'    => 'required|string',
        ]);

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Статья создана');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body'    => 'required|string',
        ]);

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Статья обновлена');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('success', 'Статья удалена');
    }
}