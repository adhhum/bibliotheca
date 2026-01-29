@extends('layouts.app')

@section('title', 'Редактировать статью')

@section('content')
    <h1 class="page-title">Məqaləni redəktə etmək: {{ $article->title }}</h1>

    <form action="{{ route('admin.articles.update', $article) }}" method="post">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <label>Başlıq<br>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" style="width:100%;">
            </label>
            @error('title') <div style="color:red;font-size:12px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom:10px;">
            <label>Qısa məlumat (opsional)<br>
                <textarea name="excerpt" rows="3" style="width:100%;">{{ old('excerpt', $article->excerpt) }}</textarea>
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>Məqalənin mətni<br>
                <textarea name="body" rows="12" style="width:100%;">{{ old('body', $article->body) }}</textarea>
            </label>
            @error('body') <div style="color:red;font-size:12px;">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-flat">Dəyişiklikləri yadda saxlamaq</button>
    </form>

    <form action="{{ route('admin.articles.destroy', $article) }}" method="post" style="margin-top:16px;">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="btn-flat"
                onclick="return confirm('Точно удалить статью?');">
            Məqaləni silmək
        </button>
    </form>
@endsection