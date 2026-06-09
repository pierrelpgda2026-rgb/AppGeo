<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GeoApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { background: #1a2942 !important; }
        .nav-link { color: #94a3b8 !important; }
        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .nav-link.active { background: rgba(59,130,246,0.2); border-radius: 6px; }
        .avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #3b82f6; color: #fff; font-size: 13px;
            font-weight: 600; display: flex; align-items: center; justify-content: center;
        }
    </style>
</head>
<body style="background: #f0f4f8;">

<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand text-white fw-semibold d-flex align-items-center" href="{{ url('/') }}">
        <span style="width:32px;height:32px;background:#3b82f6;border-radius:8px;
                     display:inline-flex;align-items:center;justify-content:center;margin-right:8px;">🌍</span>
        GeoApp
    </a>

    <button class="navbar-toggler border-secondary" type="button"
            data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon" style="filter:invert(1);"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav me-auto gap-1">
            <li class="nav-item">
                <a class="nav-link px-3 py-2 {{ request()->routeIs('types.*') ? 'active' : '' }}"
                   href="{{ route('types.index') }}">🏷️ Types</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 {{ request()->routeIs('lieux.*') ? 'active' : '' }}"
                   href="{{ route('lieux.index') }}">📍 Lieux</a>
            </li>
        </ul>

        @auth
        <div class="d-flex align-items-center gap-3">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <span class="text-secondary" style="font-size:13px;">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm"
                        style="background:rgba(239,68,68,0.15);color:#f87171;
                               border:1px solid rgba(239,68,68,0.3);">
                    ⏻ Déconnexion
                </button>
            </form>
        </div>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>