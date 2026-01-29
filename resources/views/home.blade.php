@extends('layouts.app')

@section('title', 'Онлайн-библиотека')
@section('nav_home', 'active')

@section('content')
    <h1 class="page-title">Online-kitabxana</h1>
    <div class="page-subtitle">
        Yeni məqalələr və əlavə olunmuş kitablar.
    </div>

    <div class="list-grid">
        <section>
            <h2 class="page-subtitle" style="margin-bottom: 10px;">Son məqalələr</h2>
            @forelse($articles as $article)
                <article class="card">
                    <h3 class="card-title">
                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                    </h3>
                    <div class="card-meta">
                        {{ $article->created_at->format('d.m.Y') }}
                    </div>
                    <div class="card-excerpt">
                        {{ \Illuminate\Support\Str::limit($article->excerpt ?: $article->body, 120) }}
                    </div>
                </article>
            @empty
                <p>Hələ ki məqalə yoxdu.</p>
            @endforelse
        </section>

        <section>
            <h2 class="page-subtitle" style="margin-bottom: 10px;">Yeni kitablar</h2>
            @forelse($books as $book)
                <article class="card">
                    <h3 class="card-title">
                        <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                    </h3>
                    <div class="card-meta">
                        @if($book->author)
                            Müəllif: {{ $book->author }} ·
                        @endif
                        Əlavə olunub: {{ $book->created_at->format('d.m.Y') }}
                    </div>
                    <div class="card-excerpt">
                        {{ \Illuminate\Support\Str::limit($book->description, 120) }}
                    </div>
                </article>
            @empty
                <p>Hələ ki kitab yoxdu.</p>
            @endforelse
        </section>
    </div>
@endsection