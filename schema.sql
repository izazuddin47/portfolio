-- ═══════════════════════════════════════════════════
-- Portfolio DB Schema — portfolio_db
-- Includes: admins + projects tables with seed data
-- ═══════════════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS `portfolio_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `portfolio_db`;

-- ─── ADMINS TABLE ────────────────────────────────────
CREATE TABLE IF NOT EXISTS `admins` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `full_name`  VARCHAR(100) NOT NULL,
    `username`   VARCHAR(50)  NOT NULL UNIQUE,
    `email`      VARCHAR(100) NOT NULL UNIQUE,
    `password`   VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_username` (`username`),
    INDEX `idx_email`    (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ─── PROJECTS TABLE ──────────────────────────────────
CREATE TABLE IF NOT EXISTS `projects` (
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `title`       VARCHAR(150)                      NOT NULL,
    `description` TEXT                              NOT NULL,
    `features`    JSON                              NOT NULL COMMENT 'JSON array of feature bullet points',
    `tags`        VARCHAR(255)                      NOT NULL COMMENT 'Comma-separated technology tags',
    `image`       VARCHAR(255)                      DEFAULT NULL COMMENT 'Relative path to project image',
    `github_url`  VARCHAR(255)                      DEFAULT '#',
    `demo_url`    VARCHAR(255)                      DEFAULT '#',
    `is_featured` TINYINT(1)                        DEFAULT 0 COMMENT '1 = full-width featured card',
    `badge_label` VARCHAR(50)                       DEFAULT NULL COMMENT 'e.g. FYP badge text',
    `sort_order`  INT                               DEFAULT 0,
    `status`      ENUM('active','hidden')           DEFAULT 'active',
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status`     (`status`),
    INDEX `idx_sort_order` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ─── SEED: 8 PORTFOLIO PROJECTS ──────────────────────
-- Only insert if table is empty (safe re-run)
INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Digital Time Tracker System' AS title,
    'Final Year Project — A role-based web application for software houses to manage projects, track employee work hours, monitor task progress, and generate productivity reports. Features Super Admin, Admin, and User panels.' AS description,
    '["Role-based access control (3 panels)", "Real-time task & time tracking", "Dashboard analytics & productivity reports", "User authentication & project management"]' AS features,
    'PHP,MySQL,Bootstrap,JavaScript' AS tags,
    'project-img/GTT.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    1  AS is_featured,
    'FYP' AS badge_label,
    1  AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Digital Time Tracker System');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Expense Management System' AS title,
    'A web app for tracking daily expenses with category-wise reporting and data visualisation dashboards.' AS description,
    '["Category-wise expense tracking", "Data visualisation charts", "MySQL database integration"]' AS features,
    'PHP,MySQL,Bootstrap' AS tags,
    'project-img/expenes.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    2 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Expense Management System');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Medicine Management System' AS title,
    'PHP-based hospital management web app for handling patient records, appointment scheduling, and doctor details.' AS description,
    '["Patient record management", "Appointment scheduling", "Doctor detail management"]' AS features,
    'PHP,MySQL,Bootstrap' AS tags,
    'project-img/medicin.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    3 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Medicine Management System');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Personal Blog CMS' AS title,
    'A content management system for creating and managing blog posts, categories, and content with a full admin panel.' AS description,
    '["Admin panel for full content control", "Category & post management", "MySQL database integration"]' AS features,
    'PHP,MySQL,Bootstrap' AS tags,
    'project-img/blog.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    4 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Personal Blog CMS');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Shared Grocery List Web App' AS title,
    'A collaborative grocery management application for adding, tracking, and completing shopping items with quantity management.' AS description,
    '["Add / check-off grocery items", "Quantity & list tracking", "MySQL persistence"]' AS features,
    'PHP,MySQL,JavaScript' AS tags,
    'project-img/Grocery.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    5 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Shared Grocery List Web App');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Contact Management System' AS title,
    'A web-based contact management application for storing, searching, and organising personal and business contacts.' AS description,
    '["CRUD contact operations", "Search & filter functionality", "User authentication"]' AS features,
    'PHP,MySQL,Bootstrap' AS tags,
    'project-img/contact.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    6 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Contact Management System');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'School Management System' AS title,
    'A comprehensive school administration web app to manage students, teachers, classes, and academic records.' AS description,
    '["Student & teacher management", "Class & timetable scheduling", "Academic records tracking"]' AS features,
    'PHP,MySQL,Bootstrap' AS tags,
    'project-img/school.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    7 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'School Management System');

INSERT INTO `projects`
    (`title`, `description`, `features`, `tags`, `image`, `github_url`, `demo_url`, `is_featured`, `badge_label`, `sort_order`, `status`)
SELECT * FROM (SELECT
    'Blood Donation Management System' AS title,
    'A community-facing web platform to connect blood donors with recipients, manage donor records, and track blood group availability.' AS description,
    '["Donor registration & search", "Blood group inventory", "Request & matching system"]' AS features,
    'PHP,MySQL,Bootstrap' AS tags,
    'project-img/blood.png' AS image,
    '#' AS github_url,
    '#' AS demo_url,
    0 AS is_featured,
    NULL AS badge_label,
    8 AS sort_order,
    'active' AS status
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `projects` WHERE `title` = 'Blood Donation Management System');

-- ─── CONTACT MESSAGES TABLE ──────────────────────────
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `message` TEXT NOT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

