@extends('layouts.app')

@section('title', 'Админка — книги')

@section('content')
    <h1 class="page-title">Adminka: kitablar</h1>
    <div class="page-subtitle">
        Burda kitab əlavə etmək, dəyişiklik etmək, silmək olar.
    </div>

    <div style="margin-bottom: 12px;">
        <a href="{{ route('admin.books.create') }}" class="btn-flat">+ Kitab əlavə etmək</a>
    </div>

    @if($books->isEmpty())
        <p>Hələ ki heç bir kitab yoxdu.</p>
    @else
        <table style="width:100%; border-collapse: collapse; font-size: 14px;">
            <thead>
            <tr style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                <th style="text-align:left; padding:6px 4px;">ID</th>
                <th style="text-align:left; padding:6px 4px;">Başlıq</th>
                <th style="text-align:left; padding:6px 4px;">Müəllif</th>
                <th style="text-align:left; padding:6px 4px;">Yaradılıb</th>
                <th style="text-align:left; padding:6px 4px;">PDF</th>
                <th style="text-align:left; padding:6px 4px;">Hərəkətlər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                    <td style="padding:6px 4px;">{{ $book->id }}</td>
                    <td style="padding:6px 4px;">
                        <a href="{{ route('books.show', $book) }}" target="_blank">
                            {{ $book->title }}
                        </a>
                    </td>
                    <td style="padding:6px 4px;">{{ $book->author }}</td>
                    <td style="padding:6px 4px;">{{ $book->created_at->format('d.m.Y') }}</td>
                    <td style="padding:6px 4px;">
                        @if($book->pdf_path)
                            есть
                        @else
                            нет
                        @endif
                    </td>
                    <td style="padding:6px 4px;">
                        <a href="{{ route('admin.books.edit', $book) }}">Redəktə etmək</a>
                        ·
                        <form action="{{ route('admin.books.destroy', $book) }}"
                              method="post"
                              style="display:inline;"
                              onsubmit="return confirm('Kitabı silmək, dəqiq?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none;border:none;color:#8b5b2b;cursor:pointer;padding:0;">
                                Silmək
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="margin-top: 16px;">
            {{ $books->links() }}
        </div>
    @endif
@endsection