# Admin System Architecture

## System Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                     ADMIN DASHBOARD                             │
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  Admin Dashboard Overview                               │  │
│  │  ├─ Statistics (Users, Ideas, Comments, Flags, Bans)   │  │
│  │  ├─ Recent Activity Monitor                             │  │
│  │  └─ Quick Access Navigation Cards                       │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  User Management       Ideas Management                  │  │
│  │  ├─ View All Users    ├─ View All Ideas                │  │
│  │  ├─ Change Roles      ├─ Delete Ideas                  │  │
│  │  ├─ Ban Users         └─ Review Quality                │  │
│  │  └─ Unban Users                                         │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  Comments Management   Moderation Queue                  │  │
│  │  ├─ View All Comments ├─ Review Flagged Content         │  │
│  │  └─ Delete Comments   ├─ Resolve Flags                  │  │
│  │                       └─ Dismiss Invalid Flags           │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

## Request Flow

```
User Request
    ↓
Authentication Middleware (check if logged in)
    ↓
Admin Middleware (check if user.isAdmin())
    ↓
AdminController Method
    ↓
Interact with Models (User, Idea, Comment, ModerationFlag)
    ↓
Return View with Data
    ↓
DaisyUI Components Render
    ↓
Response to Browser
```

## User Role Hierarchy

```
┌─────────────────────────────────────────┐
│  Admin (Full Platform Control)          │
│  ├─ Manage Users (all roles)           │
│  ├─ Ban/Unban Users                    │
│  ├─ Delete Ideas & Comments            │
│  ├─ Review Moderation Queue            │
│  ├─ Can be Admin user or Moderator     │
│  └─ isAdmin() = true                   │
└─────────────────────────────────────────┘
           ↑
┌─────────────────────────────────────────┐
│  Moderator (Content Moderation)         │
│  ├─ Review Flagged Content             │
│  ├─ Resolve/Dismiss Flags              │
│  ├─ View all content                   │
│  └─ isModerator() = true               │
└─────────────────────────────────────────┘
           ↑
┌─────────────────────────────────────────┐
│  User (Regular Platform Access)         │
│  ├─ Create Ideas                       │
│  ├─ Post Comments                      │
│  ├─ Like Ideas                         │
│  └─ isUser() = true                    │
└─────────────────────────────────────────┘
```

## Database Relationships

```
┌──────────────┐           ┌──────────────┐
│    users     │           │    ideas     │
│──────────────│           │──────────────│
│ id (PK)      │───1:N────│ id (PK)      │
│ name         │           │ title        │
│ email        │           │ user_id (FK) │
│ role    ◄────┤           │ status       │
│ is_banned    │           │ ...          │
│ banned_at    │           └──────────────┘
└──────────────┘                 │
       ▲                         │
       │                    1:N  │
       │        ┌─────────────────┘
       │        │
       │        ▼
       │   ┌──────────────┐      ┌─────────────────┐
       │   │   comments   │      │ moderation_     │
       │   │──────────────│      │ flags           │
       │   │ id (PK)      │      │─────────────────│
       │   │ body         │      │ id (PK)         │
       │   │ user_id (FK) │◄─┐   │ flaggable_type  │
       │   │ idea_id (FK) │  └───│ flaggable_id    │
       │   └──────────────┘  N:1 │ flagged_by (FK) │
       │                         │ status          │
       │                         │ reviewed_by (FK)│
       └─────────────────────────│ ...             │
         Reviewers              └─────────────────┘
         Reporters
```

## Module Architecture

```
┌─────────────────────────────────────────────────────────┐
│              AdminController                            │
│  ┌─────────────────────────────────────────────────────┐│
│  │ Public Methods:                                     ││
│  │                                                     ││
│  │ Dashboard Module:                                   ││
│  │  - dashboard()                                      ││
│  │                                                     ││
│  │ User Management:                                    ││
│  │  - users()                                          ││
│  │  - changeUserRole()                                 ││
│  │  - banUser()                                        ││
│  │  - unbanUser()                                      ││
│  │                                                     ││
│  │ Ideas Management:                                   ││
│  │  - ideas()                                          ││
│  │  - deleteIdea()                                     ││
│  │                                                     ││
│  │ Comments Management:                                ││
│  │  - comments()                                       ││
│  │  - deleteComment()                                  ││
│  │                                                     ││
│  │ Moderation Queue:                                   ││
│  │  - flags()                                          ││
│  │  - resolveFlag()                                    ││
│  │  - dismissFlag()                                    ││
│  └─────────────────────────────────────────────────────┘│
└─────────────────────────────────────────────────────────┘
             │           │           │           │           │
             ▼           ▼           ▼           ▼           ▼
      ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐
      │  User    │ │  Idea    │ │ Comment  │ │ModeFlag  │ │UserRole  │
      │ Model    │ │ Model    │ │ Model    │ │ Table    │ │  Enum    │
      └──────────┘ └──────────┘ └──────────┘ └──────────┘ └──────────┘
```

## Access Control Flow

```
User Attempts to Access /admin
         ↓
Route Middleware: auth
  ├─ Logged in? YES → Continue
  └─ NO → Redirect to /login
         ↓
Route Middleware: admin (AdminMiddleware)
  ├─ User.isAdmin() == true? YES → Continue
  └─ NO → Abort with 403 Forbidden
         ↓
AdminController Method Executes
  ├─ Fetch Data from Models
  ├─ Process User Input
  └─ Return View
         ↓
Render Blade View
  ├─ Apply DaisyUI Components
  ├─ Add Alpine.js Interactivity
  └─ Return HTML
         ↓
Display to User
```

## Flag Resolution Workflow

```
User Reports Content (Flag Created)
         ↓
Flag Status: "pending"
         ↓
Admin Navigates to /admin/flags
         ↓
Admin Reviews Flag Details
    ├─ Sees reason and description
    ├─ Sees what was flagged (Idea or Comment)
    └─ Sees who flagged it
         ↓
Admin Makes Decision
    ├─ Click "Resolve" → Status = "resolved" + reviewed_by = admin.id
    └─ Click "Dismiss" → Status = "dismissed" + reviewed_by = admin.id
         ↓
Flag Updated in Database
         ↓
Next Admin View - Flag No Longer Appears in Pending
```

## Authentication & Authorization

```
┌────────────────────────────────────┐
│   Authentication                   │
│   (Is user logged in?)             │
├────────────────────────────────────┤
│ auth()->check()                    │
│ ↓ (returns boolean)                │
│ User.id = User Session ID          │
└────────────────────────────────────┘
           ↓
┌────────────────────────────────────┐
│   Authorization (Admin)            │
│   (Does user have permission?)     │
├────────────────────────────────────┤
│ auth()->user()->isAdmin()           │
│ ↓ Checks User.role == UserRole::Admin
│ Returns boolean                    │
└────────────────────────────────────┘
           ↓
┌────────────────────────────────────┐
│   Route Access                     │
│   (Grant or Deny)                  │
├────────────────────────────────────┤
│ True  → Proceed to Controller      │
│ False → Throw 403 Forbidden        │
└────────────────────────────────────┘
```

## Data Flow Example: Ban User

```
Admin Form Submit
    ↓
POST /admin/users/{user}/ban
    ↓
Route → Auth Middleware → Admin Middleware
    ↓
AdminController::banUser($user)
    ↓
$user->ban()
    ↓ (User Model Method)
update([
    'is_banned' => true,
    'banned_at' => now()
])
    ↓
SQL UPDATE users SET is_banned=true, banned_at=CURRENT_TIMESTAMP
    ↓
Database Updated
    ↓
Redirect back with 'success' message
    ↓
Show alert to admin
    ↓
User's next login attempt:
    ├─ Password correct ✓
    ├─ Check is_banned field
    └─ Access denied (implement in authenticator if needed)
```

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── AdminController.php          ← Main controller
│   └── Middleware/
│       └── AdminMiddleware.php          ← Access control
├── Enums/
│   └── UserRole.php                     ← Role definition
└── Models/
    └── User.php                         ← Updated with role methods

routes/
└── web.php                              ← Admin routes group

database/
├── migrations/
│   ├── 2025_01_29_000000_add_role_to_users_table.php
│   └── 2025_01_29_000001_create_moderation_flags_table.php
└── seeders/
    └── DatabaseSeeder.php               ← Creates test admin users

resources/views/
├── admin/
│   ├── dashboard.blade.php              ← Dashboard overview
│   ├── users/
│   │   └── index.blade.php              ← User management
│   ├── ideas/
│   │   └── index.blade.php              ← Ideas management
│   ├── comments/
│   │   └── index.blade.php              ← Comments management
│   └── flags/
│       └── index.blade.php              ← Moderation queue
├── components/
│   └── layout/
│       └── navbar.blade.php             ← Updated with admin link
└── layouts/
    └── app.blade.php                    ← Admin layout template

bootstrap/
└── app.php                              ← Middleware registration
```

## Performance Considerations

```
Queries Used:
├─ Dashboard: 5 COUNT queries + 3 ORDER BY queries
├─ Users List: 1 paginated query (15 per page)
├─ Ideas List: 1 paginated query with user relationship
├─ Comments: 1 paginated query with user & idea relationships
└─ Flags: 1 LEFT JOIN query with users table for reporter name

Indexes Created:
├─ moderation_flags.status (for status filtering)
├─ moderation_flags.created_at (for sorting)
└─ Existing indexes on users.id, ideas.user_id, etc.

Optimization:
├─ Eager loading with ->with() for relationships
├─ Pagination to limit result sets
├─ Database queries only on pagination changes
└─ Client-side Bootstrap pagination
```

---

**Diagram Legend:**

- `─────` = One-to-Many relationship
- `◄────` = Many-to-One relationship
- `↓` = Flow direction
- `(PK)` = Primary Key
- `(FK)` = Foreign Key
