@extends('layouts.app')

@section('title', 'Добавить статью')

@section('content')
    <h1 class="page-title">Məqalə əlavə etmək</h1>

    <form action="{{ route('admin.articles.store') }}" method="post">
        @csrf

        <div style="margin-bottom:10px;">
            <label>Başlıq<br>
                <input type="text" name="title" value="{{ old('title') }}" style="width:100%;">
            </label>
            @error('title') <div style="color:red;font-size:12px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom:10px;">
            <label>Qısa məlumat (opsional)<br>
                <textarea name="excerpt" rows="3" style="width:100%;">{{ old('excerpt') }}</textarea>
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>Məqalənin mətni<br>
                <textarea name="body" rows="12" style="width:100%;">{{ old('body') }}</textarea>
            </label>
            @error('body') <div style="color:red;font-size:12px;">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-flat">Yadda saxla</button>
    </form>
@endsection