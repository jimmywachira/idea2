<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'avatar_path',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(IdeaLike::class);
    }

    // Role-based methods
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isModerator(): bool
    {
        return $this->role === UserRole::Moderator || $this->isAdmin();
    }

    public function isUser(): bool
    {
        return $this->role === UserRole::User;
    }

    public function ban(): void
    {
        $this->update([
            'is_banned' => true,
            'banned_at' => now(),
        ]);
    }

    public function unban(): void
    {
        $this->update([
            'is_banned' => false,
            'banned_at' => null,
        ]);
    }

    public function isBanned(): bool
    {
        return $this->is_banned;
    }
}
