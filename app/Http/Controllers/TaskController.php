<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $query = Task::query()->orderBy('due_date');

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        if ($request->boolean('done_only')) {
            $query->where('is_done', true);
        }

        $tasks = $query->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'categories' => ['Kuliah', 'Organisasi', 'Pribadi'],
        ]);
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'due_date' => ['nullable', 'date'],
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('status', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'due_date' => ['nullable', 'date'],
            'is_done' => ['sometimes', 'boolean'],
        ]);

        $validated['is_done'] = $request->boolean('is_done');

        $task->update($validated);

        return redirect()->route('tasks.index')->with('status', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('status', 'Tugas berhasil dihapus.');
    }

    public function toggle(Task $task): RedirectResponse
    {
        $task->update(['is_done' => ! $task->is_done]);

        return redirect()->route('tasks.index');
    }
}
