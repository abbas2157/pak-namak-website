<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Dashboard') | Pak Namak Dashboard</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Nastaliq+Urdu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body>
<div class="shell">
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <span>Pak Namak<br><small style="opacity:.7;font-weight:500">Dashboard</small></span>
        </a>
        <nav>
            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Overview</a>
            <a href="{{ route('admin.inquiries.index') }}" @class(['active' => request()->routeIs('admin.inquiries.*')])>
                Inquiries @if($unreadInquiries)<span class="badge-count">{{ $unreadInquiries }}</span>@endif
            </a>

            <div class="label">Catalogue</div>
            <a href="{{ route('admin.products.index') }}" @class(['active' => request()->routeIs('admin.products.*')])>Products</a>
            <a href="{{ route('admin.categories.index') }}" @class(['active' => request()->routeIs('admin.categories.*')])>Categories</a>

            <div class="label">Content</div>
            <a href="{{ route('admin.team.index') }}" @class(['active' => request()->routeIs('admin.team.*')])>Team</a>
            <a href="{{ route('admin.faqs.index') }}" @class(['active' => request()->routeIs('admin.faqs.*')])>FAQs</a>
            <a href="{{ route('admin.settings.edit') }}" @class(['active' => request()->routeIs('admin.settings.*')])>Site Settings</a>

            <div class="label">Account</div>
            <a href="{{ route('admin.account.edit') }}" @class(['active' => request()->routeIs('admin.account.*')])>My Account</a>
            <a href="{{ route('home') }}" target="_blank">View Website ↗</a>
        </nav>
    </aside>

    <div class="main">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:12px">
                <button class="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Menu">☰</button>
                <div class="title">@yield('title', 'Dashboard')</div>
            </div>
            <div class="actions">
                <span class="muted">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button class="btn btn-light btn-sm">Log out</button>
                </form>
            </div>
        </header>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">Please fix the highlighted fields below.</div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
