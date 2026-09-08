<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'due_date',
        'is_done',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_done' => 'boolean',
    ];

    public function isOverdue(): bool
    {
        return ! $this->is_done && $this->due_date?->isPast();
    }
}
