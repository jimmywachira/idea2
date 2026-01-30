# Admin Dashboard - Quick Start Guide

## 🚀 Getting Started

### 1. Initial Setup

```bash
# Run database migrations
php artisan migrate

# Seed test data (creates admin, moderator, and regular users)
php artisan db:seed
```

### 2. Access Admin Dashboard

1. **Login** with admin credentials:
    - Email: `admin@example.com`
    - Password: `password`

2. **Navigate** to `/admin` or click "admin" link in navbar

## 📊 Dashboard Overview

The admin dashboard displays:

- **Total Users**: Count of all registered users
- **Total Ideas**: All submitted ideas
- **Total Comments**: All posted comments
- **Banned Users**: Count of currently banned users
- **Pending Flags**: Moderation queue size

Quick access cards to all admin modules with recent activity.

## 👥 User Management

### Access: `/admin/users`

**Features:**

- View all users with pagination (15 per page)
- User avatars with fallback initials
- Role display with color-coded badges
- Ban/unban toggle
- Change role button (cycles: User → Moderator → Admin → User)

**Actions:**

1. **Change Role**: Click "Change Role" to cycle to next role
2. **Ban User**: Prevents user from logging in and accessing platform
3. **Unban User**: Re-enable access for previously banned user
4. **View Profile**: See detailed user profile

### User Status Indicators:

- 🟢 **Active**: User can access the platform
- 🔴 **Banned**: User is restricted from platform access

## 🚩 Moderation Queue

### Access: `/admin/flags`

**Features:**

- List all flagged content (ideas or comments)
- Show flag reason and detailed description
- Display who reported the content
- Timestamp of report
- Current status of each flag

**Statuses:**

- ⚠️ **Pending**: Awaiting admin review
- ℹ️ **Reviewed**: Admin has reviewed but not yet resolved
- ✅ **Resolved**: Content was inappropriate, action taken
- ⚪ **Dismissed**: Flag was invalid, no action needed

**Actions on Pending Flags:**

1. Click "Resolve" → Mark as inappropriate content
2. Click "Dismiss" → Flag was invalid/spam

## 💡 Manage Ideas

### Access: `/admin/ideas`

**Features:**

- View all ideas with pagination
- Display idea title, description (limited), author
- Show idea status (Pending, In Progress, Completed)
- Submission date

**Actions:**

- **View**: Click to open full idea page
- **Delete**: Remove inappropriate or duplicate ideas
    - ⚠️ Deletion is permanent - requires confirmation

**Visible Info:**

- Idea title and description preview
- Author name
- Current status with color coding
- Submission date

## 💬 Manage Comments

### Access: `/admin/comments`

**Features:**

- View all comments with pagination
- Show comment author with avatar
- Display full comment text
- Show which idea the comment is on
- Timestamp of comment

**Actions:**

- **Delete**: Remove inappropriate comments
    - ⚠️ Deletion is permanent - requires confirmation
    - Comments are soft-deleted if configured

## 🔧 Key Concepts

### User Roles

| Role          | Abilities                                  |
| ------------- | ------------------------------------------ |
| **User**      | Create ideas, comment, like, view profiles |
| **Moderator** | User abilities + Review flags (future)     |
| **Admin**     | All permissions + Full platform control    |

### User Banning

When you ban a user:

- ❌ They cannot log in
- ❌ Their ideas/comments remain but are marked
- ✅ Can be unbanned to restore access
- 📝 Ban timestamp is recorded

### Flag Workflow

1. **User Reports Content** → Flag created with "pending" status
2. **Admin Reviews** → Change status to "reviewed" if needed
3. **Admin Takes Action** →
    - **Resolve**: Mark as resolved (content action taken)
    - **Dismiss**: Mark as dismissed (invalid report)

## 🎨 UI Components

### Color Coding

**Role Badges:**

- 🔵 **Neutral**: Regular User
- 🟡 **Warning**: Moderator
- 🔴 **Error**: Admin

**Status Badges:**

- 🟡 **Warning**: Pending review
- 🔵 **Info**: Reviewed
- 🟢 **Success**: Active/Approved
- ⚪ **Ghost**: Dismissed/Neutral

**Action Buttons:**

- 🔵 Info buttons: View details
- 🟢 Success buttons: Confirm/Approve
- 🔴 Error buttons: Delete/Ban
- ⚪ Ghost buttons: Secondary actions

## 🔒 Security Notes

1. **Admin-Only Access**: `/admin` routes require admin role
2. **CSRF Protection**: All forms include CSRF tokens
3. **Middleware**: AdminMiddleware validates authorization
4. **Validation**: All admin actions are logged (use `created_at`, `updated_at`)

## 📱 Responsive Design

- **Desktop**: Full layout with all details visible
- **Tablet**: Optimized for touch
- **Mobile**: Stacked layout with essential info

## ⚡ Common Tasks

### Ban a Problematic User

1. Go to `/admin/users`
2. Find user in list
3. Click red "Ban" button
4. Confirm action

### Review Flagged Content

1. Go to `/admin/flags`
2. View pending flags at top
3. Read reason and description
4. Click "Resolve" or "Dismiss"

### Remove Inappropriate Idea

1. Go to `/admin/ideas`
2. Find the idea in list
3. Review description preview
4. Click "Delete" and confirm

### Promote User to Moderator

1. Go to `/admin/users`
2. Find user in list
3. Click "Change Role"
4. Confirm (Moderator role assigned)

## 🆘 Troubleshooting

### Can't access admin dashboard?

- Check user role: `SELECT role FROM users WHERE email = 'your@email.com';`
- Verify middleware: Check `bootstrap/app.php` has admin middleware
- Clear cache: `php artisan config:clear`

### Migrations not running?

```bash
# Check migration status
php artisan migrate:status

# Rollback and re-run
php artisan migrate:rollback
php artisan migrate
```

### Admin link not showing in navbar?

- User must be logged in AND have admin role
- Check navbar component: `resources/views/components/layout/navbar.blade.php`
- Clear browser cache (Ctrl+Shift+R)

## 📚 Related Documentation

- See `ADMIN_SYSTEM.md` for technical implementation details
- Check `UserRole` enum for role definitions
- Review `AdminController` for available actions
