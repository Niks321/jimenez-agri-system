<?php
require_once __DIR__ . '/../../backend/controllers/FisheryController.php';
$activePage = $activePage ?? '';
$fisherySection = FisheryController::validSection($_GET['section'] ?? 'active');
$navItems = [
    'dashboard' => ['Personnel Home', 'personnel-dashboard.php', 'dashboard'],
    'farmers' => ['Farmers', 'personnel-farmers.php', 'groups'],
    'fisheries' => ['Fishery', 'personnel-fishery.php', 'set_meal'],
    'livestock' => ['Livestock', 'personnel-livestock.php', 'pets'],
    'vegetables' => ['Vegetables', 'personnel-vegetables.php', 'potted_plant'],
    'prices' => ['Price Monitoring', 'personnel-prices.php', 'monitoring'],
    'insurance' => ['Insurance', 'personnel-insurance.php', 'shield'],
    'reports' => ['Reports', 'personnel-reports.php', 'summarize'],
];
?>
<aside id="personnel-sidebar" class="hidden lg:block fixed inset-y-0 left-0 z-50 w-[min(18rem,calc(100vw-1rem))] lg:w-64 bg-primary text-on-primary shadow-xl" aria-label="Personnel navigation" aria-hidden="true">
    <div class="h-full px-4 py-4 lg:px-5 lg:py-6 flex flex-col gap-3 overflow-y-auto">
        <div class="border-b border-white/20 pb-5 mb-2">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs uppercase tracking-wider text-secondary-fixed font-bold">Jimenez Agri System</p>
                    <p class="text-lg font-extrabold mt-2">Personnel Portal</p>
                    <p class="text-xs text-surface-variant mt-1">Data entry and monitoring</p>
                </div>
                <button id="personnel-nav-toggle" type="button" class="inline-flex items-center justify-center rounded-lg border border-white/30 p-2 text-white hover:bg-white/10" aria-label="Hide personnel navigation" aria-controls="personnel-sidebar" aria-expanded="true">
                    <span class="material-symbols-outlined">menu_open</span>
                </button>
            </div>
        </div>
        <div class="flex flex-wrap lg:flex-col gap-2 flex-1">
        <?php foreach ($navItems as $key => [$label, $url, $icon]): ?>
            <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors <?= $activePage === $key ? 'bg-secondary-fixed text-on-secondary-fixed' : 'text-white/85 hover:bg-white/10 hover:text-white' ?>" <?= $activePage === $key ? 'aria-current="page"' : '' ?>>
                <span class="material-symbols-outlined text-base"><?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?></span>
                <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
            </a>
            <?php if ($key === 'fisheries' && $activePage === 'fisheries'): ?>
                <div class="ml-5 border-l border-white/25 pl-3 space-y-1" aria-label="Fishery navigation">
                    <?php foreach (FisheryController::navigation() as $navSection => $item): ?>
                        <a href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>" class="block rounded-md px-3 py-2 text-xs font-semibold <?= $fisherySection === $navSection ? 'bg-secondary-fixed text-on-secondary-fixed' : 'text-white/75 hover:bg-white/10 hover:text-white' ?>" <?= $fisherySection === $navSection ? 'aria-current="page"' : '' ?>><?= htmlspecialchars($item['label']) ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </div>
</aside>
<div id="personnel-sidebar-overlay" class="hidden fixed inset-0 z-40 bg-black/50" aria-hidden="true"></div>
<?php
$personnelHeaderTitle = $personnelHeaderTitle ?? ($pageTitle ?? 'Personnel Workspace');
$personnelHeaderSubtitle = $personnelHeaderSubtitle ?? 'Municipal Agriculture Office Jimenez';
require_once __DIR__ . '/personnel-header.php';
?>
<style>
html:has(aside[aria-label="Personnel navigation"]),
body:has(aside[aria-label="Personnel navigation"]) { max-width: 100%; }
@media (min-width: 1024px) {
    body:has(aside[aria-label="Personnel navigation"]) header,
    body:has(aside[aria-label="Personnel navigation"]) main,
    body:has(aside[aria-label="Personnel navigation"]) footer { margin-left: 16rem; width: calc(100vw - 16rem); max-width: calc(100vw - 16rem); box-sizing: border-box; }
}
@media (max-width: 1023px) {
    body:has(aside[aria-label="Personnel navigation"]) header,
    body:has(aside[aria-label="Personnel navigation"]) main,
    body:has(aside[aria-label="Personnel navigation"]) footer { margin-left: 0; width: 100%; max-width: 100%; }
    #personnel-sidebar { top: 5rem; }
    #personnel-sidebar-overlay { top: 5rem; }
}
</style>
