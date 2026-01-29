@extends('layouts.app')

@section('title', $book->title . ' — читать онлайн')
@section('nav_books', 'active')

@section('content')
    <h1 class="page-title">{{ $book->title }}</h1>
    <div class="page-subtitle">
        @if($book->author) Müəllif: {{ $book->author }} · @endif
        PDF birbaşa saytda oxumaq
    </div>

    <div style="margin-bottom: 10px; font-size: 14px;">
        <a href="{{ route('books.show', $book) }}">← Geri kitaba</a>
        ·
        <a href="{{ route('books.pdf', $book) }}" target="_blank" rel="noopener">🔎 PDF açmaq</a>
        ·
        <a href="{{ route('books.download', $book) }}">⬇️ Yükləmək</a>
    </div>

    <div class="reading-layout" style="padding: 0; overflow: hidden; height: min(80vh, 720px);">
        <iframe
            src="{{ $pdfUrl }}#toolbar=1&navpanes=0"
            style="border: none; width: 100%; height: 100%; border-radius: 10px; overflow: hidden;"
            allow="fullscreen"
        ></iframe>
    </div>

    <div style="margin-top: 10px; font-size: 13px; color:#7a7367;">
        PDF göstərilmirsə: "PDF açmaq" aç və ya faylı yüklə.
    </div>
@endsection