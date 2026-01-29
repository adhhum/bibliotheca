@extends('layouts.app')

@section('title', 'Админка — статьи')

@section('content')
    <h1 class="page-title">Adminka: məqalələr</h1>
    <div class="page-subtitle">
        Burda məqalə əlavə etmək, dəyişiklik etmək, silmək olar.
    </div>

    <div style="margin-bottom: 12px;">
        <a href="{{ route('admin.articles.create') }}" class="btn-flat">+ Məqalə əlavə etmək</a>
    </div>

    @if($articles->isEmpty())
        <p>Hələ ki heç bir məqalə yoxdu.</p>
    @else
        <table style="width:100%; border-collapse: collapse; font-size: 14px;">
            <thead>
            <tr style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                <th style="text-align:left; padding:6px 4px;">ID</th>
                <th style="text-align:left; padding:6px 4px;">Başlıq</th>
                <th style="text-align:left; padding:6px 4px;">Qısa</th>
                <th style="text-align:left; padding:6px 4px;">Tarix</th>
                <th style="text-align:left; padding:6px 4px;">Hərəkətlər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                    <td style="padding:6px 4px;">{{ $article->id }}</td>
                    <td style="padding:6px 4px;">
                        <a href="{{ route('articles.show', $article) }}" target="_blank">
                            {{ $article->title }}
                        </a>
                    </td>
                    <td style="padding:6px 4px;">
                        {{ \Illuminate\Support\Str::limit($article->excerpt ?: $article->body, 40) }}
                    </td>
                    <td style="padding:6px 4px;">
                        {{ $article->created_at->format('d.m.Y') }}
                    </td>
                    <td style="padding:6px 4px;">
                        <a href="{{ route('admin.articles.edit', $article) }}">Redəktə etmək</a>
                        ·
                        <form action="{{ route('admin.articles.destroy', $article) }}"
                              method="post"
                              style="display:inline;"
                              onsubmit="return confirm('Məqaləni silmək, dəqiq?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="background:none;border:none;color:#8b5b2b;cursor:pointer;padding:0;">
                                Silmək
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="margin-top: 16px;">
            {{ $articles->links() }}
        </div>
    @endif
@endsection