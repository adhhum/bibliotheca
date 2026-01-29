@extends('layouts.app')

@section('title', 'Книги')
@section('nav_books', 'active')

@section('content')
    <h1 class="page-title">Kitablar</h1>
    <div class="page-subtitle">
        Oxumaq və yükləmək üçün kitablar.
    </div>

    @if($books->isEmpty())
        <p>Hələ ki heç bir kitab yoxdu..</p>
    @else
        <div class="list-grid">
            @foreach($books as $book)
                <article class="card">
                    <h2 class="card-title">
                        <a href="{{ route('books.show', $book) }}">
                            {{ $book->title }}
                        </a>
                    </h2>
                    <div class="card-meta">
                        @if($book->author)
                            Müəllif: {{ $book->author }} ·
                        @endif
                        Əlavə olunub: {{ $book->created_at->format('d.m.Y') }}
                    </div>
                    <div class="card-excerpt">
                        {{ \Illuminate\Support\Str::limit($book->description, 150) }}
                    </div>
                    <div style="margin-top: 8px; font-size: 13px;">
                        <a href="{{ route('books.show', $book) }}">Kitabı açmaq</a>
                        @if($book->pdf_path)
                            · <a href="{{ route('books.download', $book) }}">PDF yükləmək</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <div style="margin-top: 16px;">
            {{ $books->links() }}
        </div>
    @endif
@endsection