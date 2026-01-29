@extends('layouts.app')

@section('title', $book->title)
@section('nav_books', 'active')

@section('content')
    <div class="reading-layout">
        <h1 class="reading-title">{{ $book->title }}</h1>
        <div class="reading-meta">
            @if($book->author)
                Müəllif: {{ $book->author }} ·
            @endif
            Əlavə olunub: {{ $book->created_at->format('d.m.Y') }}
        </div>

        @if($book->description)
            <div class="reading-body" style="margin-bottom: 18px;">
                <p>{{ $book->description }}</p>
            </div>
        @endif

        <div style="margin-bottom: 16px; font-size: 14px;">
            @if($book->pdf_path)
                <a href="{{ route('books.read', $book) }}">
                    📖 Online oxumaq (PDF)
                </a>
                ·
                <a href="{{ route('books.pdf', $book) }}" target="_blank" rel="noopener">
                    🔎 PDF yeni tabda açmaq
                </a>
                ·
                <a href="{{ route('books.download', $book) }}">
                    ⬇️ PDF yükləmək
                </a>
            @else
                <span style="color:#7a7367;">PDF-fayl hələ ki əlavə olunmayıb.</span>
            @endif
        </div>
    </div>
@endsection