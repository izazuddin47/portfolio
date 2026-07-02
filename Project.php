<?php
// models/Project.php

class Project {
    /** @var PDO */
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get all active projects ordered by sort_order.
     */
    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM projects WHERE status = 'active' ORDER BY sort_order ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get ALL projects (active + hidden) for admin listing.
     */
    public function getAllAdmin(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM projects ORDER BY sort_order ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get a single project by ID.
     */
    public function getById(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Insert a new project record.
     */
    public function create(array $data): bool {
        $sql = "INSERT INTO projects
                    (title, description, features, tags, image, github_url, demo_url,
                     is_featured, badge_label, sort_order, status)
                VALUES
                    (:title, :description, :features, :tags, :image, :github_url, :demo_url,
                     :is_featured, :badge_label, :sort_order, :status)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':features'    => $data['features'],    // JSON string
            ':tags'        => $data['tags'],
            ':image'       => $data['image']       ?? null,
            ':github_url'  => $data['github_url']  ?? '#',
            ':demo_url'    => $data['demo_url']    ?? '#',
            ':is_featured' => $data['is_featured'] ?? 0,
            ':badge_label' => $data['badge_label'] ?? null,
            ':sort_order'  => $data['sort_order']  ?? 0,
            ':status'      => $data['status']      ?? 'active',
        ]);
    }

    /**
     * Update an existing project record.
     */
    public function update(int $id, array $data): bool {
        $sql = "UPDATE projects SET
                    title       = :title,
                    description = :description,
                    features    = :features,
                    tags        = :tags,
                    image       = :image,
                    github_url  = :github_url,
                    demo_url    = :demo_url,
                    is_featured = :is_featured,
                    badge_label = :badge_label,
                    sort_order  = :sort_order,
                    status      = :status
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':features'    => $data['features'],
            ':tags'        => $data['tags'],
            ':image'       => $data['image']       ?? null,
            ':github_url'  => $data['github_url']  ?? '#',
            ':demo_url'    => $data['demo_url']    ?? '#',
            ':is_featured' => $data['is_featured'] ?? 0,
            ':badge_label' => $data['badge_label'] ?? null,
            ':sort_order'  => $data['sort_order']  ?? 0,
            ':status'      => $data['status']      ?? 'active',
            ':id'          => $id,
        ]);
    }

    /**
     * Delete a project by ID. Returns the image path before deletion.
     */
    public function delete(int $id): ?string {
        $project = $this->getById($id);
        if (!$project) return null;

        $stmt = $this->db->prepare("DELETE FROM projects WHERE id = :id");
        $stmt->execute([':id' => $id]);

        return $project['image']; // Caller may delete the file
    }

    /**
     * Count of total projects (for dashboard stat).
     */
    public function count(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM projects");
        return (int) $stmt->fetchColumn();
    }
}
