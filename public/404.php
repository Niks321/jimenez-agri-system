<?php
http_response_code(404);
$pageTitle = 'Page not found - Municipal Agriculture Office Jimenez';
require_once __DIR__ . '/../frontend/components/header.php';
?>
<main class="min-h-screen bg-surface-container-low flex items-center justify-center p-6">
	<section class="max-w-xl rounded-2xl border border-surface-container bg-surface-container-lowest p-8 text-center shadow-sm">
		<p class="text-xs font-bold uppercase tracking-wider text-primary">Municipal Agriculture Office Jimenez</p>
		<h1 class="mt-3 text-3xl font-extrabold">Page not found</h1>
		<p class="mt-3 text-sm text-on-surface-variant">The requested page is not available.</p>
		<a class="mt-6 inline-flex rounded-lg bg-primary px-5 py-3 text-sm font-bold text-on-primary" href="index.php">Return to the public portal</a>
	</section>
</main>
