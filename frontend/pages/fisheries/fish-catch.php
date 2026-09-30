<?php
require_once __DIR__ . '/../../../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../backend/security/Csrf.php';
require_once __DIR__ . '/../../../backend/core/Database.php';
require_once __DIR__ . '/../../../backend/repositories/FisheryRepository.php';
require_once __DIR__ . '/../../../backend/services/FisheryService.php';
require_once __DIR__ . '/../../../backend/controllers/FisheryController.php';

(new RoleMiddleware())->requireDepartment('fishery');
$csrf = new Csrf();
$controller = new FisheryController(new FisheryService(new FisheryRepository(new Database())), $csrf);
$catchView = (($_GET['catch_view'] ?? 'entry') === 'records') ? 'records' : 'entry';
$message = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $error = $controller->handle($_POST) ?? '';
        if ($error === '') {
            $message = 'Fish catch record saved.';
        }
    } catch (Throwable $exception) {
        error_log($exception->getMessage());
        $error = 'Unable to save the fish catch record. Check the fishery database setup.';
    }
}

$fishermen = $controller->fishermen();
$boats = $controller->boats();
$species = $controller->species();
$gears = $controller->gears();
$catches = $controller->catches();
$pageTitle = 'Fish Catches and Records - Fishery';
$pageDescription = 'Enter fish catches and review every saved catch record.';
$personnelHeaderTitle = $catchView === 'entry' ? 'Record a catch' : 'Catch records';
$personnelHeaderSubtitle = $catchView === 'entry' ? 'Capture a fisherfolk landing record' : 'Review saved fish catch records';
$assetBase = 'assets';
$activePage = 'catches';
$fisheryCatchView = $catchView;
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../components/portal-nav.php';
?>
<main class="fishery-main bg-surface-container-low">
    <section class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6"><p class="text-xs font-bold uppercase tracking-wider text-primary">Fishery monitoring</p><h1 class="mt-2 text-3xl font-extrabold"><?= $catchView === 'entry' ? 'Record a catch' : 'Catch records' ?></h1><p class="mt-2 max-w-3xl text-sm text-on-surface-variant"><?= $catchView === 'entry' ? 'Capture the catch details, landing site, and fisherman.' : 'Browse the complete list of submitted catch records.' ?></p></div>
        <?php if ($message !== ''): ?><div class="mb-5 rounded-xl border border-primary/30 bg-primary/10 p-4 text-sm font-semibold text-primary" role="status"><?= htmlspecialchars($message) ?></div><?php endif; ?>
        <?php if ($error !== ''): ?><div class="mb-5 rounded-xl border border-error/30 bg-error/10 p-4 text-sm font-semibold text-error" role="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <?php if ($catchView === 'entry'): ?>
            <section class="fishery-panel mx-auto max-w-4xl rounded-2xl border border-surface-container bg-surface-container-lowest p-4 shadow-sm sm:p-7">
                <div class="mb-6 flex flex-wrap items-start justify-between gap-3"><div><p class="text-xs font-bold uppercase tracking-wider text-primary">Catch entry</p><h2 class="mt-1 text-xl font-bold">Record a fish catch</h2><p class="mt-1 text-sm text-on-surface-variant">Enter who caught it, what was caught, and the landing details.</p></div><span class="fishery-required-note"><span aria-hidden="true">*</span> Required fields</span></div>
                <form method="post" class="fishery-catch-form">
                    <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>">
                    <input type="hidden" name="form_type" value="monitoring">
                    <input type="hidden" name="return_section" value="monitoring">
                    <fieldset class="fishery-catch-group"><legend>Fisherman and catch</legend><div class="fishery-catch-grid">
                        <label class="fishery-field"><span class="fishery-field-label">Fisherman <span class="fishery-required">Required</span></span><select name="fisherman_id" required class="form-input-custom"><option value="">Choose a fisherman</option><?php foreach ($fishermen as $person): ?><option value="<?= (int) $person['id'] ?>"><?= htmlspecialchars($person['last_name'] . ', ' . $person['first_name']) ?> (<?= htmlspecialchars(ucfirst($person['status'])) ?>)</option><?php endforeach; ?></select></label>
                        <label class="fishery-field"><span class="fishery-field-label">Fish species <span class="fishery-required">Required</span></span><select name="species_id" required class="form-input-custom"><option value="">Choose a species</option><?php foreach ($species as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['common_name']) ?></option><?php endforeach; ?></select></label>
                    </div></fieldset>
                    <fieldset class="fishery-catch-group"><legend>Trip and landing</legend><div class="fishery-catch-grid">
                        <label class="fishery-field"><span class="fishery-field-label">Catch date <span class="fishery-required">Required</span></span><input name="catch_date" type="date" required value="<?= date('Y-m-d') ?>" class="form-input-custom"></label>
                        <label class="fishery-field"><span class="fishery-field-label">Landing site</span><input name="landing_site" placeholder="Enter landing site" class="form-input-custom"></label>
                        <label class="fishery-field"><span class="fishery-field-label">Boat <span class="fishery-optional">Optional</span></span><select name="boat_id" class="form-input-custom"><option value="">No boat selected</option><?php foreach ($boats as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['name'] ?: $item['registration_number']) ?></option><?php endforeach; ?></select></label>
                        <label class="fishery-field"><span class="fishery-field-label">Fishing gear <span class="fishery-optional">Optional</span></span><select name="gear_id" class="form-input-custom"><option value="">No gear selected</option><?php foreach ($gears as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></option><?php endforeach; ?></select></label>
                    </div></fieldset>
                    <fieldset class="fishery-catch-group"><legend>Quantity and value</legend><div class="fishery-catch-grid fishery-catch-grid-3">
                        <label class="fishery-field"><span class="fishery-field-label">Quantity <span class="fishery-required">Required</span></span><input name="quantity" type="number" min="0.01" step="0.01" required placeholder="0.00" class="form-input-custom"></label>
                        <label class="fishery-field"><span class="fishery-field-label">Unit</span><input name="unit" value="kg" placeholder="kg" class="form-input-custom"></label>
                        <label class="fishery-field"><span class="fishery-field-label">Estimated value <span class="fishery-optional">Optional</span></span><input name="estimated_value" type="number" min="0" step="0.01" placeholder="0.00" class="form-input-custom"></label>
                    </div></fieldset>
                    <fieldset class="fishery-catch-group"><legend>Additional information</legend><label class="fishery-field"><span class="fishery-field-label">Notes <span class="fishery-optional">Optional</span></span><textarea name="notes" rows="3" placeholder="Add any details about this catch" class="form-input-custom"></textarea></label></fieldset>
                    <div class="fishery-catch-submit"><span>Saved catch records are available from the sidebar.</span><button class="fishery-primary-button" type="submit">Save catch record</button></div>
                </form>
            </section>
        <?php else: ?>
            <section class="fishery-panel overflow-hidden rounded-2xl border border-surface-container bg-surface-container-lowest shadow-sm">
                <div class="border-b border-surface-container p-4 sm:p-6"><h2 class="text-xl font-bold">All fish catch records</h2><p class="mt-1 text-sm text-on-surface-variant"><?= count($catches) ?> saved catch record<?= count($catches) === 1 ? '' : 's' ?></p></div>
                <div class="overflow-x-auto"><table class="fishery-catch-table w-full min-w-[1050px] text-left text-sm"><caption class="sr-only">Fish catch records, newest first</caption><thead><tr><th scope="col">Date</th><th scope="col">Fisherman</th><th scope="col">Species</th><th scope="col">Boat / gear</th><th scope="col">Landing site</th><th scope="col">Quantity</th><th scope="col">Estimated value</th><th scope="col">Notes</th></tr></thead><tbody>
                    <?php foreach ($catches as $item): ?><tr><td class="whitespace-nowrap"><?= htmlspecialchars($item['catch_date']) ?></td><td><?= htmlspecialchars($item['fisherman_name'] ?? '-') ?></td><td><?= htmlspecialchars($item['species_name'] ?? '-') ?></td><td><?= htmlspecialchars(trim(($item['boat_name'] ?? '') . ' / ' . ($item['gear_name'] ?? ''), ' /') ?: '-') ?></td><td><?= htmlspecialchars($item['landing_site'] ?: '-') ?></td><td class="whitespace-nowrap font-semibold"><?= htmlspecialchars($item['quantity'] . ' ' . $item['unit']) ?></td><td class="whitespace-nowrap"><?= $item['estimated_value'] !== null ? 'P ' . number_format((float) $item['estimated_value'], 2) : '-' ?></td><td class="max-w-xs whitespace-normal"><?= htmlspecialchars($item['notes'] ?: '-') ?></td></tr><?php endforeach; ?>
                    <?php if ($catches === []): ?><tr><td colspan="8" class="p-8 text-center text-on-surface-variant">No catch records have been entered yet.</td></tr><?php endif; ?>
                </tbody></table></div>
            </section>
        <?php endif; ?>
    </section>
</main>
<?php require_once __DIR__ . '/../../components/footer.php'; ?>
