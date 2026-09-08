<?php

require_once __DIR__ . '/../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../backend/services/PersonnelDataService.php';
$roleMiddleware = new RoleMiddleware();
$roleMiddleware->requireRole('staff');
$analytics = (new PersonnelDataService(new Database()))->dashboardAnalytics();
$pageTitle = 'Personnel Analytics Dashboard - Municipal Agriculture Office Jimenez';
$pageDescription = 'Analytics dashboard for agriculture, fisheries, livestock, and market monitoring.';
$assetBase = 'assets';
$activePage = 'dashboard';
$personnelHeaderTitle = 'Municipal Agriculture Monitoring';
$personnelHeaderSubtitle = 'Live summary of agriculture, fisheries, livestock, and market monitoring.';
require_once __DIR__ . '/../frontend/components/header.php';
require_once __DIR__ . '/../frontend/components/personnel-nav.php';
?>

<main class="min-h-screen bg-surface-container-low">
	<section class="px-gutter-mobile lg:px-gutter-desktop py-space-xl space-y-space-lg">
		<div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
			<?php foreach ([['Farmers', $analytics['counts']['farmers'], 'groups', 'personnel-farmers.php'], ['Livestock', $analytics['counts']['livestock'], 'pets', 'personnel-livestock.php'], ['Fish catch records', $analytics['counts']['fish_catch'], 'set_meal', 'personnel-fishery.php'], ['Price entries', $analytics['counts']['price_entries'], 'monitoring', 'personnel-prices.php'], ['Insurance', $analytics['counts']['insurance_entries'], 'shield', 'personnel-insurance.php']] as [$label, $value, $icon, $url]): ?>
				<a href="<?= $url ?>" class="bg-surface-container-lowest border border-surface-container rounded-lg p-4 sm:p-5 hover:border-primary transition-colors"><span class="material-symbols-outlined text-primary text-2xl"><?= $icon ?></span><p class="text-xs uppercase tracking-wide text-on-surface-variant mt-3"><?= $label ?></p><p class="text-3xl font-extrabold text-on-surface mt-1"><?= number_format((int) $value) ?></p></a>
			<?php endforeach; ?>
		</div>
		<div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1.45fr)_minmax(300px,.8fr)] gap-space-lg">
			<article class="bg-surface-container-lowest border border-surface-container rounded-lg p-4 sm:p-6"><div class="flex items-start justify-between gap-4 mb-4"><div><p class="text-xs uppercase tracking-wider text-primary font-bold">Market movement</p><h2 class="text-xl font-bold mt-1">Average monitored price</h2></div><span class="material-symbols-outlined text-primary">show_chart</span></div><div class="h-72"><canvas id="price-trend-chart" aria-label="Average monitored price trend"></canvas></div></article>
			<article class="bg-surface-container-lowest border border-surface-container rounded-lg p-4 sm:p-6"><div class="flex items-start justify-between gap-4 mb-4"><div><p class="text-xs uppercase tracking-wider text-primary font-bold">Fisheries activity</p><h2 class="text-xl font-bold mt-1">Catch volume by day</h2></div><span class="material-symbols-outlined text-primary">waves</span></div><div class="h-72"><canvas id="catch-trend-chart" aria-label="Fish catch volume trend"></canvas></div></article>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg">
			<article class="bg-surface-container-lowest border border-surface-container rounded-lg p-4 sm:p-6"><div class="flex items-start justify-between gap-4 mb-4"><div><p class="text-xs uppercase tracking-wider text-primary font-bold">Livestock profile</p><h2 class="text-xl font-bold mt-1">Active livestock by species</h2></div><span class="material-symbols-outlined text-primary">pets</span></div><div class="h-72"><canvas id="livestock-chart" aria-label="Active livestock by species"></canvas></div></article>
			<article class="bg-surface-container-lowest border border-surface-container rounded-lg p-4 sm:p-6"><div class="flex items-start justify-between gap-4 mb-4"><div><p class="text-xs uppercase tracking-wider text-primary font-bold">Farmer coverage</p><h2 class="text-xl font-bold mt-1">Farmers by barangay</h2></div><span class="material-symbols-outlined text-primary">location_on</span></div><div class="h-72"><canvas id="farmers-chart" aria-label="Farmers by barangay"></canvas></div></article>
		</div>
		<article class="bg-surface-container-lowest border border-surface-container rounded-lg overflow-hidden"><div class="p-4 sm:p-6 border-b border-surface-container flex flex-wrap items-center justify-between gap-3"><div><p class="text-xs uppercase tracking-wider text-primary font-bold">Latest entries</p><h2 class="text-xl font-bold mt-1">Recent price monitoring</h2></div><a href="personnel-reports.php" class="text-sm font-bold text-primary hover:underline">Open full report</a></div><div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-surface-container-low text-xs uppercase"><tr><th class="p-3">Product</th><th class="p-3">Date</th><th class="p-3">Average price</th><th class="p-3">Market</th><th class="p-3">Location</th></tr></thead><tbody><?php foreach ($analytics['latestPrices'] as $price): ?><tr class="border-t border-surface-container"><td class="p-3 font-semibold"><?= htmlspecialchars($price['product']) ?></td><td class="p-3"><?= htmlspecialchars($price['recorded_date']) ?></td><td class="p-3 font-bold text-primary">PHP <?= number_format((float) $price['average_price'], 2) ?></td><td class="p-3"><?= htmlspecialchars($price['market_name'] ?? '-') ?></td><td class="p-3"><?= htmlspecialchars($price['location'] ?? '-') ?></td></tr><?php endforeach; ?><?php if ($analytics['latestPrices'] === []): ?><tr><td colspan="5" class="p-8 text-center text-on-surface-variant">No price entries yet. Add the first market observation.</td></tr><?php endif; ?></tbody></table></div></article>
	</section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
const dashboardData = <?= json_encode($analytics, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
const palette = ['#0b6b3a', '#d6e85c', '#e4772e', '#2f7f92', '#8d5a97', '#b44d5e', '#5b7c45', '#c49a38'];
const chartDefaults = { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { beginAtZero: true, grid: { color: '#e3e9e2' } } } };
function labels(rows) { return rows.map((row) => row.label); }
function values(rows) { return rows.map((row) => Number(row.value)); }
new Chart(document.getElementById('price-trend-chart'), { type: 'line', data: { labels: labels(dashboardData.priceTrend), datasets: [{ data: values(dashboardData.priceTrend), borderColor: '#0b6b3a', backgroundColor: 'rgba(11,107,58,.14)', fill: true, tension: .35, pointRadius: 3 }] }, options: chartDefaults });
new Chart(document.getElementById('catch-trend-chart'), { type: 'bar', data: { labels: labels(dashboardData.catchTrend), datasets: [{ data: values(dashboardData.catchTrend), backgroundColor: '#2f7f92', borderRadius: 5 }] }, options: chartDefaults });
new Chart(document.getElementById('livestock-chart'), { type: 'doughnut', data: { labels: labels(dashboardData.livestockBySpecies), datasets: [{ data: values(dashboardData.livestockBySpecies), backgroundColor: palette, borderWidth: 2, borderColor: '#fff' }] }, options: { ...chartDefaults, cutout: '62%', scales: {} } });
new Chart(document.getElementById('farmers-chart'), { type: 'bar', data: { labels: labels(dashboardData.farmersByBarangay), datasets: [{ data: values(dashboardData.farmersByBarangay), backgroundColor: '#e4772e', borderRadius: 5 }] }, options: { ...chartDefaults, indexAxis: 'y' } });
</script>
<?php require_once __DIR__ . '/../frontend/components/footer.php'; ?>