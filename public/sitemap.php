<?php
$pageTitle = 'Sitemap - Municipal Agriculture Office Jimenez';
$pageDescription = 'Site map for the Municipal Agriculture Office Jimenez public portal.';
$assetBase = 'assets';
require_once __DIR__ . '/../frontend/components/header.php';
?>
<main class="min-h-screen bg-surface-container-low pt-20 py-space-3xl">
  <div class="max-w-3xl mx-auto px-gutter-mobile lg:px-gutter-desktop">
    <h1 class="font-headline-xl text-3xl font-extrabold text-on-surface">Sitemap</h1>
    <p class="mt-3 text-sm text-on-surface-variant">Navigate to the main sections and policies of this portal.</p>
    <nav class="mt-space-xl grid grid-cols-1 sm:grid-cols-2 gap-space-sm" aria-label="Sitemap links">
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="index.php#home">Home</a>
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="index.php#about">About</a>
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="index.php#contact">Contact Us</a>
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="login.php">Staff Login</a>
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="cookie-policy.php">Cookie Policy</a>
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="privacy-policy.php">Privacy Policy</a>
      <a class="bg-surface-container-lowest rounded-lg border border-surface-container p-space-md text-primary font-semibold hover:underline" href="terms-of-use.php">Terms of Use</a>
    </nav>
  </div>
</main>
<?php require_once __DIR__ . '/../frontend/components/footer.php'; ?>
