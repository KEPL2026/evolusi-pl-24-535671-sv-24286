@extends('layouts.app')

@section('content')
    <form method="GET" style="margin-bottom:16px;">
        <select name="category" onchange="this.form.submit()">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
            @endforeach
        </select>
    </form>

    @forelse ($tasks as $task)
        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:start;">
                <div>
                    <strong style="{{ $task->is_done ? 'text-decoration:line-through;color:#888;' : '' }}">{{ $task->title }}</strong>
                    <div><span class="badge {{ $task->isOverdue() ? 'badge-overdue' : '' }}">{{ $task->category }}</span>
                        @if ($task->due_date)
                            &nbsp;Deadline: {{ $task->due_date->format('d M Y') }}
                        @endif
                    </div>
                    @if ($task->description)
                        <p style="color:#555; font-size:.9rem;">{{ $task->description }}</p>
                    @endif
                </div>
                <div style="text-align:right; white-space:nowrap;">
                    <form class="inline" method="POST" action="{{ route('tasks.toggle', $task) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-secondary" type="submit">{{ $task->is_done ? 'Batal selesai' : 'Selesai' }}</button>
                    </form>
                    <a class="btn btn-secondary" href="{{ route('tasks.edit', $task) }}">Edit</a>
                    <form class="inline" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Hapus tugas ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p>Belum ada tugas. Tambahkan tugas pertama Anda!</p>
    @endforelse
@endsection
