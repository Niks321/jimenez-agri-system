<?php
/**
 * Municipal Agriculture Office Jimenez - HTML Header Component
 * Path: frontend/components/header.php
 */
$pageTitle = $pageTitle ?? 'Municipal Agriculture Office - Jimenez, Misamis Occidental';
$pageDescription = $pageDescription ?? 'Official Portal of the Municipal Agriculture Office of Jimenez, Misamis Occidental. Empowering farmers, fisherfolk, and agricultural entrepreneurs.';
$assetBase = $assetBase ?? 'assets';
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
  <script src="<?= $assetBase ?>/js/tailwind-config.js"></script>

  <!-- External Modular Stylesheets -->
  <link rel="stylesheet" href="<?= $assetBase ?>/css/style.css">
  <link rel="stylesheet" href="<?= $assetBase ?>/css/components.css">
  <link rel="stylesheet" href="<?= $assetBase ?>/css/responsive.css">
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">
