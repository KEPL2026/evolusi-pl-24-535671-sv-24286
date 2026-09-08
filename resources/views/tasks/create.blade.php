@extends('layouts.app')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <label>Judul Tugas</label>
            <input type="text" name="title" value="{{ old('title') }}" required>

            <label>Deskripsi</label>
            <textarea name="description" rows="3">{{ old('description') }}</textarea>

            <label>Kategori</label>
            <select name="category">
                <option>Kuliah</option>
                <option>Organisasi</option>
                <option>Pribadi</option>
            </select>

            <label>Tenggat Waktu</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}">

            <button class="btn" type="submit">Simpan</button>
            <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Batal</a>
        </form>
    </div>
@endsection
