<?php
// views/projects_list_view.php
// Expected in scope: $projects (array), $projectCount (int)

$pageTitle = 'Projects Manager — Admin';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/helpers.php';

// Flash messages
$successFlash = get_flash_message('project_success');
?>

<!-- Dashboard Navbar -->
<nav class="dashboard-navbar">
    <div class="dashboard-nav-inner">
        <a href="../index.php" class="dashboard-logo">
            <img src="../project-img/logo.png" alt="Izaz Uddin Logo">
            <span>Admin<span>Panel</span></span>
        </a>
        <div class="dashboard-user">
            <div class="dashboard-user-name">
                <?php echo htmlspecialchars($_SESSION['admin_fullname']); ?>
            </div>
            <a href="login.php" class="btn-admin btn-admin-secondary btn-sm" onclick="return false;" 
               style="font-size:0.82rem; padding:0.4rem 0.85rem;">
                <i class="fa-solid fa-grid-2"></i> Dashboard
            </a>
            <a href="../authentication/logout.php" class="btn-admin btn-admin-danger btn-sm">
                <i class="fa-solid fa-power-off"></i>
            </a>
        </div>
    </div>
</nav>

<div class="dashboard-container">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="dashboard-welcome" style="margin-bottom:0;">
            <h1 style="font-size:1.8rem;">
                <i class="fa-solid fa-diagram-project" style="color:var(--accent);"></i>
                Projects Manager
            </h1>
            <p style="margin:0;">Manage all your portfolio projects — add, edit, or remove entries.</p>
        </div>
        <a href="projects.php?action=add" class="btn-admin btn-admin-primary" style="width:auto;">
            <i class="fa-solid fa-plus"></i> Add New Project
        </a>
    </div>

    <!-- Flash Success Alert -->
    <?php if ($successFlash): ?>
        <div class="alert-glass alert-glass-success mb-4" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <div><?php echo $successFlash['message']; ?></div>
        </div>
    <?php endif; ?>

    <!-- Projects Table -->
    <div class="dashboard-content-box" style="padding:0; overflow:hidden;">
        <div style="padding:1.5rem 2rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:0.75rem;">
            <h2 style="margin:0; font-size:1.1rem;">
                <i class="fa-solid fa-list"></i> All Projects
            </h2>
            <span style="background:rgba(124,92,252,0.15); color:var(--accent-2); font-size:0.8rem; padding:0.2rem 0.65rem; border-radius:50px; border:1px solid var(--border);">
                <?php echo count($projects); ?> total
            </span>
        </div>

        <?php if (empty($projects)): ?>
            <div style="padding:3rem; text-align:center; color:var(--text-muted);">
                <i class="fa-solid fa-folder-open" style="font-size:3rem; margin-bottom:1rem; color:var(--accent);"></i>
                <p>No projects yet. <a href="projects.php?action=add">Add your first project</a>.</p>
            </div>
        <?php else: ?>
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="background:rgba(26,26,53,0.5); border-bottom:1px solid var(--border);">
                            <th style="padding:1rem 1.5rem; text-align:left; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">#</th>
                            <th style="padding:1rem 1.5rem; text-align:left; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Thumbnail</th>
                            <th style="padding:1rem 1.5rem; text-align:left; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Title</th>
                            <th style="padding:1rem 1.5rem; text-align:left; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Tags</th>
                            <th style="padding:1rem 1.5rem; text-align:center; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Featured</th>
                            <th style="padding:1rem 1.5rem; text-align:center; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Order</th>
                            <th style="padding:1rem 1.5rem; text-align:center; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Status</th>
                            <th style="padding:1rem 1.5rem; text-align:center; font-size:0.78rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $i => $project): ?>
                            <tr class="table-row-hover" style="border-bottom:1px solid rgba(120,100,255,0.08); transition:background 0.2s;">
                                <td style="padding:1rem 1.5rem; color:var(--text-muted); font-size:0.85rem;"><?php echo $i + 1; ?></td>

                                <!-- Thumbnail -->
                                <td style="padding:0.75rem 1.5rem;">
                                    <?php if ($project['image']): ?>
                                        <img src="../<?php echo htmlspecialchars($project['image']); ?>"
                                             alt="<?php echo htmlspecialchars($project['title']); ?>"
                                             style="width:64px; height:44px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                                    <?php else: ?>
                                        <div style="width:64px; height:44px; background:var(--surface-2); border-radius:8px; display:flex; align-items:center; justify-content:center; border:1px solid var(--border);">
                                            <i class="fa-solid fa-image" style="color:var(--text-muted);"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <!-- Title -->
                                <td style="padding:1rem 1.5rem;">
                                    <div style="font-weight:600; color:var(--text); font-size:0.9rem;"><?php echo htmlspecialchars($project['title']); ?></div>
                                    <?php if ($project['badge_label']): ?>
                                        <span style="font-size:0.68rem; background:var(--accent); color:#fff; padding:0.15rem 0.5rem; border-radius:50px; font-weight:700;">
                                            <?php echo htmlspecialchars($project['badge_label']); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- Tags -->
                                <td style="padding:1rem 1.5rem;">
                                    <div style="display:flex; flex-wrap:wrap; gap:0.3rem;">
                                        <?php foreach (explode(',', $project['tags']) as $tag): ?>
                                            <span style="font-size:0.68rem; padding:0.15rem 0.5rem; background:rgba(124,92,252,0.1); border:1px solid var(--border); border-radius:50px; color:var(--accent-2);">
                                                <?php echo htmlspecialchars(trim($tag)); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>

                                <!-- Featured -->
                                <td style="padding:1rem 1.5rem; text-align:center;">
                                    <?php if ($project['is_featured']): ?>
                                        <i class="fa-solid fa-star" style="color:#fbbf24;" title="Featured"></i>
                                    <?php else: ?>
                                        <i class="fa-regular fa-star" style="color:var(--text-muted);" title="Not featured"></i>
                                    <?php endif; ?>
                                </td>

                                <!-- Sort Order -->
                                <td style="padding:1rem 1.5rem; text-align:center; color:var(--text-muted); font-family:var(--font-mono); font-size:0.85rem;">
                                    <?php echo (int) $project['sort_order']; ?>
                                </td>

                                <!-- Status -->
                                <td style="padding:1rem 1.5rem; text-align:center;">
                                    <?php if ($project['status'] === 'active'): ?>
                                        <span style="font-size:0.72rem; background:rgba(52,211,153,0.12); color:var(--green); padding:0.2rem 0.65rem; border-radius:50px; border:1px solid rgba(52,211,153,0.3); font-weight:600;">Active</span>
                                    <?php else: ?>
                                        <span style="font-size:0.72rem; background:rgba(248,113,113,0.12); color:var(--red); padding:0.2rem 0.65rem; border-radius:50px; border:1px solid rgba(248,113,113,0.3); font-weight:600;">Hidden</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Actions -->
                                <td style="padding:1rem 1.5rem; text-align:center;">
                                    <div style="display:flex; gap:0.5rem; justify-content:center;">
                                        <a href="projects.php?action=edit&id=<?php echo $project['id']; ?>"
                                           style="display:inline-flex; align-items:center; gap:0.35rem; padding:0.35rem 0.75rem; background:rgba(124,92,252,0.12); border:1px solid var(--border); border-radius:8px; color:var(--accent-2); font-size:0.8rem; transition:all 0.2s;"
                                           title="Edit Project">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $project['id']; ?>, '<?php echo htmlspecialchars(addslashes($project['title'])); ?>')"
                                                style="display:inline-flex; align-items:center; gap:0.35rem; padding:0.35rem 0.75rem; background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.25); border-radius:8px; color:var(--red); font-size:0.8rem; cursor:pointer; transition:all 0.2s;"
                                                title="Delete Project">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Back to Dashboard -->
    <div class="mt-4">
        <a href="../views/dashboard_view.php" class="btn-admin btn-admin-secondary" style="width:auto;">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="display:none; position:fixed; inset:0; z-index:1000; background:rgba(0,0,0,0.65); backdrop-filter:blur(4px); align-items:center; justify-content:center;">
    <div class="glass-card" style="max-width:420px; text-align:center;">
        <div style="width:64px; height:64px; background:rgba(248,113,113,0.12); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.25rem; border:1px solid rgba(248,113,113,0.3);">
            <i class="fa-solid fa-triangle-exclamation" style="color:var(--red); font-size:1.5rem;"></i>
        </div>
        <h3 style="color:var(--white); margin-bottom:0.5rem;">Delete Project?</h3>
        <p id="deleteModalText" style="color:var(--text-muted); font-size:0.9rem; margin-bottom:1.75rem;"></p>
        <form id="deleteForm" method="POST" action="projects.php">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="project_id" id="deleteProjectId">
            <div style="display:flex; gap:1rem; justify-content:center;">
                <button type="button" onclick="closeDeleteModal()"
                        class="btn-admin btn-admin-secondary" style="width:auto;">
                    Cancel
                </button>
                <button type="submit" class="btn-admin btn-admin-danger" style="width:auto;">
                    <i class="fa-solid fa-trash"></i> Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    document.getElementById('deleteProjectId').value = id;
    document.getElementById('deleteModalText').textContent =
        'Are you sure you want to permanently delete "' + title + '"? This action cannot be undone.';
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
// Row hover effect
document.querySelectorAll('.table-row-hover').forEach(function(row) {
    row.addEventListener('mouseenter', function() { this.style.background = 'rgba(124,92,252,0.04)'; });
    row.addEventListener('mouseleave', function() { this.style.background = ''; });
});
</script>

<footer class="admin-footer">
    © 2026 Izaz Uddin. Admin Projects Manager.
</footer>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
