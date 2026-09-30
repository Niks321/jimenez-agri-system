<?php
require_once __DIR__ . '/../../../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../backend/core/Database.php';
(new RoleMiddleware())->requireDepartment('crop');
$connection = (new Database())->connection();
$departmentLabel = 'Crop';
$pageTitle = 'Crop Workspace - Municipal Agriculture Office Jimenez';
$pageDescription = 'Crop department records and activity.';
$assetBase = 'assets';
$activePage = 'dashboard';
$departmentMetrics = [
	['Farmers', (int) $connection->query("SELECT COUNT(*) FROM farmers WHERE status = 'active'")->fetchColumn(), 'groups', 'workspace.php?page=crop/farmers'],
	['Crop varieties', (int) $connection->query("SELECT COUNT(*) FROM crops WHERE status = 'active' AND LOWER(TRIM(COALESCE(category, ''))) NOT IN ('vegetable', 'vegetables')")->fetchColumn(), 'agriculture', 'workspace.php?page=crop/farmers'],
];
require __DIR__ . '/../../components/department-dashboard.php';
