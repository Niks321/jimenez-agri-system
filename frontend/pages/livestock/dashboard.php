<?php
require_once __DIR__ . '/../../../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../backend/core/Database.php';
(new RoleMiddleware())->requireDepartment('livestock');
$connection = (new Database())->connection();
$departmentLabel = 'Livestock';
$pageTitle = 'Livestock Workspace - Municipal Agriculture Office Jimenez';
$pageDescription = 'Livestock records and activity.';
$assetBase = 'assets';
$activePage = 'dashboard';
$departmentMetrics = [
	['Active animals', (int) $connection->query("SELECT COALESCE(SUM(quantity), 0) FROM livestock WHERE status = 'active'")->fetchColumn(), 'pets', 'workspace.php?page=livestock/records'],
	['Livestock records', (int) $connection->query('SELECT COUNT(*) FROM livestock')->fetchColumn(), 'inventory_2', 'workspace.php?page=livestock/records'],
];
require __DIR__ . '/../../components/department-dashboard.php';