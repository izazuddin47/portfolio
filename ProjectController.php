<?php
// controllers/ProjectController.php

class ProjectController {
    /** @var PDO */
    private $db;

    /** @var Project */
    private $projectModel;

    /** Allowed image MIME types */
    private const ALLOWED_MIME = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    /** Max upload size: 5 MB */
    private const MAX_SIZE = 5 * 1024 * 1024;

    /** Upload directory (relative to project root) */
    private const UPLOAD_DIR = 'uploads/projects/';

    public function __construct(PDO $db) {
        $this->db = $db;
        require_once __DIR__ . '/../models/Project.php';
        $this->projectModel = new Project($db);
        require_once __DIR__ . '/../includes/helpers.php';
    }

    // ─── LIST ─────────────────────────────────────────
    /**
     * Return all projects for admin listing.
     */
    public function handleList(): array {
        return $this->projectModel->getAllAdmin();
    }

    // ─── CREATE ───────────────────────────────────────
    /**
     * Validate, process image upload, and insert new project.
     *
     * @return array ['success'=>bool, 'errors'=>array, 'message'=>string]
     */
    public function handleCreate(array $post, array $files): array {
        $errors = $this->validateForm($post);

        // Handle image upload
        $imagePath = null;
        if (!empty($files['image']['name'])) {
            $upload = $this->handleImageUpload($files['image']);
            if ($upload['error']) {
                $errors['image'] = $upload['error'];
            } else {
                $imagePath = $upload['path'];
            }
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'message' => ''];
        }

        $data = $this->buildData($post, $imagePath);
        $ok   = $this->projectModel->create($data);

        if ($ok) {
            set_flash_message('project_success', 'Project added successfully!', 'success');
            return ['success' => true, 'errors' => [], 'message' => 'Project added successfully!'];
        }

        return ['success' => false, 'errors' => ['general' => 'Database error — could not save project.'], 'message' => ''];
    }

    // ─── UPDATE ───────────────────────────────────────
    /**
     * Validate and update an existing project.
     */
    public function handleUpdate(int $id, array $post, array $files): array {
        $existing = $this->projectModel->getById($id);
        if (!$existing) {
            return ['success' => false, 'errors' => ['general' => 'Project not found.'], 'message' => ''];
        }

        $errors = $this->validateForm($post);

        // Handle optional new image upload
        $imagePath = $existing['image']; // Keep old image by default
        if (!empty($files['image']['name'])) {
            $upload = $this->handleImageUpload($files['image']);
            if ($upload['error']) {
                $errors['image'] = $upload['error'];
            } else {
                // Delete old uploaded image (only if it was in uploads/ folder)
                $this->deleteUploadedImage($existing['image']);
                $imagePath = $upload['path'];
            }
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'message' => ''];
        }

        $data = $this->buildData($post, $imagePath);
        $ok   = $this->projectModel->update($id, $data);

        if ($ok) {
            set_flash_message('project_success', 'Project updated successfully!', 'success');
            return ['success' => true, 'errors' => [], 'message' => 'Project updated successfully!'];
        }

        return ['success' => false, 'errors' => ['general' => 'Database error — could not update project.'], 'message' => ''];
    }

    // ─── DELETE ───────────────────────────────────────
    /**
     * Delete a project and its uploaded image file.
     */
    public function handleDelete(int $id): array {
        $existing = $this->projectModel->getById($id);
        if (!$existing) {
            return ['success' => false, 'message' => 'Project not found.'];
        }

        $imagePath = $this->projectModel->delete($id);

        // Delete the file only if it was an upload (not a seeded project-img path)
        $this->deleteUploadedImage($imagePath);

        set_flash_message('project_success', 'Project deleted successfully!', 'success');
        return ['success' => true, 'message' => 'Project deleted successfully!'];
    }

    // ─── PRIVATE HELPERS ──────────────────────────────

    /**
     * Validate form inputs.
     */
    private function validateForm(array $post): array {
        $errors = [];

        if (empty(trim($post['title'] ?? ''))) {
            $errors['title'] = 'Project title is required.';
        } elseif (strlen(trim($post['title'])) > 150) {
            $errors['title'] = 'Title must not exceed 150 characters.';
        }

        if (empty(trim($post['description'] ?? ''))) {
            $errors['description'] = 'Project description is required.';
        }

        if (empty(trim($post['features'] ?? ''))) {
            $errors['features'] = 'At least one project feature is required.';
        }

        if (empty(trim($post['tags'] ?? ''))) {
            $errors['tags'] = 'At least one technology tag is required.';
        }

        return $errors;
    }

    /**
     * Build the data array for model insert/update.
     */
    private function buildData(array $post, ?string $imagePath): array {
        // Parse features: one per line → JSON array
        $rawFeatures  = trim($post['features'] ?? '');
        $featuresArr  = array_filter(array_map('trim', explode("\n", $rawFeatures)));
        $featuresJson = json_encode(array_values($featuresArr), JSON_UNESCAPED_UNICODE);

        // Parse tags: comma-separated, trimmed
        $rawTags = trim($post['tags'] ?? '');
        $tagsArr = array_filter(array_map('trim', explode(',', $rawTags)));
        $tags    = implode(',', $tagsArr);

        return [
            'title'       => htmlspecialchars(trim($post['title']),       ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars(trim($post['description']), ENT_QUOTES, 'UTF-8'),
            'features'    => $featuresJson,
            'tags'        => htmlspecialchars($tags,                       ENT_QUOTES, 'UTF-8'),
            'image'       => $imagePath,
            'github_url'  => htmlspecialchars(trim($post['github_url']  ?? '#'), ENT_QUOTES, 'UTF-8'),
            'demo_url'    => htmlspecialchars(trim($post['demo_url']    ?? '#'), ENT_QUOTES, 'UTF-8'),
            'is_featured' => isset($post['is_featured']) ? 1 : 0,
            'badge_label' => !empty($post['badge_label']) ? htmlspecialchars(trim($post['badge_label']), ENT_QUOTES, 'UTF-8') : null,
            'sort_order'  => (int) ($post['sort_order'] ?? 0),
            'status'      => in_array($post['status'] ?? '', ['active', 'hidden']) ? $post['status'] : 'active',
        ];
    }

    /**
     * Handle file upload validation and saving.
     *
     * @return array ['path' => string|null, 'error' => string|null]
     */
    private function handleImageUpload(array $file): array {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['path' => null, 'error' => 'File upload failed. Please try again.'];
        }

        if ($file['size'] > self::MAX_SIZE) {
            return ['path' => null, 'error' => 'Image must be under 5 MB.'];
        }

        // Detect real MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, self::ALLOWED_MIME)) {
            return ['path' => null, 'error' => 'Only JPG, PNG, GIF, and WebP images are allowed.'];
        }

        // Generate unique filename
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'project_' . bin2hex(random_bytes(8)) . '.' . strtolower($ext);

        // Absolute upload path
        $projectRoot = rtrim(dirname(__DIR__), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $uploadDir   = $projectRoot . self::UPLOAD_DIR;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $dest = $uploadDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            return ['path' => null, 'error' => 'Failed to save uploaded file.'];
        }

        return ['path' => self::UPLOAD_DIR . $filename, 'error' => null];
    }

    /**
     * Delete a file from uploads/ folder only (not seeded project-img/ paths).
     */
    private function deleteUploadedImage(?string $imagePath): void {
        if (!$imagePath) return;
        // Only delete files we uploaded (in uploads/projects/)
        if (strpos($imagePath, 'uploads/') === 0) {
            $projectRoot = rtrim(dirname(__DIR__), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            $fullPath    = $projectRoot . $imagePath;
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    /**
     * Get count of total projects (for dashboard stat widget).
     */
    public function getCount(): int {
        return $this->projectModel->count();
    }
}
