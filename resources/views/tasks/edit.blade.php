@extends('layouts.app')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')
            <label>Judul Tugas</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required>

            <label>Deskripsi</label>
            <textarea name="description" rows="3">{{ old('description', $task->description) }}</textarea>

            <label>Kategori</label>
            <select name="category">
                @foreach (['Kuliah', 'Organisasi', 'Pribadi'] as $category)
                    <option @selected($task->category === $category)>{{ $category }}</option>
                @endforeach
            </select>

            <label>Tenggat Waktu</label>
            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">

            <label>
                <input type="checkbox" name="is_done" value="1" style="width:auto;" @checked($task->is_done)>
                Sudah selesai
            </label>

            <button class="btn" type="submit">Perbarui</button>
            <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Batal</a>
        </form>
    </div>
@endsection
