<?php
$activePage = $activePage ?? '';
$department = $_SESSION['user']['department'] ?? null;
$fisherySection = $fisherySection ?? 'active';
$fisheryNavigation = $fisheryNavigation ?? [];

$workspace = match ($department) {
	'crop' => [
		'label' => 'Crop',
		'items' => [
			'dashboard' => ['Overview', 'workspace.php?page=crop/dashboard', 'dashboard'],
			'farmers' => ['Farmers', 'workspace.php?page=crop/farmers', 'groups'],
		],
	],
	'vegetables' => [
		'label' => 'Vegetables',
		'items' => [
			'dashboard' => ['Overview', 'workspace.php?page=vegetables/dashboard', 'dashboard'],
			'vegetables' => ['Vegetable records', 'workspace.php?page=vegetables/vegetables', 'potted_plant'],
			'prices' => ['Price monitoring', 'workspace.php?page=vegetables/prices', 'monitoring'],
		],
	],
	'fishery' => [
		'label' => 'Fishery',
		'items' => [
			'dashboard' => ['Overview', 'workspace.php?page=fishery/dashboard', 'dashboard'],
			'fisheries' => ['Fishery records', 'workspace.php?page=fishery/records', 'set_meal'],
		],
	],
	'livestock' => [
		'label' => 'Livestock',
		'items' => [
			'dashboard' => ['Overview', 'workspace.php?page=livestock/dashboard', 'dashboard'],
			'livestock' => ['Livestock records', 'workspace.php?page=livestock/records', 'pets'],
		],
	],
	default => [
		'label' => 'Administration',
		'items' => [
			'dashboard' => ['Overview', 'workspace.php?page=administration/dashboard', 'dashboard'],
			'reports' => ['Reports', 'workspace.php?page=administration/reports', 'summarize'],
			'insurance' => ['Insurance', 'workspace.php?page=administration/insurance', 'shield'],
		],
	],
};

$navItems = $workspace['items'];
$personnelHeaderTitle = $personnelHeaderTitle ?? ($pageTitle ?? $workspace['label'] . ' Workspace');
$personnelHeaderSubtitle = $personnelHeaderSubtitle ?? $workspace['label'] . ' department workspace';
?>
<aside id="personnel-sidebar" class="hidden lg:block fixed inset-y-0 left-0 z-50 w-[min(18rem,calc(100vw-1rem))] lg:w-64 bg-primary text-on-primary shadow-xl" aria-label="<?= htmlspecialchars($workspace['label']) ?> navigation" aria-hidden="true">
	<div class="h-full px-4 py-4 lg:px-5 lg:py-6 flex flex-col gap-3 overflow-y-auto">
		<div class="border-b border-white/20 pb-5 mb-2">
			<div class="flex items-start justify-between gap-3">
				<div>
					<p class="text-xs uppercase tracking-wider text-secondary-fixed font-bold">Jimenez Agri System</p>
					<p class="text-lg font-extrabold mt-2"><?= htmlspecialchars($workspace['label']) ?> Workspace</p>
					<p class="text-xs text-surface-variant mt-1">Restricted department access</p>
				</div>
				<button id="personnel-nav-toggle" type="button" class="inline-flex items-center justify-center rounded-lg border border-white/30 p-2 text-white hover:bg-white/10" aria-label="Hide navigation" aria-controls="personnel-sidebar" aria-expanded="true">
					<span class="material-symbols-outlined">menu_open</span>
				</button>
			</div>
		</div>
		<nav class="flex flex-wrap lg:flex-col gap-2 flex-1">
			<?php foreach ($navItems as $key => [$label, $url, $icon]): ?>
				<a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors <?= $activePage === $key ? 'bg-secondary-fixed text-on-secondary-fixed' : 'text-white/85 hover:bg-white/10 hover:text-white' ?>" <?= $activePage === $key ? 'aria-current="page"' : '' ?>><span class="material-symbols-outlined text-base"><?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?></span><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></a>
				<?php if ($key === 'fisheries' && $activePage === 'fisheries'): ?>
					<div class="ml-5 border-l border-white/25 pl-3 space-y-1" aria-label="Fishery navigation">
						<?php foreach ($fisheryNavigation as $navSection => $item): ?>
							<a href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>" class="block rounded-md px-3 py-2 text-xs font-semibold <?= $fisherySection === $navSection ? 'bg-secondary-fixed text-on-secondary-fixed' : 'text-white/75 hover:bg-white/10 hover:text-white' ?>" <?= $fisherySection === $navSection ? 'aria-current="page"' : '' ?>><?= htmlspecialchars($item['label']) ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<a href="logout.php" class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-white/85 hover:bg-white/10 hover:text-white"><span class="material-symbols-outlined text-base">logout</span>Sign out</a>
		</nav>
	</div>
</aside>
<div id="personnel-sidebar-overlay" class="hidden fixed inset-0 z-40 bg-black/50" aria-hidden="true"></div>
<?php require_once __DIR__ . '/personnel-header.php'; ?>