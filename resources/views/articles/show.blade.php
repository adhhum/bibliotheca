@extends('layouts.app')

@section('title', $article->title)
@section('nav_articles', 'active')

@section('content')
    <div class="reading-layout">
        <h1 class="reading-title">{{ $article->title }}</h1>
        <div class="reading-meta">
            Nəşr olunub: {{ $article->created_at->format('d.m.Y') }}
        </div>

        <div class="reading-body">
            {!! nl2br(e($article->body)) !!}
        </div>
    </div>
@endsection