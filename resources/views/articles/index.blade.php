@extends('layouts.app')

@section('title', 'Статьи')
@section('nav_articles', 'active')

@section('content')
    <h1 class="page-title">Məqalələr</h1>
    <div class="page-subtitle">
        Bütün məqalələr.
    </div>

    @if($articles->isEmpty())
        <p>Hələ ki heç bir məqalə yoxdu.</p>
    @else
        <div class="list-grid">
            @foreach($articles as $article)
                <article class="card">
                    <h2 class="card-title">
                        <a href="{{ route('articles.show', $article) }}">
                            {{ $article->title }}
                        </a>
                    </h2>

                    <div class="card-meta">
                        {{ $article->created_at->format('d.m.Y') }}
                    </div>

                    <div class="card-excerpt">
                        {{ \Illuminate\Support\Str::limit($article->excerpt ?: $article->body, 150) }}
                    </div>
                </article>
            @endforeach
        </div>@extends('layouts.app')

@section('title', 'Статьи')
@section('nav_articles', 'active')

@section('content')
    <h1 class="page-title">Məqalələr</h1>
    <div class="page-subtitle">
        Materiallar və qeydlər.
    </div>

    @if($articles->isEmpty())
        <p>Hələ ki heç bir məqalə yoxdu.</p>
    @else
        <div class="list-grid">
            @foreach($articles as $article)
                <article class="card">
                    <h2 class="card-title">
                        <a href="{{ route('articles.show', $article) }}">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <div class="card-meta">
                        Nəşr olunub: {{ $article->created_at->format('d.m.Y') }}
                    </div>
                    <div class="card-excerpt">
                        {{ \Illuminate\Support\Str::limit($article->excerpt ?: $article->body, 150) }}
                    </div>
                </article>
            @endforeach
        </div>

        <div style="margin-top: 16px;">
            {{ $articles->links() }}
        </div>
    @endif
@endsection

        <div style="margin-top: 16px;">
            {{ $articles->links() }}
        </div>
    @endif
@endsection