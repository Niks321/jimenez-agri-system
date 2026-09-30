<?php

require_once __DIR__ . '/../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../backend/security/SessionSecurity.php';

SessionSecurity::start();
SessionSecurity::preventCaching();

$roleMiddleware = new RoleMiddleware();
$role = $_SESSION['user']['role'] ?? null;
$department = $role === 'administrator'
	? 'administration'
	: ($_SESSION['user']['department'] ?? null);

$pagesByDepartment = [
	'administration' => [
		'administration/dashboard' => 'administration/dashboard.php',
		'administration/reports' => 'administration/reports.php',
		'administration/insurance' => 'administration/insurance.php',
	],
	'crop' => [
		'crop/dashboard' => 'crop/dashboard.php',
		'crop/farmers' => 'crop/farmers.php',
	],
	'vegetables' => [
		'vegetables/dashboard' => 'vegetables/dashboard.php',
		'vegetables/vegetables' => 'vegetables/vegetables.php',
		'vegetables/prices' => 'vegetables/prices.php',
	],
	'fishery' => [
		'fishery/dashboard' => 'fisheries/dashboard.php',
		'fishery/profile' => 'fisheries/fishermen.php',
		'fishery/catches' => 'fisheries/fish-catch.php',
		'fishery/application' => 'fisheries/application.php',
	],
	'livestock' => [
		'livestock/dashboard' => 'livestock/dashboard.php',
		'livestock/records' => 'livestock/monitoring.php',
	],
];

if ($role === 'administrator') {
	$roleMiddleware->requireRole('administrator');
} elseif ($role === 'staff' && is_string($department)) {
	$roleMiddleware->requireDepartment($department);
} else {
	header('Location: 403.php', true, 303);
	exit;
}

$pages = $pagesByDepartment[$department] ?? [];
$page = $_GET['page'] ?? $department . '/dashboard';
$entryPoint = is_string($page) ? ($pages[$page] ?? null) : null;

if ($entryPoint === null) {
	header('Location: 403.php', true, 303);
	exit;
}

require __DIR__ . '/../frontend/pages/' . $entryPoint;
