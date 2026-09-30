<?php
http_response_code(403);
$pageTitle = 'Access denied - Municipal Agriculture Office Jimenez';
require_once __DIR__ . '/../frontend/components/header.php';
?>
<main class="min-h-screen bg-surface-container-low flex items-center justify-center p-6">
	<section class="max-w-xl rounded-2xl border border-surface-container bg-surface-container-lowest p-8 text-center shadow-sm">
		<p class="text-xs font-bold uppercase tracking-wider text-primary">Restricted workspace</p>
		<h1 class="mt-3 text-3xl font-extrabold">Access denied</h1>
		<p class="mt-3 text-sm text-on-surface-variant">Your account cannot open this page or department's records.</p>
		<a class="mt-6 inline-flex rounded-lg bg-primary px-5 py-3 text-sm font-bold text-on-primary" href="workspace.php">Return to your workspace</a>
	</section>
</main>
