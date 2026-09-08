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
    } elseif (trim((string) ($_POST['insured_name'] ?? '')) === '') {
        $error = 'Insured name is required.';
    } else {
        try {
            $service->addInsurance($_POST);
            $message = 'Insurance record saved.';
        } catch (Throwable $exception) {
            error_log($exception->getMessage());
            $error = 'Unable to save the insurance record.';
        }
    }
}

$insurances = $service->insurances();
$farmers = $service->farmers();
$fishermen = $service->fishermen();

$pageTitle = 'Insurance - Personnel';
$pageDescription = 'Personnel insurance monitoring and policy tracking.';
$assetBase = 'assets';
$activePage = 'insurance';

require_once __DIR__ . '/../frontend/components/header.php';
require_once __DIR__ . '/../frontend/components/personnel-nav.php';
?>
<main class="min-h-screen bg-surface-container-low">
    <section class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop py-space-xl">
        <p class="text-xs uppercase tracking-wider text-primary font-bold">Coverage and protection</p>
        <h1 class="text-3xl font-extrabold mt-2">Insurance monitoring</h1>
        <p class="text-sm text-on-surface-variant mt-2 mb-space-lg">Capture active agricultural and fisheries insurance policies and coverage details.</p>

        <?php if ($message): ?>
            <div class="mb-4 rounded-lg border border-primary bg-primary/10 px-4 py-3 text-sm text-primary"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="mb-4 rounded-lg border border-error bg-error/10 px-4 py-3 text-sm text-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_minmax(0,1.5fr)] gap-space-lg">
            <form method="post" class="bg-surface-container-lowest border border-surface-container rounded-lg p-space-lg space-y-4">
                <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>">
                <h2 class="text-xl font-bold">Add policy entry</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <input name="policy_number" placeholder="Policy number" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant" />
                    <input name="provider" placeholder="Insurance provider" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant" />
                </div>

                <input name="insured_name" required placeholder="Insured person or group" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant" />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <select name="farmer_id" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant">
                        <option value="">Select farmer (optional)</option>
                        <?php foreach ($farmers as $farmer): ?>
                            <option value="<?= (int) $farmer['id'] ?>"><?= htmlspecialchars(trim(($farmer['first_name'] ?? '') . ' ' . ($farmer['last_name'] ?? '')) ?: ($farmer['registration_number'] ?? 'Farmer')) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="fisherman_id" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant">
                        <option value="">Select fisherman (optional)</option>
                        <?php foreach ($fishermen as $fisherman): ?>
                            <option value="<?= (int) $fisherman['id'] ?>"><?= htmlspecialchars(trim(($fisherman['first_name'] ?? '') . ' ' . ($fisherman['last_name'] ?? '')) ?: 'Fisherman') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <select name="coverage_type" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant">
                        <option value="Crop">Crop</option>
                        <option value="Livestock">Livestock</option>
                        <option value="Fishery">Fishery</option>
                        <option value="Boat">Boat</option>
                        <option value="Other">Other</option>
                    </select>
                    <input name="coverage_amount" type="number" step="0.01" min="0" placeholder="Coverage amount" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant" />
                    <input name="premium_amount" type="number" step="0.01" min="0" placeholder="Premium amount" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <input name="start_date" type="date" value="<?= date('Y-m-d') ?>" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant" />
                    <input name="end_date" type="date" class="form-input-custom rounded-lg p-3 text-sm border border-outline-variant" />
                </div>

                <select name="status" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant">
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="expired">Expired</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                <textarea name="notes" rows="3" placeholder="Notes or coverage remarks" class="form-input-custom w-full rounded-lg p-3 text-sm border border-outline-variant"></textarea>

                <button class="rounded-lg bg-primary text-on-primary px-4 py-3 font-bold text-sm" type="submit">Save insurance record</button>
            </form>

            <div class="bg-surface-container-lowest border border-surface-container rounded-lg overflow-hidden">
                <div class="p-space-lg border-b border-surface-container">
                    <h2 class="text-xl font-bold">Recent policy records</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-surface-container-low text-xs uppercase">
                            <tr>
                                <th class="p-3">Policy</th>
                                <th class="p-3">Insured</th>
                                <th class="p-3">Type</th>
                                <th class="p-3">Coverage</th>
                                <th class="p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($insurances as $insurance): ?>
                                <?php
                                $insuredLabel = trim((string) ($insurance['insured_name'] ?? ''));
                                if ($insuredLabel === '') {
                                    $insuredLabel = trim((string) (($insurance['farmer_first_name'] ?? '') . ' ' . ($insurance['farmer_last_name'] ?? '')));
                                }
                                if ($insuredLabel === '') {
                                    $insuredLabel = trim((string) (($insurance['fisherman_first_name'] ?? '') . ' ' . ($insurance['fisherman_last_name'] ?? '')));
                                }
                                ?>
                                <tr class="border-t border-surface-container">
                                    <td class="p-3 font-semibold"><?= htmlspecialchars($insurance['policy_number'] ?? '-') ?></td>
                                    <td class="p-3"><?= htmlspecialchars($insuredLabel ?: '-') ?></td>
                                    <td class="p-3"><?= htmlspecialchars($insurance['coverage_type'] ?? '-') ?></td>
                                    <td class="p-3 font-bold text-primary">₱<?= number_format((float) ($insurance['coverage_amount'] ?? 0), 2) ?></td>
                                    <td class="p-3"><span class="inline-flex rounded-full bg-surface-container px-2 py-1 text-xs font-bold text-on-surface"><?= htmlspecialchars($insurance['status'] ?? 'pending') ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if ($insurances === []): ?>
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-on-surface-variant">No insurance entries yet. Add the first policy record.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../frontend/components/footer.php'; ?>
