<?php
// views/dashboard_view.php
// Protected page — requires session authentication
require_once __DIR__ . '/../includes/auth_middleware.php';
require_once __DIR__ . '/../includes/helpers.php';

// Load project count from DB
$db = require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Project.php';
$projectModel = new Project($db);
$projectCount = $projectModel->count();

// Load unread message count from DB
$unreadCount = 0;
try {
    $stmt = $db->query("SELECT COUNT(*) AS cnt FROM contact_messages WHERE is_read = 0");
    $row = $stmt->fetch();
    $unreadCount = (int)($row['cnt'] ?? 0);
} catch (Throwable $e) {
    $unreadCount = 0;
}

$pageTitle = 'Admin Dashboard — Izaz Uddin';
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Dashboard Navigation -->
<nav class="dashboard-navbar">
    <div class="dashboard-nav-inner">
        <a href="../index.php" class="dashboard-logo">
            <img src="../project-img/logo.png" alt="Izaz Uddin Logo">
            <span>Admin<span>Panel</span></span>
        </a>
        <div class="dashboard-user">
            <div class="dashboard-user-name">
                Logged in as: <span><?php echo htmlspecialchars($_SESSION['admin_fullname']); ?></span>
            </div>
            <a href="../authentication/logout.php" class="btn-admin btn-admin-danger btn-sm">
                Log Out <i class="fa-solid fa-power-off"></i>
            </a>
        </div>
    </div>
</nav>

<!-- Main Dashboard Container -->
<div class="dashboard-container">

    <!-- Welcome Header -->
    <div class="dashboard-welcome">
        <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', trim($_SESSION['admin_fullname']))[0]); ?>! 👋</h1>
        <p>Manage your portfolio content from this central admin workspace.</p>
    </div>

    <!-- Stats Grid -->
    <div class="dashboard-grid">

        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
            <div class="stat-info">
                <h3><?php echo $projectCount; ?></h3>
                <p>Portfolio Projects</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-code"></i></div>
            <div class="stat-info">
                <h3>12</h3>
                <p>Active Skills</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
            <div class="stat-info">
                <h3><?php echo $unreadCount; ?></h3>
                <p>Unread Messages</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <div class="stat-info">
                <h3>Active</h3>
                <p>Security Shields</p>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="dashboard-content-box mb-4">
        <h2><i class="fa-solid fa-bolt"></i> Quick Actions</h2>
        <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:0.5rem;">
            <a href="../authentication/projects.php" class="btn-admin btn-admin-primary" style="width:auto;">
                <i class="fa-solid fa-diagram-project"></i> Manage Projects
            </a>
            <a href="../authentication/projects.php?action=add" class="btn-admin btn-admin-secondary" style="width:auto;">
                <i class="fa-solid fa-plus"></i> Add New Project
            </a>
            <a href="../authentication/contact_messages.php" class="btn-admin btn-admin-secondary" style="width:auto;">
                <i class="fa-solid fa-envelope"></i> View Contact Messages
            </a>
            <a href="../index.php" target="_blank" class="btn-admin btn-admin-secondary" style="width:auto;">
                <i class="fa-solid fa-eye"></i> View Portfolio
            </a>
        </div>
    </div>

    <!-- Latest Messages Preview -->
    <div class="dashboard-content-box">
        <h2><i class="fa-solid fa-inbox"></i> Latest Contact Messages</h2>
        <p style="color:var(--text-muted);">Showing latest messages below. Click “View Contact Messages” for full list.</p>

        <div class="table-responsive" style="margin-top:1rem;">
            <?php
            $latestMessages = [];
            try {
                $stmt = $db->query("SELECT id, name, email, message, is_read, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5");
                $latestMessages = $stmt->fetchAll();
            } catch (Throwable $e) {
                $latestMessages = [];
            }
            ?>

            <table class="table table-dark table-striped" style="border-radius:var(--radius); overflow:hidden;">
                <thead>
                    <tr>
                        <th style="width:80px;">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="min-width:300px;">Message</th>
                        <th style="width:120px;">Status</th>
                        <th style="width:180px;">Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($latestMessages)): ?>
                        <tr>
                            <td colspan="6" style="text-align:center; color:var(--text-muted);">
                                No messages found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($latestMessages as $m): ?>
                            <tr>
                                <td><?php echo (int)$m['id']; ?></td>
                                <td><?php echo htmlspecialchars($m['name']); ?></td>
                                <td><?php echo htmlspecialchars($m['email']); ?></td>
                                <td style="white-space:pre-wrap;">\
                                    <?php echo htmlspecialchars($m['message']); ?>
                                </td>
                                <td>
                                    <?php if ((int)$m['is_read'] === 1): ?>
                                        <span class="badge bg-success">Read</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Unread</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($m['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Admin Info -->
    <div class="dashboard-content-box">
        <h2><i class="fa-solid fa-gears"></i> System Status</h2>
        <div class="row mt-3">
            <div class="col-md-8">
                <p style="color:var(--text-muted); line-height:1.8;">
                    Your secure admin authentication (Phase 1) and dynamic projects management (Phase 2) are fully active.
                    All portfolio projects are now stored in MySQL and rendered dynamically on the public homepage.
                </p>
                <div class="alert alert-info bg-dark border-secondary text-light mt-3" style="border-radius:var(--radius);">
                    <i class="fa-solid fa-circle-info text-info me-2"></i>
                    <strong>Database:</strong> Connected to <code>portfolio_db</code> ·
                    <strong><?php echo $projectCount; ?> projects</strong> in the system
                </div>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card bg-dark border-secondary text-light" style="border-radius:var(--radius);">
                    <div class="card-body">
                        <h5 class="card-title" style="color:var(--accent-2); font-size:0.95rem;">
                            <i class="fa-solid fa-user-shield me-2"></i> Account Details
                        </h5>
                        <ul class="list-unstyled mt-3 mb-0" style="line-height:2; color:var(--text-muted); font-size:0.88rem;">
                            <li><strong class="text-light">Name:</strong> <?php echo htmlspecialchars($_SESSION['admin_fullname']); ?></li>
                            <li><strong class="text-light">Username:</strong> <code><?php echo htmlspecialchars($_SESSION['admin_username']); ?></code></li>
                            <li><strong class="text-light">Email:</strong> <?php echo htmlspecialchars($_SESSION['admin_email']); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<footer class="admin-footer">
    © 2026 Izaz Uddin. Admin Workspace.
</footer>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

