<?php

declare(strict_types=1);

namespace App\Models;

use App\IdeaStatus;
use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'links',
        'status',
    ];

    protected $casts = [
        'links' => 'array',
        'status' => IdeaStatus::class, // enum cast
    ];

    protected $attributes = [
        'status' => IdeaStatus::Pending->value,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(IdeaLike::class);
    }

    public function likedBy(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function likesCount(): int
    {
        return $this->likes()->count();
    }
}
