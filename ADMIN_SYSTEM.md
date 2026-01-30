# Admin Dashboard & Moderation System

## Overview

A complete role-based admin dashboard system with user management, content moderation, and comprehensive control over users, ideas, and comments.

## Features Implemented

### 1. **User Role System**

- **Admin**: Full platform control, access to all admin features
- **Moderator**: Can moderate content, manage flags, review user reports
- **User**: Regular platform user

### 2. **Admin Dashboard**

- Real-time statistics (total users, ideas, comments, banned users, pending flags)
- Quick access to all admin modules
- Recent activity monitoring (latest ideas, comments, pending flags)
- Color-coded metrics with DaisyUI components

### 3. **User Management**

- View all users with pagination (15 per page)
- Change user roles (user → moderator → admin → user)
- Ban/unban users
- User status indicators (Active/Banned)
- Avatar display with fallback initials
- Direct links to user profiles

### 4. **Content Moderation**

- **Ideas Management**: View, review, and delete inappropriate ideas
- **Comments Management**: View, review, and delete inappropriate comments
- **Flagged Content Queue**: Review user-reported content with status tracking
- Flag resolution workflow: Pending → Reviewed → Resolved/Dismissed

### 5. **Database Infrastructure**

- New `moderation_flags` table for tracking reported content
- Polymorphic relationships for flexible content reporting (Ideas or Comments)
- User role field with casting support
- Ban tracking with timestamps

## Installation & Setup

### 1. Run Migrations

```bash
php artisan migrate
```

This will:

- Add `role`, `is_banned`, and `banned_at` columns to the `users` table
- Create the `moderation_flags` table with polymorphic support

### 2. Seed Test Data

```bash
php artisan db:seed
```

This creates:

- **Admin User**: admin@example.com / password
- **Moderator User**: moderator@example.com / password
- **Regular Users**: test@example.com + 5 random users
- Test ideas and relationships

## Files Created

### Controllers

- `app/Http/Controllers/AdminController.php` - Main admin controller with all CRUD operations

### Middleware

- `app/Http/Middleware/AdminMiddleware.php` - Restricts access to admin routes

### Enums

- `app/Enums/UserRole.php` - User role definition with helper methods

### Views

- `resources/views/admin/dashboard.blade.php` - Main dashboard overview
- `resources/views/admin/users/index.blade.php` - User management interface
- `resources/views/admin/ideas/index.blade.php` - Ideas moderation interface
- `resources/views/admin/comments/index.blade.php` - Comments moderation interface
- `resources/views/admin/flags/index.blade.php` - Flagged content review queue
- `resources/views/layouts/app.blade.php` - Admin layout template

### Migrations

- `database/migrations/2025_01_29_000000_add_role_to_users_table.php`
- `database/migrations/2025_01_29_000001_create_moderation_flags_table.php`

## Routes

All admin routes are prefixed with `/admin` and require authentication + admin role:

```php
GET    /admin                          # Dashboard
GET    /admin/users                    # User management
POST   /admin/users/{user}/change-role # Change user role
POST   /admin/users/{user}/ban         # Ban user
POST   /admin/users/{user}/unban       # Unban user
GET    /admin/ideas                    # Ideas management
DELETE /admin/ideas/{idea}             # Delete idea
GET    /admin/comments                 # Comments management
DELETE /admin/comments/{comment}       # Delete comment
GET    /admin/flags                    # Flagged content queue
POST   /admin/flags/{flag_id}/resolve  # Resolve flag
POST   /admin/flags/{flag_id}/dismiss  # Dismiss flag
```

## User Model Methods

The `User` model includes these helper methods:

```php
// Check user role
$user->isAdmin()      // Returns boolean
$user->isModerator()  // Returns boolean (true for Moderator & Admin)
$user->isUser()       // Returns boolean

// Ban/unban user
$user->ban()          // Sets is_banned=true, banned_at=now()
$user->unban()        // Sets is_banned=false, banned_at=null
$user->isBanned()     // Returns boolean of ban status
```

## UserRole Enum

The `UserRole` enum provides role management:

```php
// Cases
UserRole::User
UserRole::Moderator
UserRole::Admin

// Methods
$role->label()        // Returns human-readable name
$role->isModerator()  // Returns true if Moderator or Admin
$role->isAdmin()      // Returns true only if Admin
$role->color()        // Returns DaisyUI badge color
```

## Database Schema

### Users Table (New Columns)

```sql
role         VARCHAR(255) DEFAULT 'user'     # Stores UserRole value
is_banned    BOOLEAN DEFAULT false           # Moderation flag
banned_at    TIMESTAMP NULL                  # When user was banned
```

### Moderation Flags Table

```sql
id              BIGINT PRIMARY KEY
flaggable_type  VARCHAR(255)              # Polymorphic type (App\Models\Idea, etc)
flaggable_id    BIGINT                    # Polymorphic ID
flagged_by      BIGINT FOREIGN KEY        # User reporting (fk: users.id)
reason          VARCHAR(255)              # Reason for flag (spam, inappropriate, etc)
description     TEXT NULL                 # Detailed explanation
status          VARCHAR(255)              # pending, reviewed, resolved, dismissed
reviewed_by     BIGINT NULL FOREIGN KEY   # Admin/Moderator who reviewed
resolution      TEXT NULL                 # Resolution notes
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

## Authentication & Authorization

Admin access is protected by:

1. **Authentication**: User must be logged in
2. **AdminMiddleware**: Checks `auth()->user()->isAdmin()` on all `/admin/*` routes

The middleware rejects access with 403 (Forbidden) if the user is not an admin.

## Styling

All admin views use:

- **DaisyUI Components**: Cards, badges, tables, dropdowns, modals
- **TailwindCSS**: Responsive grid layouts, spacing, colors
- **Color Scheme**:
    - Primary (Blue): General actions
    - Success (Green): Approved/active status
    - Warning (Yellow): Pending/moderator role
    - Error (Red): Banned/admin role/delete actions
    - Info (Cyan): Details/information
    - Ghost: Neutral actions

## Navigation

Admin users see an "admin" link in the navbar:

- **Mobile**: Dropdown menu
- **Desktop**: Navbar center menu
- Link is only visible to authenticated admin users

## Testing

Login with test credentials:

- **Email**: admin@example.com
- **Password**: password

Then navigate to `/admin` to access the dashboard.

## Future Enhancements

Potential features to add:

- Bulk user actions (ban multiple users, change roles in bulk)
- Advanced filtering on management pages
- Search functionality for users, ideas, comments
- Export reports (user statistics, moderation activity)
- Audit logs for all admin actions
- Flag templates for common report reasons
- Email notifications for reported content
- Custom user banning reasons
- Scheduled tasks for automatic cleanup
- Two-factor authentication for admin accounts
- Role-based permission system (more granular control)
