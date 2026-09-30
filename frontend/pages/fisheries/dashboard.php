<?php
require_once __DIR__ . '/../../../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../backend/core/Database.php';
(new RoleMiddleware())->requireDepartment('fishery');
$connection = (new Database())->connection();
$departmentLabel = 'Fishery';
$pageTitle = 'Fishery Workspace - Municipal Agriculture Office Jimenez';
$pageDescription = 'Fishery records and activity.';
$assetBase = 'assets';
$activePage = 'dashboard';
$departmentMetrics = [
	['Active fisherfolk', (int) $connection->query("SELECT COUNT(*) FROM fishermen WHERE status = 'active'")->fetchColumn(), 'groups', 'workspace.php?page=fishery/records'],
	['Catch records', (int) $connection->query('SELECT COUNT(*) FROM fish_catch')->fetchColumn(), 'set_meal', 'workspace.php?page=fishery/records'],
];
require __DIR__ . '/../../components/department-dashboard.php';