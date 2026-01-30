<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
    case Moderator = 'moderator';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::User => 'User',
            self::Moderator => 'Moderator',
            self::Admin => 'Administrator',
        };
    }

    public function isModerator(): bool
    {
        return $this === self::Moderator || $this === self::Admin;
    }

    public function isAdmin(): bool
    {
        return $this === self::Admin;
    }

    public function color(): string
    {
        return match ($this) {
            self::User => 'neutral',
            self::Moderator => 'warning',
            self::Admin => 'error',
        };
    }
}
