<?php
require_once __DIR__ . '/../../../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../backend/core/Database.php';
(new RoleMiddleware())->requireDepartment('vegetables');
$connection = (new Database())->connection();
$departmentLabel = 'Vegetables';
$pageTitle = 'Vegetable Workspace - Municipal Agriculture Office Jimenez';
$pageDescription = 'Vegetable records and price activity.';
$assetBase = 'assets';
$activePage = 'dashboard';
$departmentMetrics = [
	['Vegetable varieties', (int) $connection->query("SELECT COUNT(*) FROM crops WHERE status = 'active' AND LOWER(TRIM(COALESCE(category, ''))) IN ('vegetable', 'vegetables')")->fetchColumn(), 'potted_plant', 'workspace.php?page=vegetables/vegetables'],
	['Price entries', (int) $connection->query("SELECT COUNT(*) FROM price_monitoring pm INNER JOIN products p ON p.id = pm.product_id WHERE LOWER(TRIM(COALESCE(p.category, ''))) IN ('vegetable', 'vegetables', 'grain', 'grains')")->fetchColumn(), 'monitoring', 'workspace.php?page=vegetables/prices'],
];
require __DIR__ . '/../../components/department-dashboard.php';
