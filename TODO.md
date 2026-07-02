# TODO - Admin CRUD + Dynamic index

## Phase 1: Database
- [x] Update `database/schema.sql` with tables for: projects, skills, experience, education, certifications, contact_messages.
- [x] Ensure indexes + timestamps.




## Phase 2: Backend (PHP)
- [ ] Add generic CRUD model(s) + controller(s) (likely one controller for portfolio content).
- [ ] Add routing/handlers for: list/create/update/delete.
- [ ] Ensure CSRF protection for all POST actions.

## Phase 3: Views (Admin)
- [ ] Create protected pages in `/views/`:
  - [ ] `admin_projects.php`
  - [ ] `admin_skills.php`
  - [ ] `admin_experience.php`
  - [ ] `admin_education.php`
  - [ ] `admin_certifications.php`
  - [ ] `admin_contact_messages.php`
- [ ] Update `views/dashboard_view.php` navigation to include links to all admin CRUD pages.

## Phase 4: Public site dynamic
- [ ] Convert `index.html` to `index.php` (or create `index.php`) to load sections from DB.
- [ ] Update `views/admin_*` to update the public content.

## Phase 5: Testing
- [ ] Import schema into MySQL.
- [ ] Register/login admin.
- [ ] Verify CRUD (create/edit/delete) for all sections.
- [ ] Verify public homepage reflects updated data.

