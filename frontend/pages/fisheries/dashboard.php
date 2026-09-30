<?php
require_once __DIR__ . '/../../../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../backend/core/Database.php';

(new RoleMiddleware())->requireDepartment('fishery');
$connection = (new Database())->connection();

$fishermanCounts = ['active' => 0, 'inactive' => 0];
foreach ($connection->query('SELECT status, COUNT(*) AS total FROM fishermen GROUP BY status')->fetchAll() as $row) {
	$fishermanCounts[$row['status']] = (int) $row['total'];
}

$monthStart = new DateTimeImmutable('first day of this month');
$catchTotals = [
	'total' => (int) $connection->query('SELECT COUNT(*) FROM fish_catch')->fetchColumn(),
	'this_month' => 0,
];
$monthCatchQuery = $connection->prepare('SELECT COUNT(*) FROM fish_catch WHERE catch_date >= :month_start AND catch_date < :next_month');
$monthCatchQuery->execute([
	'month_start' => $monthStart->format('Y-m-d'),
	'next_month' => $monthStart->modify('+1 month')->format('Y-m-d'),
]);
$catchTotals['this_month'] = (int) $monthCatchQuery->fetchColumn();
$applicationTotal = (int) $connection->query('SELECT COUNT(*) FROM fishery_applications')->fetchColumn();
$boatTotal = (int) $connection->query('SELECT COUNT(*) FROM boats')->fetchColumn();
$gearTotal = (int) $connection->query("SELECT COUNT(*) FROM fishing_gears WHERE status = 'active'")->fetchColumn();

$trendStart = $monthStart->modify('-11 months');
$trendEnd = $monthStart->modify('+1 month');
$trendQuery = $connection->prepare(
	"SELECT DATE_FORMAT(catch_date, '%Y-%m') AS month_key, COUNT(*) AS records "
	. 'FROM fish_catch WHERE catch_date >= :start_date AND catch_date < :end_date '
	. 'GROUP BY DATE_FORMAT(catch_date, \'%Y-%m\') ORDER BY month_key'
);
$trendQuery->execute([
	'start_date' => $trendStart->format('Y-m-d'),
	'end_date' => $trendEnd->format('Y-m-d'),
]);
$trendCounts = [];
foreach ($trendQuery->fetchAll() as $row) {
	$trendCounts[$row['month_key']] = (int) $row['records'];
}
$monthlyCatches = [];
for ($month = $trendStart; $month < $trendEnd; $month = $month->modify('+1 month')) {
	$key = $month->format('Y-m');
	$monthlyCatches[] = ['label' => $month->format('M'), 'key' => $key, 'count' => $trendCounts[$key] ?? 0];
}
$maxMonthlyCatches = max(1, ...array_column($monthlyCatches, 'count'));
$chartLeft = 48;
$chartRight = 790;
$chartTop = 20;
$chartBottom = 218;
$chartPoints = [];
foreach ($monthlyCatches as $index => $month) {
	$x = $chartLeft + ($chartRight - $chartLeft) * ($index / max(1, count($monthlyCatches) - 1));
	$y = $chartBottom - ($chartBottom - $chartTop) * ($month['count'] / $maxMonthlyCatches);
	$chartPoints[] = ['x' => round($x, 1), 'y' => round($y, 1), 'count' => $month['count'], 'label' => $month['label']];
}

$speciesRows = $connection->query(
	'SELECT s.common_name, COUNT(c.id) AS total FROM fish_species s '
	. 'JOIN fish_catch c ON c.species_id = s.id GROUP BY s.id, s.common_name '
	. 'ORDER BY total DESC, s.common_name ASC LIMIT 6'
)->fetchAll();
$speciesMaximum = max(1, ...array_map(static fn (array $row): int => (int) $row['total'], $speciesRows ?: [['total' => 0]]));

$applicationStatuses = ['draft' => 0, 'submitted' => 0, 'reviewed' => 0];
foreach ($connection->query('SELECT status, COUNT(*) AS total FROM fishery_applications GROUP BY status')->fetchAll() as $row) {
	if (array_key_exists($row['status'], $applicationStatuses)) {
		$applicationStatuses[$row['status']] = (int) $row['total'];
	}
}
$applicationMaximum = max(1, ...array_values($applicationStatuses));

$topFishermen = $connection->query(
	"SELECT f.id, f.first_name, f.last_name, COUNT(c.id) AS total FROM fishermen f "
	. 'JOIN fish_catch c ON c.fisherman_id = f.id GROUP BY f.id, f.first_name, f.last_name '
	. 'ORDER BY total DESC, f.last_name, f.first_name LIMIT 5'
)->fetchAll();

$departmentLabel = 'Fishery';
$pageTitle = 'Fishery Dashboard - Municipal Agriculture Office Jimenez';
$pageDescription = 'Fishery registry, catch, species, and application analytics.';
$personnelHeaderTitle = 'Fishery Dashboard';
$personnelHeaderSubtitle = 'Overview of fisherman profiles, catch entries, and applications';
$assetBase = 'assets';
$activePage = 'dashboard';
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../components/portal-nav.php';
?>
<main class="fishery-main fishery-dashboard-page bg-surface-container-low">
	<section class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
		<header class="fishery-dashboard-intro">
			<div><p class="text-xs font-bold uppercase tracking-wider text-primary">Fishery monitoring</p><h1>Department analytics</h1><p>Live summaries from fisherman profiles, catch records, and saved applications.</p></div>
			<a class="fishery-dashboard-entry" href="workspace.php?page=fishery/catches&amp;catch_view=entry"><span class="material-symbols-outlined" aria-hidden="true">add_circle</span>Record a catch</a>
		</header>

		<div class="fishery-dashboard-metrics">
			<a class="fishery-analytics-metric" href="workspace.php?page=fishery/profile&amp;section=active"><span class="material-symbols-outlined" aria-hidden="true">groups</span><span>Active fisherman</span><strong><?= number_format($fishermanCounts['active']) ?></strong><small>View active profiles</small></a>
			<a class="fishery-analytics-metric" href="workspace.php?page=fishery/catches&amp;catch_view=records"><span class="material-symbols-outlined" aria-hidden="true">set_meal</span><span>Catch records this month</span><strong><?= number_format((int) ($catchTotals['this_month'] ?? 0)) ?></strong><small><?= number_format((int) ($catchTotals['total'] ?? 0)) ?> all-time records</small></a>
			<a class="fishery-analytics-metric" href="workspace.php?page=fishery/application"><span class="material-symbols-outlined" aria-hidden="true">description</span><span>Applications</span><strong><?= number_format($applicationTotal) ?></strong><small><?= number_format($applicationStatuses['reviewed']) ?> reviewed</small></a>
			<div class="fishery-analytics-metric"><span class="material-symbols-outlined" aria-hidden="true">sailing</span><span>Registered boats</span><strong><?= number_format($boatTotal) ?></strong><small><?= number_format($gearTotal) ?> active gear types</small></div>
		</div>

		<div class="fishery-analytics-grid">
			<section class="fishery-analytics-card fishery-analytics-trend" aria-labelledby="catch-trend-title">
				<div class="fishery-analytics-card-heading"><div><p>Catch activity</p><h2 id="catch-trend-title">Monthly catch records</h2></div><a href="workspace.php?page=fishery/catches&amp;catch_view=records">View records</a></div>
				<?php if ((int) ($catchTotals['total'] ?? 0) > 0): ?>
					<div class="fishery-chart-scroll"><svg class="fishery-line-chart" viewBox="0 0 820 270" role="img" aria-labelledby="catch-chart-title catch-chart-description" preserveAspectRatio="xMidYMid meet">
						<title id="catch-chart-title">Catch records by month</title><desc id="catch-chart-description">Monthly number of entered fish catch records for the last twelve months.</desc>
						<?php for ($grid = 0; $grid <= 4; $grid++): $gridY = $chartTop + ($chartBottom - $chartTop) * ($grid / 4); $gridValue = (int) round($maxMonthlyCatches * (1 - $grid / 4)); ?>
							<line x1="<?= $chartLeft ?>" y1="<?= round($gridY, 1) ?>" x2="<?= $chartRight ?>" y2="<?= round($gridY, 1) ?>" class="fishery-chart-gridline"/><text x="<?= $chartLeft - 10 ?>" y="<?= round($gridY + 4, 1) ?>" text-anchor="end" class="fishery-chart-axis-label"><?= $gridValue ?></text>
						<?php endfor; ?>
						<polyline points="<?= implode(' ', array_map(static fn (array $point): string => $point['x'] . ',' . $point['y'], $chartPoints)) ?>" class="fishery-chart-line"/>
						<?php foreach ($chartPoints as $point): ?><circle cx="<?= $point['x'] ?>" cy="<?= $point['y'] ?>" r="4" class="fishery-chart-point"><title><?= htmlspecialchars($point['label'] . ': ' . $point['count'] . ' records', ENT_QUOTES, 'UTF-8') ?></title></circle><?php endforeach; ?>
						<?php foreach ($chartPoints as $index => $point): ?><text x="<?= $point['x'] ?>" y="246" text-anchor="middle" class="fishery-chart-month"><?= htmlspecialchars($point['label'], ENT_QUOTES, 'UTF-8') ?></text><?php endforeach; ?>
					</svg></div>
				<?php else: ?><div class="fishery-chart-empty"><span class="material-symbols-outlined" aria-hidden="true">show_chart</span><p>Catch activity will appear here after the first catch is recorded.</p><a href="workspace.php?page=fishery/catches&amp;catch_view=entry">Enter the first catch</a></div><?php endif; ?>
			</section>

			<section class="fishery-analytics-card" aria-labelledby="registry-status-title">
				<div class="fishery-analytics-card-heading"><div><p>Fisherman registry</p><h2 id="registry-status-title">Profile status</h2></div><a href="workspace.php?page=fishery/profile&amp;section=active">Open profiles</a></div>
				<?php $fishermanTotal = $fishermanCounts['active'] + $fishermanCounts['inactive']; $activeShare = $fishermanTotal > 0 ? ($fishermanCounts['active'] / $fishermanTotal) * 100 : 0; ?>
				<div class="fishery-status-chart"><div class="fishery-status-donut" style="--fishery-active-share: <?= round($activeShare, 2) ?>%" role="img" aria-label="<?= $fishermanCounts['active'] ?> active and <?= $fishermanCounts['inactive'] ?> inactive fisherman"><span><?= number_format($fishermanTotal) ?><small>Total</small></span></div><div class="fishery-status-legend"><a href="workspace.php?page=fishery/profile&amp;section=active"><i class="active"></i><span>Active</span><strong><?= number_format($fishermanCounts['active']) ?></strong></a><a href="workspace.php?page=fishery/profile&amp;section=inactive"><i class="inactive"></i><span>Inactive</span><strong><?= number_format($fishermanCounts['inactive']) ?></strong></a></div></div>
			</section>

			<section class="fishery-analytics-card" aria-labelledby="species-chart-title">
				<div class="fishery-analytics-card-heading"><div><p>Catch records</p><h2 id="species-chart-title">Recorded by species</h2></div><a href="workspace.php?page=fishery/catches&amp;catch_view=records">All catches</a></div>
				<?php if ($speciesRows !== []): ?><div class="fishery-horizontal-chart"><?php foreach ($speciesRows as $row): $speciesCount = (int) $row['total']; ?><div class="fishery-bar-row"><div><span><?= htmlspecialchars($row['common_name']) ?></span><strong><?= number_format($speciesCount) ?></strong></div><div class="fishery-bar-track"><span style="width: <?= round(($speciesCount / $speciesMaximum) * 100, 2) ?>%"></span></div></div><?php endforeach; ?></div><?php else: ?><div class="fishery-chart-empty compact"><p>No species have catch entries yet.</p><a href="workspace.php?page=fishery/catches&amp;catch_view=entry">Record a catch</a></div><?php endif; ?>
			</section>

			<section class="fishery-analytics-card" aria-labelledby="application-status-title">
				<div class="fishery-analytics-card-heading"><div><p>Fisherman applications</p><h2 id="application-status-title">Application status</h2></div><a href="workspace.php?page=fishery/application">Open form</a></div>
				<div class="fishery-horizontal-chart"><?php foreach (['submitted' => 'Submitted', 'reviewed' => 'Reviewed', 'draft' => 'Draft'] as $statusKey => $statusLabel): $statusCount = $applicationStatuses[$statusKey]; ?><div class="fishery-bar-row"><div><span><?= htmlspecialchars($statusLabel) ?></span><strong><?= number_format($statusCount) ?></strong></div><div class="fishery-bar-track fishery-bar-<?= htmlspecialchars($statusKey) ?>"><span style="width: <?= $applicationMaximum > 0 ? round(($statusCount / $applicationMaximum) * 100, 2) : 0 ?>%"></span></div></div><?php endforeach; ?></div>
				<p class="fishery-analytics-footnote">Status totals use saved application records.</p>
			</section>

			<section class="fishery-analytics-card fishery-top-fishermen" aria-labelledby="top-fishermen-title">
				<div class="fishery-analytics-card-heading"><div><p>Catch activity</p><h2 id="top-fishermen-title">Fishermen with most records</h2></div><a href="workspace.php?page=fishery/profile&amp;section=active">Fisherman profiles</a></div>
				<?php if ($topFishermen !== []): ?><ol class="fishery-top-list"><?php foreach ($topFishermen as $index => $person): ?><li><span class="fishery-rank"><?= $index + 1 ?></span><span class="fishery-top-name"><?= htmlspecialchars(trim($person['last_name'] . ', ' . $person['first_name'])) ?></span><strong><?= number_format((int) $person['total']) ?><small> records</small></strong></li><?php endforeach; ?></ol><?php else: ?><div class="fishery-chart-empty compact"><p>Fisherman rankings will appear after catch records are entered.</p></div><?php endif; ?>
			</section>
		</div>
	</section>
</main>
<?php require_once __DIR__ . '/../../components/footer.php'; ?>
