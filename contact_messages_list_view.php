<?php
// views/contact_messages_list_view.php
// Protected page — requires session authentication
require_once __DIR__ . '/../includes/auth_middleware.php';
require_once __DIR__ . '/../includes/helpers.php';

$db = require_once __DIR__ . '/../config/db.php';

try {
    $stmt = $db->query("SELECT id, name, email, message, is_read, created_at FROM contact_messages ORDER BY is_read ASC, created_at DESC");
    $messages = $stmt->fetchAll();
} catch (Throwable $e) {
    $messages = [];
}

$pageTitle = 'Contact Messages — Izaz Uddin (Admin)';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="dashboard-container">

    <div class="dashboard-welcome">
        <h1><i class="fa-solid fa-envelope-open-text me-2"></i> Contact Messages</h1>
        <p>View and manage messages sent from the portfolio contact form.</p>
    </div>

    <div class="dashboard-content-box">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:1rem; flex-wrap:wrap;">
            <h2 style="margin:0;"><i class="fa-solid fa-list-check me-2"></i> All Messages</h2>
            <div>
                <a href="../index.php" class="btn-admin btn-admin-secondary" target="_blank" style="width:auto;">
                    <i class="fa-solid fa-eye"></i> View Portfolio
                </a>
            </div>
        </div>

        <div class="table-responsive" style="margin-top:1rem;">
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
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center; color:var(--text-muted);">
                            No messages found.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($messages as $m): ?>
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
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

