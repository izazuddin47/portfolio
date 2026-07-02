<?php
// views/project_form_view.php
// Expected in scope: $project (array|null), $errors (array), $isEdit (bool)

$pageTitle = ($isEdit ? 'Edit Project' : 'Add New Project') . ' — Admin';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/helpers.php';

// Helper to safely output old POST value or project DB value
function fieldVal(string $key, ?array $project, array $post): string {
    if (!empty($post[$key])) return htmlspecialchars($post[$key]);
    if ($project && isset($project[$key])) return htmlspecialchars($project[$key]);
    return '';
}

// Decode features JSON → one-per-line for textarea
$featuresText = '';
if (!empty($_POST['features'])) {
    $featuresText = htmlspecialchars($_POST['features']);
} elseif ($project && !empty($project['features'])) {
    $arr = json_decode($project['features'], true);
    $featuresText = htmlspecialchars(implode("\n", $arr ?: []));
}

$formAction = $isEdit
    ? 'projects.php?action=edit&id=' . (int)$project['id']
    : 'projects.php?action=add';
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
                <i class="fa-solid <?php echo $isEdit ? 'fa-pen-to-square' : 'fa-plus-circle'; ?>" style="color:var(--accent);"></i>
                <?php echo $isEdit ? 'Edit Project' : 'Add New Project'; ?>
            </h1>
            <p style="margin:0;"><?php echo $isEdit ? 'Update the project details below.' : 'Fill in the details to add a new portfolio project.'; ?></p>
        </div>
        <a href="projects.php" class="btn-admin btn-admin-secondary" style="width:auto;">
            <i class="fa-solid fa-arrow-left"></i> Back to Projects
        </a>
    </div>

    <!-- General Error Banner -->
    <?php if (!empty($errors['general'])): ?>
        <div class="alert-glass alert-glass-danger mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div><?php echo $errors['general']; ?></div>
        </div>
    <?php endif; ?>

    <!-- Project Form -->
    <form action="<?php echo $formAction; ?>" method="POST" enctype="multipart/form-data" id="projectForm">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="project_id" value="<?php echo (int)$project['id']; ?>">
        <?php else: ?>
            <input type="hidden" name="action" value="create">
        <?php endif; ?>

        <div class="row g-4">

            <!-- LEFT COLUMN -->
            <div class="col-lg-8">
                <div class="dashboard-content-box">
                    <h2 style="font-size:1rem; margin-bottom:1.5rem;"><i class="fa-solid fa-file-lines"></i> Project Details</h2>

                    <!-- Title -->
                    <div class="form-group-custom">
                        <label for="title" class="form-label-custom">Project Title <span style="color:var(--red);">*</span></label>
                        <div class="input-icon-wrap">
                            <input type="text" id="title" name="title"
                                   class="form-control form-control-custom <?php echo isset($errors['title']) ? 'is-invalid-custom' : ''; ?>"
                                   placeholder="e.g. Digital Time Tracker System"
                                   value="<?php echo fieldVal('title', $project ?? null, $_POST); ?>" required>
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <?php if (!empty($errors['title'])): ?>
                            <div class="invalid-feedback-custom"><?php echo $errors['title']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Description -->
                    <div class="form-group-custom">
                        <label for="description" class="form-label-custom">Description <span style="color:var(--red);">*</span></label>
                        <textarea id="description" name="description" rows="4"
                                  class="form-control form-control-custom" style="padding-left:2.5rem !important;"
                                  placeholder="Brief description of the project..."
                                  required><?php echo fieldVal('description', $project ?? null, $_POST); ?></textarea>
                        <?php if (!empty($errors['description'])): ?>
                            <div class="invalid-feedback-custom"><?php echo $errors['description']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Features (one per line) -->
                    <div class="form-group-custom">
                        <label for="features" class="form-label-custom">
                            Key Features <span style="color:var(--red);">*</span>
                            <span style="color:var(--text-muted); font-size:0.75rem;">(one per line)</span>
                        </label>
                        <textarea id="features" name="features" rows="4"
                                  class="form-control form-control-custom" style="padding-left:2.5rem !important;"
                                  placeholder="Role-based access control&#10;Real-time tracking&#10;Dashboard analytics"
                                  required><?php echo $featuresText; ?></textarea>
                        <?php if (!empty($errors['features'])): ?>
                            <div class="invalid-feedback-custom"><?php echo $errors['features']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Tags -->
                    <div class="form-group-custom">
                        <label for="tags" class="form-label-custom">
                            Technology Tags <span style="color:var(--red);">*</span>
                            <span style="color:var(--text-muted); font-size:0.75rem;">(comma-separated)</span>
                        </label>
                        <div class="input-icon-wrap">
                            <input type="text" id="tags" name="tags"
                                   class="form-control form-control-custom <?php echo isset($errors['tags']) ? 'is-invalid-custom' : ''; ?>"
                                   placeholder="PHP, MySQL, Bootstrap, JavaScript"
                                   value="<?php echo fieldVal('tags', $project ?? null, $_POST); ?>" required>
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <?php if (!empty($errors['tags'])): ?>
                            <div class="invalid-feedback-custom"><?php echo $errors['tags']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- GitHub & Live Demo URLs -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label for="github_url" class="form-label-custom">GitHub URL</label>
                                <div class="input-icon-wrap">
                                    <input type="url" id="github_url" name="github_url"
                                           class="form-control form-control-custom"
                                           placeholder="https://github.com/..."
                                           value="<?php echo fieldVal('github_url', $project ?? null, $_POST); ?>">
                                    <i class="fa-brands fa-github"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label for="demo_url" class="form-label-custom">Live Demo URL</label>
                                <div class="input-icon-wrap">
                                    <input type="url" id="demo_url" name="demo_url"
                                           class="form-control form-control-custom"
                                           placeholder="https://example.com/..."
                                           value="<?php echo fieldVal('demo_url', $project ?? null, $_POST); ?>">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-4">

                <!-- Project Image Upload -->
                <div class="dashboard-content-box mb-4">
                    <h2 style="font-size:1rem; margin-bottom:1.25rem;"><i class="fa-solid fa-image"></i> Project Image</h2>

                    <?php if ($isEdit && !empty($project['image'])): ?>
                        <div style="margin-bottom:1rem; text-align:center;">
                            <img src="../<?php echo htmlspecialchars($project['image']); ?>"
                                 alt="Current image"
                                 style="width:100%; max-height:140px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                            <p style="color:var(--text-muted); font-size:0.75rem; margin-top:0.5rem;">Current image — upload below to replace</p>
                        </div>
                    <?php endif; ?>

                    <!-- Image Dropzone -->
                    <label for="image" id="dropzone"
                           style="display:block; border:2px dashed var(--border); border-radius:var(--radius); padding:1.5rem; text-align:center; cursor:pointer; transition:all 0.3s; color:var(--text-muted);">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size:2rem; color:var(--accent); margin-bottom:0.5rem; display:block;"></i>
                        <span id="dropzoneLabel">Click or drag image here</span>
                        <span style="display:block; font-size:0.72rem; margin-top:0.25rem;">JPG, PNG, GIF, WebP · Max 5 MB</span>
                        <input type="file" id="image" name="image" accept="image/*" style="display:none;" onchange="previewImage(this)">
                    </label>
                    <div id="imagePreview" style="display:none; margin-top:0.75rem; text-align:center;">
                        <img id="previewImg" src="" alt="Preview" style="width:100%; max-height:120px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                    </div>
                    <?php if (!empty($errors['image'])): ?>
                        <div class="invalid-feedback-custom mt-2"><?php echo $errors['image']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Project Options -->
                <div class="dashboard-content-box">
                    <h2 style="font-size:1rem; margin-bottom:1.25rem;"><i class="fa-solid fa-sliders"></i> Options</h2>

                    <!-- Featured Toggle -->
                    <div class="form-group-custom">
                        <label style="display:flex; align-items:center; gap:0.75rem; cursor:pointer; color:var(--text);">
                            <div style="position:relative;">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                       style="width:38px; height:20px; appearance:none; background:var(--surface-2); border:1px solid var(--border); border-radius:10px; cursor:pointer; transition:background 0.2s; outline:none;"
                                       <?php echo (isset($_POST['is_featured']) || ($isEdit && $project['is_featured'])) ? 'checked' : ''; ?>
                                       onclick="this.style.background = this.checked ? 'var(--accent)' : 'var(--surface-2)'">
                            </div>
                            <span>
                                <strong>Featured Project</strong>
                                <span style="display:block; font-size:0.78rem; color:var(--text-muted);">Full-width card on portfolio</span>
                            </span>
                        </label>
                    </div>

                    <!-- Badge Label -->
                    <div class="form-group-custom">
                        <label for="badge_label" class="form-label-custom">Badge Label <span style="color:var(--text-muted); font-size:0.75rem;">(optional, e.g. FYP)</span></label>
                        <div class="input-icon-wrap">
                            <input type="text" id="badge_label" name="badge_label"
                                   class="form-control form-control-custom"
                                   placeholder="FYP"
                                   value="<?php echo fieldVal('badge_label', $project ?? null, $_POST); ?>"
                                   maxlength="50">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                    </div>

                    <!-- Sort Order -->
                    <div class="form-group-custom">
                        <label for="sort_order" class="form-label-custom">Sort Order <span style="color:var(--text-muted); font-size:0.75rem;">(lower = first)</span></label>
                        <div class="input-icon-wrap">
                            <input type="number" id="sort_order" name="sort_order"
                                   class="form-control form-control-custom"
                                   min="0" max="9999"
                                   value="<?php echo fieldVal('sort_order', $project ?? null, $_POST) ?: 0; ?>">
                            <i class="fa-solid fa-arrow-up-9-1"></i>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group-custom">
                        <label for="status" class="form-label-custom">Visibility Status</label>
                        <div class="input-icon-wrap">
                            <select id="status" name="status" class="form-control form-control-custom" style="appearance:none;">
                                <option value="active"  <?php echo (fieldVal('status', $project ?? null, $_POST) !== 'hidden') ? 'selected' : ''; ?>>Active (Visible)</option>
                                <option value="hidden"  <?php echo (fieldVal('status', $project ?? null, $_POST) === 'hidden') ? 'selected' : ''; ?>>Hidden</option>
                            </select>
                            <i class="fa-solid fa-eye"></i>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-admin btn-admin-primary mt-3">
                        <i class="fa-solid <?php echo $isEdit ? 'fa-floppy-disk' : 'fa-plus'; ?>"></i>
                        <?php echo $isEdit ? 'Save Changes' : 'Add Project'; ?>
                    </button>
                </div>

            </div><!-- /col-lg-4 -->
        </div><!-- /row -->
    </form>
</div>

<script>
// Image upload preview
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('dropzoneLabel').textContent = input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Dropzone drag-over highlight
const dz = document.getElementById('dropzone');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.style.borderColor = 'var(--accent)'; dz.style.background = 'rgba(124,92,252,0.05)'; });
dz.addEventListener('dragleave', () => { dz.style.borderColor = 'var(--border)'; dz.style.background = ''; });
dz.addEventListener('drop', e => {
    e.preventDefault();
    dz.style.borderColor = 'var(--border)';
    dz.style.background = '';
    const input = document.getElementById('image');
    input.files = e.dataTransfer.files;
    previewImage(input);
});

// Set featured toggle initial background
const featuredCb = document.getElementById('is_featured');
if (featuredCb) featuredCb.style.background = featuredCb.checked ? 'var(--accent)' : 'var(--surface-2)';
</script>

<footer class="admin-footer">
    © 2026 Izaz Uddin. Admin Project Form.
</footer>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
