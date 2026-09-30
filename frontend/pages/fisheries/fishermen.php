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
$section = (($_GET['section'] ?? 'active') === 'inactive') ? 'inactive' : 'active';
$search = trim((string) ($_GET['search'] ?? ''));
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $error = $controller->handle($_POST) ?? '';
        if ($error === '' && ($_POST['form_type'] ?? '') === 'delete_fisherman') {
            $message = 'Fisherman record and related fishery records were deleted.';
        }
    } catch (Throwable $exception) {
        error_log($exception->getMessage());
        $error = 'Unable to remove the fisherman record.';
    }
}

$fishermen = $controller->registry($section, $search);
$pageTitle = 'Fisherman Profile - Fishery';
$pageDescription = 'Active and inactive fisherman profiles and their saved fishery records.';
$personnelHeaderTitle = 'Fisherman Profile';
$personnelHeaderSubtitle = 'Review fisherman details and insurance information';
$assetBase = 'assets';
$activePage = 'profile';
$fisherySection = $section;
$fisheryProfileScriptPath = __DIR__ . '/../../../public/assets/js/fisheries/fisherman-profile.js';
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../components/portal-nav.php';
?>
<main class="fishery-main bg-surface-container-low">
    <section class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6">
            <p class="text-xs font-bold uppercase tracking-wider text-primary">Fisherman registry</p>
            <h1 class="mt-2 text-3xl font-extrabold">Fisherman Profile</h1>
            <p class="mt-2 max-w-3xl text-sm text-on-surface-variant">Browse the fisherman roster and open each profile to review its registration, personal, boat, and insurance details.</p>
        </div>

        <?php if ($message !== ''): ?><div class="mb-5 rounded-xl border border-primary/30 bg-primary/10 p-4 text-sm font-semibold text-primary" role="status"><?= htmlspecialchars($message) ?></div><?php endif; ?>
        <?php if ($error !== ''): ?><div class="mb-5 rounded-xl border border-error/30 bg-error/10 p-4 text-sm font-semibold text-error" role="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <section class="fishery-panel overflow-hidden rounded-2xl border border-surface-container bg-surface-container-lowest shadow-sm">
            <div class="flex flex-col gap-4 border-b border-surface-container p-4 sm:p-6 lg:flex-row lg:items-end lg:justify-between">
                <div><h2 class="text-xl font-bold"><?= ucfirst($section) ?> fisherman</h2><p class="mt-1 text-sm text-on-surface-variant"><?= count($fishermen) ?> matching profile<?= count($fishermen) === 1 ? '' : 's' ?></p></div>
                <form method="get" class="fishery-search">
                    <input type="hidden" name="page" value="fishery/profile"><input type="hidden" name="section" value="<?= htmlspecialchars($section) ?>">
                    <label class="sr-only" for="fisherman-search">Search fishermen</label>
                    <input id="fisherman-search" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Name, RSBSA, registration, or barangay">
                    <button type="submit">Search</button>
                    <?php if ($search !== ''): ?><a href="workspace.php?page=fishery/profile&amp;section=<?= htmlspecialchars($section) ?>">Clear</a><?php endif; ?>
                </form>
            </div>

            <?php if ($fishermen !== []): ?>
                <div class="overflow-x-auto">
                    <table class="fishery-profile-table w-full min-w-[880px] text-left text-sm">
                        <caption class="sr-only"><?= ucfirst($section) ?> fisherman summary. Select View details to open the complete record.</caption>
                        <thead><tr><th scope="col">Fisherman</th><th scope="col">Status</th><th scope="col">Barangay</th><th scope="col">Contact</th><th scope="col">RSBSA / registration</th><th scope="col">Boat registration</th><th scope="col"><span class="sr-only">Actions</span></th></tr></thead>
                        <tbody>
                        <?php foreach ($fishermen as $person): ?>
                            <?php $detailId = 'fisherman-details-' . (int) $person['id']; ?>
                            <tr>
                                <td><button type="button" class="fishery-profile-name" aria-haspopup="dialog" aria-controls="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>" data-fisherman-details-open="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(trim($person['last_name'] . ', ' . $person['first_name'] . ' ' . ($person['middle_name'] ?? ''))) ?></button></td>
                                <td><span class="fishery-status fishery-status-<?= htmlspecialchars($person['status']) ?>"><?= htmlspecialchars(ucfirst($person['status'])) ?></span></td>
                                <td><?= htmlspecialchars($person['barangay'] ?: '-') ?></td>
                                <td><?= htmlspecialchars($person['contact_number'] ?: '-') ?></td>
                                <td><?= htmlspecialchars(($person['rsbsa_number'] ?: '-') . ' / ' . ($person['fisher_registration_number'] ?: '-')) ?></td>
                                <td><?= htmlspecialchars($person['boat_registration_number'] ?: '-') ?></td>
                                <td><button type="button" class="fishery-secondary-button" aria-haspopup="dialog" aria-controls="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>" data-fisherman-details-open="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>">View details</button></td>
                            </tr>


                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php foreach ($fishermen as $person): ?>
                    <?php $detailId = 'fisherman-details-' . (int) $person['id']; ?>
                            <dialog id="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>" class="fishery-details-dialog" aria-labelledby="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>-title">
                                <div class="fishery-details-dialog-header"><div><p class="text-xs font-bold uppercase tracking-wide text-primary">Complete fisherman record</p><h2 id="<?= htmlspecialchars($detailId, ENT_QUOTES, 'UTF-8') ?>-title"><?= htmlspecialchars(trim($person['last_name'] . ', ' . $person['first_name'] . ' ' . ($person['middle_name'] ?? ''))) ?></h2></div><button type="button" class="fishery-dialog-close" data-fisherman-details-close aria-label="Close details">&times;</button></div>
                                <div class="fishery-details-table-wrap"><table class="fishery-details-table"><caption class="sr-only">Complete details for <?= htmlspecialchars(trim($person['last_name'] . ', ' . $person['first_name'])) ?></caption><thead><tr><th scope="col">Record field</th><th scope="col">Saved details</th></tr></thead><tbody>
                                    <?php foreach ([
                                        'Status' => ucfirst((string) $person['status']), 'RSBSA number' => $person['rsbsa_number'], 'Fisher registration' => $person['fisher_registration_number'],
                                        'Association' => $person['fishermen_association'], 'Address' => $person['address'], 'Barangay' => $person['barangay'], 'Spouse' => $person['spouse_name'],
                                        'Contact' => $person['contact_number'], 'Sex' => $person['sex'], 'Civil status' => $person['civil_status'],
                                        'Beneficiary' => trim(($person['beneficiary_name'] ?? '') . (($person['beneficiary_relation'] ?? '') !== '' ? ' (' . $person['beneficiary_relation'] . ')' : '')),
                                        'Boat type / material' => trim(($person['boat_type'] ?? '') . ' / ' . ($person['boat_material'] ?? '')), 'Boat usage' => $person['usage_description'], 'Other boat details' => $person['other_description'],
                                        'Motor / chassis' => trim(($person['motor_number'] ?? '') . ' / ' . ($person['chassis_number'] ?? '')),
                                        'Boat dimensions (L x B x B x D)' => trim(($person['length_meters'] ?? '') . ' x ' . ($person['breadth_meters'] ?? '') . ' x ' . ($person['breadth_meters_2'] ?? '') . ' x ' . ($person['depth_meters'] ?? '')),
                                        'Gross tonnage' => $person['gross_tonnage'], 'Boat age values / color' => trim(($person['boat_age_years'] ?? '') . ' / ' . ($person['boat_age_years_2'] ?? '') . ' / ' . ($person['boat_color'] ?? '')),
                                        'Boat registration' => $person['boat_registration_number'], 'Official receipt' => trim(($person['or_number'] ?? '') . ' / ' . ($person['or_date'] ?? '')),
                                        'Property location' => $person['location_of_property'], 'Sum insured' => $person['desired_sum_insured'] !== null ? 'P ' . number_format((float) $person['desired_sum_insured'], 2) : '',
                                        'Coverage period' => trim(($person['cover_from'] ?? '') . ' to ' . ($person['cover_to'] ?? '')),
                                        'Purchase / branch / address' => trim(($person['mortgage_to'] ?? '') . ' / ' . ($person['mortgage_branch'] ?? '') . ' / ' . ($person['mortgage_address'] ?? '')),
                                        'Reviewed by' => $person['reviewed_by'], 'Review date' => $person['review_date'], 'Application date' => $person['application_date'],
                                    ] as $label => $value): ?>
                                        <tr><th scope="row"><?= htmlspecialchars($label) ?></th><td><?= htmlspecialchars(trim((string) $value) !== '' ? (string) $value : '-') ?></td></tr>
                                    <?php endforeach; ?>
                                </tbody></table></div>
                                <div class="fishery-details-dialog-actions"><a class="fishery-secondary-button" href="workspace.php?page=fishery/application&amp;fisherman_id=<?= (int) $person['id'] ?>">Open application</a><form method="post" onsubmit="return confirm('Permanently delete this fisherman and the related fishery records?');"><input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>"><input type="hidden" name="form_type" value="delete_fisherman"><input type="hidden" name="return_section" value="<?= htmlspecialchars($section) ?>"><input type="hidden" name="fisherman_id" value="<?= (int) $person['id'] ?>"><button class="fishery-danger-button" type="submit">Delete profile</button></form></div>
                            </dialog>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="fishery-empty-state"><span class="material-symbols-outlined" aria-hidden="true">person_search</span><p class="font-bold">No <?= htmlspecialchars($section) ?> fisherman found</p><p class="mt-1 text-sm text-on-surface-variant"><?= $search !== '' ? 'Try another name or reference number.' : 'Applications saved in the application form will appear in this registry.' ?></p><?php if ($search !== ''): ?><a class="fishery-secondary-button mt-4" href="workspace.php?page=fishery/profile&amp;section=<?= htmlspecialchars($section) ?>">Clear search</a><?php endif; ?></div>
            <?php endif; ?>
        </section>
    </section>
</main>
<script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/js/fisheries/fisherman-profile.js?v=<?= is_file($fisheryProfileScriptPath) ? (int) filemtime($fisheryProfileScriptPath) : 1 ?>"></script>
<?php require_once __DIR__ . '/../../components/footer.php'; ?>
