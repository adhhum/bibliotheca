@extends('layouts.app')

@section('title', 'Добавить книгу')

@section('content')
    <h1 class="page-title">Kitab əlavə etmək</h1>

    <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom:10px;">
            <label>Adı<br>
                <input type="text" name="title" value="{{ old('title') }}" style="width:100%;">
            </label>
            @error('title') <div style="color:red;font-size:12px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom:10px;">
            <label>Müəllif<br>
                <input type="text" name="author" value="{{ old('author') }}" style="width:100%;">
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>Təsvir<br>
                <textarea name="description" rows="3" style="width:100%;">{{ old('description') }}</textarea>
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>Online oxumaq üçün mətn (opsional)<br>
                <textarea name="text" rows="10" style="width:100%;">{{ old('text') }}</textarea>
            </label>
        </div>

        <div style="margin-bottom:10px;">
            <label>PDF-fayl (yükləmək üçün)<br>
                <input type="file" name="pdf">
            </label>
        </div>

        <button type="submit" class="btn-flat">Yadda saxlamaq</button>
    </form>
@endsection