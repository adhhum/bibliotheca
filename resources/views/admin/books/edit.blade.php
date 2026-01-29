@extends('layouts.app')

@section('title', 'Редактировать книгу')

@section('content')
    <h1 class="page-title">Kitabı redəkət etmək: {{ $book->title }}</h1>

    <form action="{{ route('admin.books.update', $book) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <label>Adı<br>
                <input type="text" name="title" value="{{ old('title', $book->title) }}" style="width:100%;">
            </label>
            @error('title') <div style="color:red;font-size:12px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom:10px;">
            <label>Müəllif<br>
                <input type="text" name="author" value="{{ old('author', $book->author) }}" style="width:100%;">
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>Təsvir<br>
                <textarea name="description" rows="3" style="width:100%;">{{ old('description', $book->description) }}</textarea>
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>Online oxumaq üçün mətn (opsional)<br>
                <textarea name="text" rows="10" style="width:100%;">{{ old('text', $book->text) }}</textarea>
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>PDF-fayl (yenisin seçsən - köhnəsi dəyişiləcək)<br>
                <input type="file" name="pdf">
            </label>
            @if($book->pdf_path)
                <div style="font-size:13px;margin-top:4px;">
                    Hazırkı fayl: {{ $book->pdf_path }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn-flat">Dəyişiklikləri yadda saxlamaq</button>
    </form>

    <form action="{{ route('admin.books.destroy', $book) }}" method="post" style="margin-top:16px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-flat" onclick="return confirm('Точно удалить книгу?');">
            Kitabı silmək        </button>
    </form>
@endsection