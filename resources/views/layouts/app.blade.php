<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Evolusi PL - Agenda Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: -apple-system, Arial, sans-serif; max-width: 800px; margin: 40px auto; background: #f5f6fa; color: #222; }
        header { display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px; }
        h1 { font-size: 1.4rem; }
        .card { background: #fff; border-radius: 8px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-bottom: 12px; }
        .btn { display:inline-block; padding: 8px 14px; border-radius: 6px; background:#4f46e5; color:#fff; text-decoration:none; border:none; cursor:pointer; font-size:.9rem; }
        .btn-secondary { background:#e5e7eb; color:#111; }
        .btn-danger { background:#dc2626; }
        .badge { display:inline-block; padding:2px 8px; border-radius:12px; font-size:.75rem; background:#eef2ff; color:#4338ca; }
        .badge-overdue { background:#fee2e2; color:#b91c1c; }
        .status { padding:10px; border-radius:6px; background:#dcfce7; color:#166534; margin-bottom:16px; }
        form.inline { display:inline; }
        input, textarea, select { width:100%; padding:8px; margin-top:4px; margin-bottom:12px; border:1px solid #d1d5db; border-radius:6px; }
        label { font-weight:600; font-size:.85rem; }
    </style>
</head>
<body>
    <header>
        <h1>📚 Agenda &amp; Tugas Mahasiswa</h1>
        <a class="btn" href="{{ route('tasks.create') }}">+ Tugas Baru</a>
    </header>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    @yield('content')
</body>
</html>
