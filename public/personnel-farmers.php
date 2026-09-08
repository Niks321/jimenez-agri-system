<?php
require_once __DIR__ . '/../backend/middleware/RoleMiddleware.php';
require_once __DIR__ . '/../backend/security/Csrf.php';
require_once __DIR__ . '/../backend/services/PersonnelDataService.php';
$roleMiddleware = new RoleMiddleware();
$roleMiddleware->requireRole('staff');
$csrf = new Csrf();
$service = new PersonnelDataService(new Database());
$message = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$csrf->valid($_POST['_csrf_token'] ?? null)) {
        $error = 'Your form session expired. Refresh and try again.';
    } elseif (trim((string) ($_POST['first_name'] ?? '')) === '' || trim((string) ($_POST['last_name'] ?? '')) === '') {
        $error = 'First name and last name are required.';
    } else {
        try { $service->addFarmer($_POST); $message = 'Farmer record saved.'; } catch (Throwable $exception) { error_log($exception->getMessage()); $error = 'Unable to save the farmer record.'; }
    }
}
$farmers = $service->farmers();
$pageTitle = 'Farmers - Personnel'; $pageDescription = 'Personnel farmer monitoring.'; $assetBase = 'assets'; $activePage = 'farmers';
require_once __DIR__ . '/../frontend/components/header.php';
require_once __DIR__ . '/../frontend/components/personnel-nav.php';
?>
<main class="min-h-screen bg-surface-container-low"><section class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-xl"><div class="flex items-end justify-between gap-4 mb-space-lg"><div><p class="text-xs uppercase tracking-wider text-primary font-bold">Data entry and monitoring</p><h1 class="text-3xl font-extrabold mt-2">Farmers</h1><p class="text-sm text-on-surface-variant mt-2">Maintain the farmer registry used by agriculture services.</p></div></div>
<?php if ($message !== ''): ?><div class="mb-4 rounded-lg border border-primary bg-primary/10 px-4 py-3 text-sm text-primary"><?= htmlspecialchars($message) ?></div><?php endif; ?><?php if ($error !== ''): ?><div class="mb-4 rounded-lg border border-error bg-error/10 px-4 py-3 text-sm text-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.4fr)] gap-space-lg"><form method="post" class="bg-surface-container-lowest border border-surface-container rounded-lg p-space-lg space-y-4"><input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>"><h2 class="text-xl font-bold">Add farmer</h2><div class="grid grid-cols-2 gap-3"><input name="first_name" required placeholder="First name" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><input name="last_name" required placeholder="Last name" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"></div><div class="grid grid-cols-2 gap-3"><input name="middle_name" placeholder="Middle name" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><input name="registration_number" placeholder="Registration no." class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"></div><div class="grid grid-cols-2 gap-3"><select name="sex" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"><option value="">Sex</option><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></select><input name="birth_date" type="date" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant"></div><input name="barangay" placeholder="Barangay" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant"><input name="phone" placeholder="Phone number" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant"><textarea name="address" placeholder="Address" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant"></textarea><button class="rounded-lg bg-primary text-on-primary px-4 py-3 font-bold text-sm" type="submit">Save farmer</button></form><div class="bg-surface-container-lowest border border-surface-container rounded-lg overflow-hidden"><div class="p-space-lg border-b border-surface-container"><h2 class="text-xl font-bold">Registered farmers</h2></div><div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-surface-container-low text-xs uppercase"><tr><th class="p-3">Name</th><th class="p-3">Registration</th><th class="p-3">Barangay</th></tr></thead><tbody><?php foreach ($farmers as $farmer): ?><tr class="border-t border-surface-container"><td class="p-3 font-semibold"><?= htmlspecialchars(trim($farmer['first_name'] . ' ' . ($farmer['middle_name'] ?? '') . ' ' . $farmer['last_name'])) ?></td><td class="p-3"><?= htmlspecialchars($farmer['registration_number'] ?? '-') ?></td><td class="p-3"><?= htmlspecialchars($farmer['barangay'] ?? '-') ?></td></tr><?php endforeach; ?></tbody></table></div></div></div></section></main><?php require_once __DIR__ . '/../frontend/components/footer.php'; ?>
