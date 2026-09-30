<?php
/**
 * Municipal Agriculture Office Jimenez - HTML Header Component
 * Path: frontend/components/header.php
 */
$pageTitle = $pageTitle ?? 'Municipal Agriculture Office - Jimenez, Misamis Occidental';
$pageDescription = $pageDescription ?? 'Official Portal of the Municipal Agriculture Office of Jimenez, Misamis Occidental. Empowering farmers, fisherfolk, and agricultural entrepreneurs.';
$publicAssetDirectory = realpath(__DIR__ . '/../../public');
$documentRootDirectory = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$assetBase = 'assets';
if ($publicAssetDirectory !== false && $documentRootDirectory !== false) {
  $documentRootPrefix = rtrim($documentRootDirectory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  if (strcasecmp($publicAssetDirectory, $documentRootDirectory) === 0) {
    $publicUrlPrefix = '';
  } elseif (stripos($publicAssetDirectory, $documentRootPrefix) === 0) {
    $relativePublicPath = substr($publicAssetDirectory, strlen($documentRootPrefix));
    $publicUrlPrefix = implode('/', array_map('rawurlencode', explode(DIRECTORY_SEPARATOR, $relativePublicPath)));
  } else {
    $publicUrlPrefix = null;
  }
  if ($publicUrlPrefix !== null) {
    $assetBase = ($publicUrlPrefix === '' ? '' : '/' . $publicUrlPrefix) . '/assets';
  }
}
$assetVersion = static function (string $relativePath): string {
  $file = __DIR__ . '/../../public/' . $relativePath;
  return is_file($file) ? (string) filemtime($file) : '1';
};
$sessionSecurity = __DIR__ . '/../../backend/security/SessionSecurity.php';
if (is_file($sessionSecurity)) {
  require_once $sessionSecurity;
  call_user_func(['SessionSecurity', 'start']);
  call_user_func(['SessionSecurity', 'preventCaching']);
}
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">

  <!-- Google Fonts & Material Symbols -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <!-- External Tailwind Theme Configuration -->
  <script src="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/js/tailwind-config.js?v=<?= htmlspecialchars($assetVersion('js/tailwind-config.js'), ENT_QUOTES, 'UTF-8') ?>"></script>

  <!-- External Modular Stylesheets -->
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/css/style.css?v=<?= htmlspecialchars($assetVersion('css/style.css'), ENT_QUOTES, 'UTF-8') ?>">
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/css/components.css?v=<?= htmlspecialchars($assetVersion('css/components.css'), ENT_QUOTES, 'UTF-8') ?>">
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/css/responsive.css?v=<?= htmlspecialchars($assetVersion('css/responsive.css'), ENT_QUOTES, 'UTF-8') ?>">
  <link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/css/policy-modals.css?v=<?= htmlspecialchars($assetVersion('css/policy-modals.css'), ENT_QUOTES, 'UTF-8') ?>">
  <?php if (($activePage ?? '') !== ''): ?><link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/css/personnel.css?v=<?= htmlspecialchars($assetVersion('css/personnel.css'), ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
  <?php if (($activePage ?? '') === 'application'): ?><link rel="stylesheet" href="<?= htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8') ?>/css/fisheries/fishery-application.css?v=<?= htmlspecialchars($assetVersion('css/fisheries/fishery-application.css'), ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">
