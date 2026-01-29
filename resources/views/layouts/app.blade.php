<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Онлайн-библиотека')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --paper-bg: #f4ecd4;
            --paper-dark: #e4d7b5;
            --text-main: #2b2620;
            --accent: #8b5b2b;
            --muted: #7a7367;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--paper-bg);
            color: var(--text-main);
            line-height: 1.6;
        }

        a { color: var(--accent); text-decoration: none; }
        a:hover { text-decoration: underline; }

        .page { min-height: 100vh; display: flex; flex-direction: column; }

        .site-header {
            border-bottom: 1px solid rgba(0,0,0,0.06);
            background: linear-gradient(to bottom, #f9f2dd, #f3e6c6);
        }
        .site-header-inner {
            max-width: 900px;
            margin: 0 auto;
            padding: 16px 16px 12px;
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 16px;
        }
        .logo {
            font-family: "Georgia", "Times New Roman", serif;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--accent);
        }
        .tagline {
            font-size: 13px;
            color: var(--muted);
        }
        .nav {
            display: flex;
            gap: 16px;
            font-size: 14px;
        }
        .nav a { padding-bottom: 3px; border-bottom: 1px solid transparent; }
        .nav a.active { border-bottom-color: var(--accent); }

        .content { flex: 1; }
        .content-inner {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 16px 40px;
        }

        .page-title {
            font-family: "Georgia", "Times New Roman", serif;
            font-size: 26px;
            margin-bottom: 8px;
        }
        .page-subtitle {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 24px;
        }

        .list-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 14px;
        }
        @media (min-width: 720px) {
            .list-grid {
                grid-template-columns: minmax(0, 1.5fr) minmax(0, 1.5fr);
            }
        }

        .card {
            background: #f9f1dc;
            border-radius: 8px;
            padding: 12px 14px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 1px 0 rgba(0,0,0,0.02);
        }
        .card-title {
            font-family: "Georgia", "Times New Roman", serif;
            font-size: 17px;
            margin: 0 0 4px;
        }
        .card-meta {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .card-excerpt { font-size: 14px; }

        .reading-layout {
            max-width: 780px;
            margin: 0 auto;
            background: #f9f1dc;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.06);
            padding: 22px 22px 26px;
            box-shadow: 0 16px 30px rgba(0,0,0,0.12),
                        0 0 0 1px rgba(255,255,255,0.4) inset;
        }
        .reading-title {
            font-family: "Georgia", "Times New Roman", serif;
            font-size: 26px;
            margin: 0 0 6px;
        }
        .reading-meta {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 18px;
        }
        .reading-body { font-size: 16px; text-align: left; }
        .reading-body p { margin: 0 0 12px; }
        .reading-body p + p { text-indent: 1.5em; }

        .site-footer {
            border-top: 1px solid rgba(0,0,0,0.06);
            font-size: 12px;
            color: var(--muted);
        }
        .site-footer-inner {
            max-width: 900px;
            margin: 0 auto;
            padding: 10px 16px 14px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .alert {
            padding: 8px 10px;
            background: #f7e6b5;
            border-radius: 6px;
            border: 1px solid rgba(0,0,0,0.1);
            font-size: 13px;
            margin-bottom: 12px;
        }
    </style>

    @stack('head')
</head>
<body>
<div class="page">
    <header class="site-header">
        <div class="site-header-inner">
            <div>
                <div class="logo">
                    Kitabxana
                </div>
                <div class="tagline">
                    Online kitab oxu, yüklə. Məqalə oxu
                </div>
            </div>
            <nav class="nav">
                <a href="{{ route('home') }}" class="@yield('nav_home')">Əsas</a>
                <a href="{{ route('articles.index') }}" class="@yield('nav_articles')">Məqalələr</a>
                <a href="{{ route('books.index') }}" class="@yield('nav_books')">Kitablar</a>
            </nav>
        </div>
    </header>

    <main class="content">
        <div class="content-inner">
            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <div>© {{ date('Y') }} Kitabxana</div>
            <div>Rahat oxumaq üçün.</div>
        </div>
    </footer>
</div>

@stack('scripts')
</body>
</html>