<?php
// authentication/projects.php
// Protected entry point for the admin Projects Manager

// Bootstrap DB connection
$db = require_once __DIR__ . '/../config/db.php';

// Auth middleware — redirects to login if not authenticated
require_once __DIR__ . '/../includes/auth_middleware.php';
require_once __DIR__ . '/../includes/helpers.php';

// Bootstrap Controller
require_once __DIR__ . '/../controllers/ProjectController.php';
$projectController = new ProjectController($db);

$errors   = [];
$project  = null;
$isEdit   = false;
$action   = $_GET['action'] ?? ($_POST['action'] ?? 'list');

// ─── POST HANDLER ──────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF validation
    $csrfToken = $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($csrfToken)) {
        $errors['general'] = 'Security token mismatch. Please refresh and try again.';
    } else {
        switch ($action) {
            // ── CREATE ──
            case 'create':
                $result = $projectController->handleCreate($_POST, $_FILES);
                if ($result['success']) {
                    header('Location: projects.php');
                    exit();
                }
                $errors = $result['errors'];
                $action = 'add'; // Stay on add form
                break;

            // ── UPDATE ──
            case 'update':
                $projectId = (int) ($_POST['project_id'] ?? 0);
                $result    = $projectController->handleUpdate($projectId, $_POST, $_FILES);
                if ($result['success']) {
                    header('Location: projects.php');
                    exit();
                }
                $errors   = $result['errors'];
                $isEdit   = true;
                $action   = 'edit';
                $project  = $projectController->handleList();
                // Re-fetch the specific project
                require_once __DIR__ . '/../models/Project.php';
                $projectModel = new Project($db);
                $project = $projectModel->getById($projectId);
                break;

            // ── DELETE ──
            case 'delete':
                $projectId = (int) ($_POST['project_id'] ?? 0);
                $projectController->handleDelete($projectId);
                header('Location: projects.php');
                exit();
        }
    }
}

// ─── GET HANDLER ───────────────────────────────────────
switch ($action) {

    // ── ADD FORM ──
    case 'add':
        $isEdit  = false;
        $project = null;
        require_once __DIR__ . '/../views/project_form_view.php';
        break;

    // ── EDIT FORM ──
    case 'edit':
        $projectId = (int) ($_GET['id'] ?? $_POST['project_id'] ?? 0);
        require_once __DIR__ . '/../models/Project.php';
        $projectModel = new Project($db);
        $project = $projectModel->getById($projectId);

        if (!$project) {
            set_flash_message('project_success', 'Project not found.', 'danger');
            header('Location: projects.php');
            exit();
        }

        $isEdit = true;
        require_once __DIR__ . '/../views/project_form_view.php';
        break;

    // ── LIST (default) ──
    default:
        $projects      = $projectController->handleList();
        $projectCount  = count($projects);
        require_once __DIR__ . '/../views/projects_list_view.php';
        break;
}
