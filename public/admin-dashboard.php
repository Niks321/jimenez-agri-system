<?php

require_once __DIR__ . '/../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../backend/security/SessionSecurity.php';
$roleMiddleware = new RoleMiddleware();
$roleMiddleware->requireRole('administrator');
$pageTitle = 'Administrator Dashboard - Municipal Agriculture Office Jimenez';
$pageDescription = 'Administrator dashboard for the Municipal Agriculture Office Jimenez information system.';
$assetBase = 'assets';
require_once __DIR__ . '/../frontend/components/header.php';
?>

<main class="min-h-screen bg-surface-container-low">
	<header class="bg-primary text-on-primary border-b-4 border-secondary-fixed">
		<div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-lg flex flex-wrap items-center justify-between gap-space-md">
			<div>
				<p class="text-xs uppercase tracking-wider text-secondary-fixed font-bold">Administrator access</p>
				<h1 class="text-3xl font-extrabold mt-2">Administration Dashboard</h1>
				<p class="text-sm text-surface-variant mt-2">Manage users, permissions, system records, and audit activity.</p>
			</div>
			<a class="rounded-lg bg-secondary-fixed text-on-secondary-fixed px-space-md py-space-xs font-bold text-sm" href="logout.php">Sign out</a>
		</div>
	</header>
	<section class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-xl">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
			<div class="bg-surface-container-lowest border border-surface-container rounded-lg p-space-lg"><p class="text-xs uppercase text-primary font-bold">Access control</p><h2 class="text-xl font-bold mt-2">Users and roles</h2><p class="text-sm text-on-surface-variant mt-2">Review administrator and personnel access.</p></div>
			<div class="bg-surface-container-lowest border border-surface-container rounded-lg p-space-lg"><p class="text-xs uppercase text-primary font-bold">System records</p><h2 class="text-xl font-bold mt-2">All modules</h2><p class="text-sm text-on-surface-variant mt-2">Monitor agriculture, fisheries, permits, and insurance data.</p></div>
			<div class="bg-surface-container-lowest border border-surface-container rounded-lg p-space-lg"><p class="text-xs uppercase text-primary font-bold">Security</p><h2 class="text-xl font-bold mt-2">Audit activity</h2><p class="text-sm text-on-surface-variant mt-2">Inspect security and accountability records.</p></div>
		</div>
	</section>
</main>