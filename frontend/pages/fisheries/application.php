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
$message = '';
$error = '';
$fishermanId = (int) ($_GET['fisherman_id'] ?? 0);
$application = $fishermanId > 0 ? $controller->applicationForFisherman($fishermanId) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $error = $controller->handle($_POST) ?? '';
        if ($error === '') {
            $message = 'Application saved. The saved copy is ready to print.';
            $savedId = $controller->savedFishermanId();
            if ($savedId !== null) {
                $fishermanId = $savedId;
                $application = $controller->applicationForFisherman($savedId);
            }
        }
    } catch (Throwable $exception) {
        error_log($exception->getMessage());
        $error = 'Unable to save the application. Check that the fishery database setup is current.';
    }
}

$pageTitle = 'Fisherman Application Form - Fishery';
$pageDescription = 'Complete and print a Fishing Boat Insurance Application.';
$personnelHeaderTitle = 'Fisherman Application Form';
$personnelHeaderSubtitle = 'Complete, save, and print the boat insurance application';
$assetBase = 'assets';
$activePage = 'application';
$fisheryPageScriptPath = __DIR__ . '/../../../public/assets/js/fisheries/fishery-page.js';
$fisheryApplicationScriptPath = __DIR__ . '/../../../public/assets/js/fisheries/fishery-application.js';
require_once __DIR__ . '/../../components/header.php';
require_once __DIR__ . '/../../components/portal-nav.php';
?>
<main class="fishery-main bg-surface-container-low" data-fishery-page data-fishery-registry-ids="[]" data-fishery-application="<?= htmlspecialchars(json_encode($application ?: [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR), ENT_QUOTES, 'UTF-8') ?>" data-fishery-print-requested="<?= isset($_GET['print']) && $_GET['print'] === '1' ? 'true' : 'false' ?>">
    <section class="mx-auto w-full max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="screen-only mb-6"><p class="text-xs font-bold uppercase tracking-wider text-primary">PCIC · Non-crop agricultural asset insurance</p><h1 class="mt-2 text-3xl font-extrabold">Fishing Boat Insurance Application</h1><p class="mt-2 text-sm text-on-surface-variant">Complete the form, save it to the fisherman profile, then print the saved copy for review.</p></div>
        <?php if ($message !== ''): ?><div class="screen-only mb-5 rounded-xl border border-primary/30 bg-primary/10 p-4 text-sm font-semibold text-primary" role="status"><?= htmlspecialchars($message) ?></div><?php endif; ?>
        <?php if ($error !== ''): ?><div class="screen-only mb-5 rounded-xl border border-error/30 bg-error/10 p-4 text-sm font-semibold text-error" role="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <div class="fishery-application-viewport">
        <div class="fishery-application rounded-xl border border-surface-container bg-white p-4 shadow-sm sm:p-8">
            <div class="paper-heading mb-5 border-b border-black pb-4">
                <p class="agency">PHILIPPINE CROP INSURANCE CORPORATION</p>
                <p class="program">NON-CROP AGRICULTURAL ASSET INSURANCE PROGRAM</p>
                <p>PCIC Regional Office No. <u>IX</u></p>
                <p class="address">Address: 2F, Bulaijay Mkts Corp. Bldg, Tiguma, Pagadian City, Zamboanga del Sur</p>
                <p class="telephone">Tel No.: ____________________</p>
                <p class="form-title">FISHING BOAT INSURANCE APPLICATION FORM</p>
            </div>

            <form method="post" class="reference-form">
                <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrf->token()) ?>">
                <input type="hidden" name="form_type" value="application">
                <input type="hidden" name="return_section" value="application">
                <input type="hidden" name="fisherman_id" value="<?= $fishermanId ?>">
                <input type="hidden" name="application_date" value="<?= htmlspecialchars($application['application_date'] ?? date('Y-m-d')) ?>">
                <section class="paper-applicant-section" aria-label="Applicant details">
                    <div class="paper-labeled-row"><span>*NAME OF APPLICANT:</span><div class="paper-name-grid"><label><input name="applicant_last_name" required aria-label="Applicant last name"><small>Last Name</small></label><label><input name="applicant_first_name" required aria-label="Applicant first name"><small>First Name</small></label><label><input name="applicant_middle_name" aria-label="Applicant middle name"><small>Middle Name</small></label></div></div>
                    <label class="paper-labeled-row"><span>*NAME OF FISHERMEN ASSOCIATION:</span><input name="fishermen_association" aria-label="Fishermen association"></label>
                    <label class="paper-labeled-row"><span>*ADDRESS:</span><input name="address" required aria-label="Applicant address"></label>
                    <label class="paper-labeled-row"><span>*NAME OF SPOUSE:</span><input name="spouse_name" aria-label="Name of spouse"></label>
                    <label class="paper-labeled-row"><span>*CONTACT NO:</span><input name="contact_number" aria-label="Contact number"></label>
                    <div class="paper-choice-row">
                        <span>*SEX:</span>
                        <div class="paper-options">
                            <label class="paper-option"><input type="radio" name="sex" value="male"><span class="paper-option-mark" aria-hidden="true"></span>MALE</label>
                            <label class="paper-option"><input type="radio" name="sex" value="female"><span class="paper-option-mark" aria-hidden="true"></span>FEMALE</label>
                        </div>
                        <span class="paper-inline-label">CIVIL STATUS:</span>
                        <div class="paper-options paper-civil">
                            <label class="paper-option"><input type="radio" name="civil_status" value="Single"><span class="paper-option-mark" aria-hidden="true"></span>SINGLE</label>
                            <label class="paper-option"><input type="radio" name="civil_status" value="Married"><span class="paper-option-mark" aria-hidden="true"></span>MARRIED</label>
                            <label class="paper-option"><input type="radio" name="civil_status" value="Widow/er"><span class="paper-option-mark" aria-hidden="true"></span>WIDOW/ER</label>
                            <label class="paper-option"><input type="radio" name="civil_status" value="Separated"><span class="paper-option-mark" aria-hidden="true"></span>SEPARATED</label>
                        </div>
                    </div>
                    <div class="paper-beneficiary"><label><span>*BENEFICIARY:</span><input name="beneficiary_name" aria-label="Beneficiary"></label><label><span>RELATION:</span><input name="beneficiary_relation" aria-label="Beneficiary relation"></label></div>
                </section>
                <section class="paper-property-section" aria-label="Description of property to be insured">
                    <p class="paper-property-title">DESCRIPTION OF PROPERTY<br>TO BE INSURED</p>
                    <div class="paper-choice-field"><span>*TYPE OF BOAT:</span><div class="paper-options">
                        <label class="paper-option paper-option-square"><input type="radio" name="boat_type" value="motorized"><span class="paper-option-mark" aria-hidden="true"></span>motorized</label>
                        <label class="paper-option paper-option-square"><input type="radio" name="boat_type" value="non-motorized"><span class="paper-option-mark" aria-hidden="true"></span>non-motorized</label>
                    </div></div>
                    <div class="paper-choice-field"><span>*TYPE OF MATERIAL/MAKE:</span><div class="paper-options">
                        <label class="paper-option paper-option-square"><input type="radio" name="boat_material" value="wooden hull"><span class="paper-option-mark" aria-hidden="true"></span>wooden hull</label>
                        <label class="paper-option paper-option-square"><input type="radio" name="boat_material" value="fiberglass hull"><span class="paper-option-mark" aria-hidden="true"></span>fiberglass hull</label>
                    </div></div>
                    <label class="paper-labeled-row"><span>MOTOR NO.:</span><input name="motor_number"></label>
                    <label class="paper-labeled-row"><span>CHASSIS NO.:</span><input name="chassis_number"></label>
                    <label class="paper-labeled-row"><span>USAGE:</span><input name="usage_description"></label>
                    <label class="paper-labeled-row"><span>OTHERS:</span><input name="other_description"></label>
                    <div class="paper-details-grid">
                        <div>
                            <label>Length<input name="length_meters" type="number" step="0.01"></label>
                            <label>Breadth<input name="breadth_meters" type="number" step="0.01"></label>
                            <label>Breadth<input name="breadth_meters_2" type="number" step="0.01"></label>
                            <label>Depth<input name="depth_meters" type="number" step="0.01"></label>
                            <label>Registration Number<input name="registration_number"></label>
                        </div>
                        <div>
                            <label>Gross Tonnage<input name="gross_tonnage" type="number" step="0.01"></label>
                            <label>Age<input name="boat_age_years" type="number" step="0.01"></label>
                            <label>Age<input name="boat_age_years_2" type="number" step="0.01"></label>
                            <label>Color<input name="boat_color"></label>
                            <div class="paper-or-date-row"><label>OR #<input name="or_number"></label><label>Date<input name="or_date" type="date"></label></div>
                        </div>
                    </div>
                </section>
                <section class="paper-coverage-section" aria-label="Coverage and purchase details">
                    <div class="paper-property-location"><label>*LOCATION OF<br>PROPERTY PLOATER<input name="location_of_property" aria-label="Location of property floater"></label><div class="paper-insured-amount"><span>P</span><input name="desired_sum_insured" type="number" step="0.01" aria-label="Sum insured"></div></div>
                    <div class="paper-period-row"><span>PERIOD OF COVER</span><label>From:<input name="cover_from" type="date"></label><label>To:<input name="cover_to" type="date"></label></div>
                    <div class="paper-purchase"><strong>OF PURCHASE</strong><label>BRANCH<input name="mortgage_to" aria-label="First purchase branch"></label><label>BRANCH<input name="mortgage_branch" aria-label="Second purchase branch"></label><label>ADDRESS<input name="mortgage_address" aria-label="Purchase address"></label></div>
                    <p class="paper-note">AND/OR<br>OFFICIAL RECEIPT</p>
                </section>
                <section class="paper-signatures" aria-label="Applicant signature and account officer review">
                    <div class="paper-review-block"><label>REVIEWED BY:<input name="reviewed_by" aria-label="Reviewed by"></label><small>ACCOUNT OFFICER</small><label>DATE:<input name="review_date" type="date"></label></div>
                    <div class="paper-applicant-signature"><span></span><p>(SIGNATURE OVER PRINTED NAME<br>OF THE APPLICANT)</p></div>
                </section>
                <div class="fishery-application-actions screen-only"><button type="submit" class="fishery-primary-button">Save application</button><button type="button" onclick="window.print()" class="fishery-secondary-button">Print application</button></div>
            </form>
        </div>
        </div>
    </section>
</main>
<script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/js/fisheries/fishery-page.js?v=<?= is_file($fisheryPageScriptPath) ? (int) filemtime($fisheryPageScriptPath) : 1 ?>"></script>
<script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/js/fisheries/fishery-application.js?v=<?= is_file($fisheryApplicationScriptPath) ? (int) filemtime($fisheryApplicationScriptPath) : 1 ?>"></script>
<?php require_once __DIR__ . '/../../components/footer.php'; ?>
