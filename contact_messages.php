<?php
// authentication/contact_messages.php
// Admin-only page to list contact messages.

require_once __DIR__ . '/../includes/auth_middleware.php';
require_once __DIR__ . '/../includes/helpers.php';

// This is just a redirect to the view.
header('Location: ../views/contact_messages_list_view.php');
exit();

