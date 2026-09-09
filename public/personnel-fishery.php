<?php
require_once __DIR__ . '/../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../backend/security/Csrf.php';
require_once __DIR__ . '/../backend/core/Database.php';
require_once __DIR__ . '/../backend/repositories/FisheryRepository.php';
require_once __DIR__ . '/../backend/services/FisheryService.php';
require_once __DIR__ . '/../backend/controllers/FisheryController.php';

$roleMiddleware = new RoleMiddleware();
$roleMiddleware->requireRole('staff');
$csrf = new Csrf();
$fisheryController = new FisheryController(new FisheryService(new FisheryRepository(new Database())), $csrf);
$message = '';
$error = '';
$section = FisheryController::validSection($_GET['section'] ?? 'active');
$search = trim((string) ($_GET['search'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = $_POST['form_type'] ?? 'application';
    $section = FisheryController::validSection($_POST['return_section'] ?? $formType);
    try {
        $error = $fisheryController->handle($_POST);
        if ($error === null) {
            $message = match ($formType) {
                'monitoring' => 'Fishery monitoring record saved.',
                'delete_fisherman' => 'Fisherfolk record and related Fishery data deleted.',
                default => 'Fishery application saved. It is ready to print.',
            };
        }
    } catch (Throwable $exception) {
        error_log($exception->getMessage());
        $error = 'Unable to save the fishery record. Check that the database migration is imported.';
    }
}

$allFishermen = $fisheryController->fishermen();
$fishermen = in_array($section, ['active', 'inactive'], true) ? $fisheryController->registry($section, $search) : [];
$boats = $fisheryController->boats();
$species = $fisheryController->species();
$gears = $fisheryController->gears();
$catches = $fisheryController->recentCatches();
$sectionMeta = FisheryController::sectionMeta();
$currentSection = $sectionMeta[$section];
$pageTitle = $currentSection['title'] . ' - Personnel';
$pageDescription = $currentSection['description'];
$personnelHeaderTitle = $currentSection['title'];
$personnelHeaderSubtitle = $currentSection['subtitle'];
$assetBase = 'assets';
$activePage = 'fisheries';
require_once __DIR__ . '/../frontend/components/header.php';
require_once __DIR__ . '/../frontend/components/personnel-nav.php';
?>
<style>
.fishery-subnav a[aria-current="page"] { background: #d8e9d4; color: #16452b; }
.fishery-application {
    max-width: 210mm;
    min-height: 297mm;
    margin: 0 auto;
    background: #fff;
    color: #111;
    font-family: Georgia, 'Times New Roman', serif;
}
.fishery-application form { font-size: 12px; }
.fishery-application fieldset { border: 0; margin: 0; padding: 0; }
.fishery-application legend { font-size: 12px; text-transform: uppercase; letter-spacing: .03em; }
.fishery-application input,
.fishery-application select,
.fishery-application textarea {
    min-height: 34px;
    background: #fff;
    color: #111;
    border: 0;
    border-bottom: 1px solid #222;
    border-radius: 0;
    box-shadow: none;
}
.fishery-application textarea { min-height: 48px; resize: vertical; }
.fishery-application input::placeholder,
.fishery-application textarea::placeholder { color: #333; opacity: 1; }
.fishery-application select { appearance: auto; }
.fishery-application select {
    color: transparent;
    text-shadow: 0 0 0 #111;
}
.fishery-application select option { color: #111; }
.fishery-application select[name="sex"],
.fishery-application select[name="civil_status"] {
    border: 0;
    min-height: 25px;
    padding-left: 0;
    font-family: inherit;
}
.fishery-application select[name="sex"]::before,
.fishery-application select[name="civil_status"]::before { content: '[ ] '; }
.fishery-application .application-checks { display: flex; flex-wrap: wrap; gap: 14px; align-items: center; }
.fishery-application .application-checks span::before { content: '[ ] '; font-weight: 400; }
.fishery-application .form-line { display: grid; grid-template-columns: max-content minmax(0, 1fr); align-items: end; gap: 8px; min-height: 27px; }
.fishery-application .form-line > label { font-size: 11px; white-space: nowrap; }
.fishery-application .form-line > input,
.fishery-application .form-line > select { width: 100%; }
.fishery-application .paper-heading { text-align: center; line-height: 1.15; }
.fishery-application .paper-heading .agency { font-size: 14px; font-weight: 700; }
.fishery-application .paper-heading .program { font-size: 13px; font-weight: 700; }
.fishery-application .paper-heading .form-title { margin-top: 12px; font-size: 14px; font-weight: 700; }
.fishery-application .paper-rule { border-bottom: 1px solid #111; padding-bottom: 5px; }
.fishery-application .paper-label { font-size: 11px; font-weight: 700; text-transform: uppercase; }
.fishery-application .paper-options { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; min-height: 27px; }
.fishery-application .paper-option::before { content: '[ ]'; margin-right: 4px; }
.fishery-application .paper-signature { min-height: 45px; border-bottom: 1px solid #111; text-align: center; padding-top: 30px; font-size: 10px; }
@media print {
    @page { size: A4 portrait; margin: 12mm 14mm; }
    html, body { margin: 0 !important; background: #fff !important; }
    body:has(.fishery-application) header,
    body:has(.fishery-application) aside,
    body:has(.fishery-application) #personnel-sidebar-overlay,
    body:has(.fishery-application) .fishery-subnav,
    body:has(.fishery-application) .screen-only,
    body:has(.fishery-application) footer { display: none !important; }
    body:has(.fishery-application) main { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: none !important; }
    body:has(.fishery-application) main > section { padding: 0 !important; max-width: none !important; }
    .fishery-application { width: 182mm; max-width: none; min-height: 273mm; margin: 0 auto; border: 0 !important; box-shadow: none !important; padding: 0 !important; }
    .fishery-application form { font-size: 10px; }
    .fishery-application input,
    .fishery-application select,
    .fishery-application textarea { min-height: 22px; padding: 2px 3px !important; border-color: #222 !important; color: #000 !important; }
    .fishery-application input::placeholder,
    .fishery-application textarea::placeholder { color: #111 !important; opacity: 1 !important; }
    .fishery-application fieldset { break-inside: avoid; }
    .fishery-application .grid { gap: 5px !important; }
    .fishery-application select {
        color: #111 !important;
        text-shadow: none !important;
        border-bottom: 1px solid #111 !important;
    }
    .fishery-application select[name="sex"],
    .fishery-application select[name="civil_status"] { border: 0 !important; }
}
</style>
<main class="min-h-screen bg-surface-container-low"><section class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-xl">
    <div class="screen-only mb-6"><p class="text-xs uppercase tracking-wider text-primary font-bold"><?= htmlspecialchars($currentSection['subtitle']) ?></p><h1 class="text-3xl font-extrabold mt-2"><?= htmlspecialchars($currentSection['title']) ?></h1><p class="text-sm text-on-surface-variant mt-2"><?= htmlspecialchars($currentSection['description']) ?></p></div>
    <?php if ($message !== ''): ?><div class="screen-only mb-4 rounded-lg border border-primary bg-primary/10 px-4 py-3 text-sm text-primary"><?= htmlspecialchars($message) ?></div><?php endif; ?>
    <?php if ($error !== ''): ?><div class="screen-only mb-4 rounded-lg border border-error bg-error/10 px-4 py-3 text-sm text-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if (in_array($section, ['active', 'inactive'], true)): ?>
        <div class="bg-surface-container-lowest border border-surface-container rounded-lg overflow-hidden"><div class="p-space-lg border-b border-surface-container"><div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between"><div><h2 class="text-xl font-bold"><?= htmlspecialchars($currentSection['title']) ?></h2><p class="text-sm text-on-surface-variant mt-1"><?= htmlspecialchars($currentSection['description']) ?></p></div><form method="get" class="flex flex-wrap items-center gap-2"><input type="hidden" name="section" value="<?= htmlspecialchars($section) ?>"><label for="fishery-search" class="sr-only">Search fisherfolk</label><input id="fishery-search" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search RSBSA, registration, name, barangay" class="form-input-custom w-full sm:w-80 rounded-lg p-3 text-sm border border-outline-variant"><button type="submit" class="rounded-lg bg-primary text-on-primary px-4 py-3 text-sm font-bold">Search</button><?php if ($search !== ''): ?><a href="personnel-fishery.php?section=<?= htmlspecialchars($section) ?>" class="rounded-lg border border-outline-variant px-4 py-3 text-sm font-bold">Reset</a><?php endif; ?></form></div></div><div class="overflow-x-auto"><table class="w-full min-w-[2800px] text-sm"><thead class="bg-surface-container-low text-left"><tr><th class="p-4">RSBSA Number</th><th class="p-4">Fisher Registration No.</th><th class="p-4">Last Name</th><th class="p-4">First Name</th><th class="p-4">Barangay</th><th class="p-4">Address</th><th class="p-4">Association</th><th class="p-4">Spouse</th><th class="p-4">Contact No.</th><th class="p-4">Sex</th><th class="p-4">Civil Status</th><th class="p-4">Beneficiary</th><th class="p-4">Boat Type / Material</th><th class="p-4">Usage</th><th class="p-4">Boat Registration No.</th><th class="p-4">Motor / Chassis No.</th><th class="p-4">Dimensions</th><th class="p-4">OR No. / Date</th><th class="p-4">Property Location</th><th class="p-4">Sum Insured</th><th class="p-4">Coverage Period</th><th class="p-4">Mortgage</th><th class="p-4">Status</th></tr></thead><tbody><?php foreach ($fishermen as $fisherman): ?><tr class="border-t border-surface-container align-top"><td class="p-4"><?= htmlspecialchars($fisherman['rsbsa_number'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['fisher_registration_number'] ?: '-') ?></td><td class="p-4 font-semibold"><?= htmlspecialchars($fisherman['last_name']) ?></td><td class="p-4"><?= htmlspecialchars($fisherman['first_name']) ?></td><td class="p-4"><?= htmlspecialchars($fisherman['barangay'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['address'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['fishermen_association'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['spouse_name'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['contact_number'] ?: '-') ?></td><td class="p-4 capitalize"><?= htmlspecialchars($fisherman['sex'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['civil_status'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['beneficiary_name'] ? $fisherman['beneficiary_name'] . ($fisherman['beneficiary_relation'] ? ' (' . $fisherman['beneficiary_relation'] . ')' : '') : '-') ?></td><td class="p-4"><?= htmlspecialchars(($fisherman['boat_type'] ?: '-') . ' / ' . ($fisherman['boat_material'] ?: '-')) ?></td><td class="p-4"><?= htmlspecialchars($fisherman['usage_description'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['boat_registration_number'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars(($fisherman['motor_number'] ?: '-') . ' / ' . ($fisherman['chassis_number'] ?: '-')) ?></td><td class="p-4"><?= htmlspecialchars(($fisherman['length_meters'] ?: '-') . ' x ' . ($fisherman['breadth_meters'] ?: '-') . ' x ' . ($fisherman['depth_meters'] ?: '-')) ?></td><td class="p-4"><?= htmlspecialchars(($fisherman['or_number'] ?: '-') . ' / ' . ($fisherman['or_date'] ?: '-')) ?></td><td class="p-4"><?= htmlspecialchars($fisherman['location_of_property'] ?: '-') ?></td><td class="p-4"><?= htmlspecialchars($fisherman['desired_sum_insured'] !== null ? 'P ' . number_format((float) $fisherman['desired_sum_insured'], 2) : '-') ?></td><td class="p-4"><?= htmlspecialchars(($fisherman['cover_from'] ?: '-') . ' to ' . ($fisherman['cover_to'] ?: '-')) ?></td><td class="p-4"><?= htmlspecialchars(($fisherman['mortgage_to'] ?: '-') . ' / ' . ($fisherman['mortgage_branch'] ?: '-')) ?></td><td class="p-4 capitalize"><?= htmlspecialchars($fisherman['status']) ?></td></tr><?php endforeach; ?><?php if ($fishermen === []): ?><tr><td colspan="23" class="p-8 text-center text-on-surface-variant">No <?= $section ?> fisherfolk records match your search.</td></tr><?php endif; ?></tbody></table></div></div>
        <div class="screen-only border-t border-surface-container p-space-lg"><form method="post" class="flex flex-wrap items-end gap-3" onsubmit="return confirm('Delete this fisherfolk record and its related application, boat, and catch data?');"><input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>"><input type="hidden" name="form_type" value="delete_fisherman"><input type="hidden" name="return_section" value="<?= htmlspecialchars($section) ?>"><div><label for="delete-fisherman" class="block text-xs font-bold mb-1">Temporary delete</label><select id="delete-fisherman" name="fisherman_id" required class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><option value="">Select fisherfolk record</option><?php foreach ($fishermen as $fisherman): ?><option value="<?= (int) $fisherman['id'] ?>"><?= htmlspecialchars($fisherman['last_name'] . ', ' . $fisherman['first_name'] . ' (' . $fisherman['status'] . ')') ?></option><?php endforeach; ?></select></div><button type="submit" class="rounded-lg bg-error text-white px-4 py-3 text-sm font-bold">Delete selected record</button></form></div>
    <?php elseif ($section === 'application'): ?>
        <div class="fishery-application bg-surface-container-lowest border border-surface-container rounded-lg p-5 sm:p-8"><div class="paper-heading border-b border-black pb-4 mb-5"><p class="agency">PHILIPPINE CROP INSURANCE CORPORATION</p><p class="program">NON-CROP AGRICULTURAL ASSET INSURANCE PROGRAM</p><p class="form-title">FISHING BOAT INSURANCE APPLICATION FORM</p><p class="text-xs mt-2">Municipal Agriculture Office - Jimenez</p></div>
        <form method="post" class="space-y-6"><input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>"><fieldset><legend class="font-bold border-b border-outline-variant pb-2 mb-3">Applicant Information</legend><div class="grid grid-cols-1 md:grid-cols-3 gap-3"><input name="applicant_last_name" required placeholder="Last name *" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="applicant_first_name" required placeholder="First name *" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="applicant_middle_name" placeholder="Middle name" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div><div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3"><input name="fishermen_association" placeholder="Name of fishermen association" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="address" placeholder="Address" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="spouse_name" placeholder="Name of spouse" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="contact_number" placeholder="Contact no." class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="rsbsa_number" placeholder="RSBSA number" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="barangay" placeholder="Barangay" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div><div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3"><select name="sex" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><option value="">Sex</option><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></select><select name="civil_status" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><option value="">Civil status</option><option>Single</option><option>Married</option><option>Widow/er</option><option>Separated</option></select><input name="beneficiary_name" placeholder="Beneficiary" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="beneficiary_relation" placeholder="Beneficiary relation" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div></fieldset>
        <fieldset><legend class="font-bold border-b border-outline-variant pb-2 mb-3">Description of Property to Be Insured</legend><div class="grid grid-cols-1 md:grid-cols-2 gap-3"><input name="boat_type" placeholder="Type of boat" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="boat_material" placeholder="Type of material / make" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="motor_number" placeholder="Motor no." class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="chassis_number" placeholder="Chassis no." class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="usage_description" placeholder="Usage" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="registration_number" placeholder="Registration number" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div><div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3"><input name="length_meters" type="number" step="0.01" placeholder="Length" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="breadth_meters" type="number" step="0.01" placeholder="Breadth" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="depth_meters" type="number" step="0.01" placeholder="Depth" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="gross_tonnage" type="number" step="0.01" placeholder="Gross tonnage" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="boat_age_years" type="number" step="0.01" placeholder="Age" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="boat_color" placeholder="Color" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="or_number" placeholder="OR #" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="or_date" type="date" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div></fieldset>
        <fieldset><legend class="font-bold border-b border-outline-variant pb-2 mb-3">Coverage and Mortgage</legend><div class="grid grid-cols-1 md:grid-cols-2 gap-3"><input name="location_of_property" placeholder="Location of property afloat" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="desired_sum_insured" type="number" step="0.01" placeholder="Desired sum insured (P)" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="cover_from" type="date" aria-label="Cover from" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="cover_to" type="date" aria-label="Cover to" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="mortgage_to" placeholder="Mortgage to" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="mortgage_branch" placeholder="Branch" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="mortgage_address" placeholder="Mortgage address" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="application_date" type="date" value="<?= date('Y-m-d') ?>" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div></fieldset><p class="text-sm">If available, attach a copy of delivery receipt and/or official receipt of purchase fishing boat, or a copy of bank's appraisal report.</p><div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6"><div class="border-t border-black pt-2 text-center text-sm">Signature over printed name of applicant</div><div class="border-t border-black pt-2 text-center text-sm">Reviewed by: Account Officer</div></div><div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-w-xl pt-2"><input name="reviewed_by" placeholder="Account officer name" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"><input name="review_date" type="date" aria-label="Review date" class="form-input-custom border border-outline-variant rounded-lg p-3 text-sm"></div><div class="screen-only flex flex-wrap gap-3"><button type="submit" class="rounded-lg bg-primary text-on-primary px-5 py-3 font-bold text-sm">Save application</button><button type="button" onclick="window.print()" class="rounded-lg border border-primary text-primary px-5 py-3 font-bold text-sm">Print application</button></div></form></div>
    <?php else: ?><div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.4fr)] gap-space-lg"><form method="post" class="bg-surface-container-lowest border border-surface-container rounded-lg p-space-lg space-y-4"><input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>"><input type="hidden" name="form_type" value="monitoring"><h2 class="text-xl font-bold">Record fish catch</h2><div class="grid grid-cols-2 gap-3"><select name="fisherman_id" required class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><option value="">Fisherman</option><?php foreach ($allFishermen as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['last_name'] . ', ' . $item['first_name']) ?></option><?php endforeach; ?></select><select name="species_id" required class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><option value="">Species</option><?php foreach ($species as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['common_name']) ?></option><?php endforeach; ?></select></div><div class="grid grid-cols-2 gap-3"><select name="boat_id" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><option value="">Boat (optional)</option><?php foreach ($boats as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['name'] ?: $item['registration_number']) ?></option><?php endforeach; ?></select><select name="gear_id" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><option value="">Gear (optional)</option><?php foreach ($gears as $item): ?><option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></option><?php endforeach; ?></select></div><div class="grid grid-cols-2 gap-3"><input name="catch_date" type="date" required value="<?= date('Y-m-d') ?>" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><input name="landing_site" placeholder="Landing site" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"></div><div class="grid grid-cols-3 gap-3"><input name="quantity" type="number" min="0.01" step="0.01" required placeholder="Quantity" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><input name="unit" value="kg" placeholder="Unit" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><input name="estimated_value" type="number" min="0" step="0.01" placeholder="Value" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"></div><textarea name="notes" placeholder="Notes" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant"></textarea><button class="rounded-lg bg-primary text-on-primary px-4 py-3 font-bold text-sm" type="submit">Save catch record</button></form><div class="bg-surface-container-lowest border border-surface-container rounded-lg overflow-hidden"><div class="p-space-lg border-b border-surface-container"><h2 class="text-xl font-bold">Recent catch records</h2></div><div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-surface-container-low text-xs uppercase"><tr><th class="p-3">Date</th><th class="p-3">Fisherman ID</th><th class="p-3">Species ID</th><th class="p-3">Quantity</th></tr></thead><tbody><?php foreach ($catches as $item): ?><tr class="border-t border-surface-container"><td class="p-3"><?= htmlspecialchars($item['catch_date']) ?></td><td class="p-3"><?= (int) $item['fisherman_id'] ?></td><td class="p-3"><?= (int) $item['species_id'] ?></td><td class="p-3 font-semibold"><?= htmlspecialchars($item['quantity'] . ' ' . $item['unit']) ?></td></tr><?php endforeach; ?></tbody></table></div></div></div><?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.fishery-application form');
    if (!form) return;

    const makeOptions = (fieldName, options, multiple = false) => {
        const field = form.querySelector(`[name="${fieldName}"]`);
        if (!field) return;
        const wrapper = document.createElement('div');
        wrapper.className = 'paper-options';
        const label = document.createElement('span');
        label.className = 'paper-label';
        label.textContent = fieldName === 'sex' ? '*SEX:' : fieldName === 'civil_status' ? 'CIVIL STATUS:' : fieldName === 'boat_type' ? '*TYPE OF BOAT:' : '*TYPE OF MATERIAL/MAKE:';
        wrapper.appendChild(label);
        options.forEach(([value, text]) => {
            const option = document.createElement('label');
            option.className = 'paper-option';
            const input = document.createElement('input');
            input.type = multiple ? 'checkbox' : 'radio';
            input.name = `${fieldName}_choice`;
            input.value = value;
            input.addEventListener('change', () => { field.value = multiple ? [...wrapper.querySelectorAll('input:checked')].map(item => item.value).join(', ') : value; });
            option.append(input, ` ${text}`);
            wrapper.appendChild(option);
        });
        field.style.display = 'none';
        field.parentNode.insertBefore(wrapper, field);
    };

    makeOptions('sex', [['male', 'MALE'], ['female', 'FEMALE']]);
    makeOptions('civil_status', [['single', 'SINGLE'], ['married', 'MARRIED'], ['widow(er)', 'WIDOW/ER'], ['separated', 'SEPARATED']]);
    makeOptions('boat_type', [['motorized', 'MOTORIZED'], ['non-motorized', 'NON-MOTORIZED']]);
    makeOptions('boat_material', [['wooden hull', 'WOODEN HULL'], ['fiberglass hull', 'FIBERGLASS HULL']]);
});
</script>
</section></main>
<?php require_once __DIR__ . '/../frontend/components/footer.php'; ?>
