# Jimenez Agricultural Information System

PHP and MariaDB application for the Municipal Agriculture Office of Jimenez.

## Project layout

- `public/` contains the only web entry points and browser-facing assets.
- `frontend/pages/` contains page templates grouped by workspace: administration, crop, vegetables, fisheries, and livestock.
- `frontend/components/` contains shared page shell and navigation components.
- `public/assets/` contains shared styles and scripts plus department-specific asset folders such as `css/fisheries/` and `js/fisheries/`.
- `backend/` contains controllers, repositories, services, middleware, and security code. Department data access is checked in the backend service/repository layer as well as on each page.
- `database/migrations/` contains ordered schema changes; `seeders/` and `views/` contain reference data and reporting views.
- `storage/` is for runtime files and must not be web accessible.

## Workspace identities

The application supports five workspace identities: an administrator and staff for the crop, vegetables, livestock, and fisheries departments. Department is stored with staff accounts; valid values are `crop`, `vegetables`, `livestock`, and `fishery`. Multiple accounts can belong to a department. Staff are authorized for their own workspace, while the administrator can access all department data.

## Local setup

1. Configure Apache so the project root is the site root and `mod_rewrite` plus `.htaccess` overrides are enabled. The root rewrite sends requests through `public/` and denies direct requests to source and data directories. For production, setting Apache `DocumentRoot` directly to this project's `public/` directory is preferred.
2. Copy `.env.example` to `.env` and set database credentials and a private `APP_KEY`. Add Turnstile keys if using Cloudflare verification.
3. Create the database, then import every migration in numeric order through `025_department_data_isolation.sql`.
4. Import reference seeders as needed. Create administrator and staff accounts through a trusted local process; assign each staff account exactly one supported department.
5. Open `public/` (or the configured site root) in a browser and sign in through `login.php`.

Back up an existing database before applying migration 025. It disables unsupported legacy account identities and separates livestock owner records from the crop farmer table.
