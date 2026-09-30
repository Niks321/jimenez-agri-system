<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/portal-nav.php';
?>
<main class="min-h-screen bg-surface-container-low <?= $departmentLabel === 'Fishery' ? 'fishery-main' : '' ?>">
	<section class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-xl">
		<p class="text-xs uppercase tracking-wider text-primary font-bold"><?= htmlspecialchars($departmentLabel) ?> department</p>
		<h1 class="text-3xl font-extrabold mt-2"><?= htmlspecialchars($departmentLabel) ?> Overview</h1>
		<p class="text-sm text-on-surface-variant mt-2 mb-space-lg">Records and activity for your assigned department.</p>
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
			<?php foreach ($departmentMetrics as [$label, $value, $icon, $url]): ?>
				<?php if ($url !== ''): ?><a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" class="fishery-metric-card bg-surface-container-lowest border border-surface-container rounded-lg p-5 hover:border-primary transition-colors"><?php else: ?><div class="fishery-metric-card bg-surface-container-lowest border border-surface-container rounded-lg p-5"><?php endif; ?>
					<span class="material-symbols-outlined text-primary text-2xl"><?= htmlspecialchars($icon) ?></span>
					<p class="text-xs uppercase tracking-wide text-on-surface-variant mt-3"><?= htmlspecialchars($label) ?></p>
					<p class="text-3xl font-extrabold text-on-surface mt-1"><?= number_format((int) $value) ?></p>
				<?php if ($url !== ''): ?></a><?php else: ?></div><?php endif; ?>
			<?php endforeach; ?>
		</div>
	</section>
</main>
<?php require_once __DIR__ . '/footer.php'; ?>
