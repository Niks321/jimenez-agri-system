<?php
/**
 * Municipal Agriculture Office Jimenez - Navbar Component
 * Path: frontend/components/navbar.php
 */
$loginUrl = $loginUrl ?? 'login.php';
$assetBase = $assetBase ?? 'assets';
?>
<!-- TOP BAR & NAVIGATION -->
<header class="fixed top-0 w-full z-50 bg-primary text-white shadow-lg border-b border-primary-container transition-all">
  <!-- Main Navigation Bar -->
  <div class="h-20 max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop flex items-center justify-between gap-space-md">
    
    <!-- Official Emblem + Title -->
    <a class="flex items-center gap-space-sm hover:opacity-95 transition-opacity" href="#home">
      <!-- Official Jimenez Municipality Logo with White Background -->
      <div class="w-12 h-12 rounded-full bg-white p-1 flex items-center justify-center shadow-md shrink-0 border border-white/50">
        <img src="<?= $assetBase ?>/images/banners/jimenez-logo-no-bg.png" 
             alt="Municipality of Jimenez Emblem" 
             class="w-full h-full object-contain">
      </div>
      <div class="flex flex-col">
        <span class="font-headline-sm text-sm sm:text-base md:text-lg text-white font-extrabold tracking-tight uppercase leading-tight">
          Municipal Agriculture Office Jimenez
        </span>
        <span class="font-label-sm text-[11px] text-emerald-200 font-semibold tracking-wider uppercase">
          Jimenez, Misamis Occidental
        </span>
      </div>
    </a>

    <!-- Desktop Navigation Links (High contrast white & emerald, no grey) -->
    <nav class="hidden xl:flex items-center gap-space-lg text-white font-label-lg text-sm font-semibold">
      <a class="text-white/90 hover:text-white hover:border-b-2 hover:border-secondary-fixed transition-all py-1" href="#home">Home</a>
      <a class="text-white/90 hover:text-white hover:border-b-2 hover:border-secondary-fixed transition-all py-1" href="#about">About</a>
      <a class="text-white/90 hover:text-white hover:border-b-2 hover:border-secondary-fixed transition-all py-1" href="#pictures">Pictures</a>
      <a class="text-white/90 hover:text-white hover:border-b-2 hover:border-secondary-fixed transition-all py-1" href="#staff">Staff</a>
      <a class="text-white/90 hover:text-white hover:border-b-2 hover:border-secondary-fixed transition-all py-1" href="#team">Team</a>
      <a class="text-white/90 hover:text-white hover:border-b-2 hover:border-secondary-fixed transition-all py-1" href="#contact">Contact</a>
    </nav>

    <!-- Action Button / Link: LOGIN & Mobile Menu Button -->
    <div class="flex items-center gap-space-sm">
      <a class="inline-flex items-center gap-space-xs px-space-md lg:px-space-lg py-space-xs rounded-xl bg-secondary-fixed text-on-secondary-fixed hover:bg-secondary-fixed-dim transition-all font-label-lg text-xs md:text-sm shadow font-bold uppercase tracking-wider" href="<?= htmlspecialchars($loginUrl) ?>">
        <span class="material-symbols-outlined text-base">lock</span>
        <span>LOGIN</span>
      </a>
      <!-- Mobile menu button -->
      <button id="mobile-menu-btn" class="xl:hidden p-2 rounded-lg text-white hover:bg-primary-container transition-colors" aria-label="Toggle navigation menu">
        <span class="material-symbols-outlined text-2xl" id="menu-icon">menu</span>
      </button>
    </div>
  </div>

  <!-- Mobile Navigation Drawer -->
  <div id="mobile-menu" class="hidden xl:hidden bg-primary-container border-t border-white/20 px-gutter-mobile py-space-md shadow-2xl space-y-2">
    <a class="block px-3 py-2 rounded-lg font-semibold text-white hover:bg-primary transition-colors" href="#home" onclick="closeMobileMenu()">Home</a>
    <a class="block px-3 py-2 rounded-lg font-semibold text-white/90 hover:text-white hover:bg-primary transition-colors" href="#about" onclick="closeMobileMenu()">About</a>
    <a class="block px-3 py-2 rounded-lg font-semibold text-white/90 hover:text-white hover:bg-primary transition-colors" href="#pictures" onclick="closeMobileMenu()">Pictures</a>
    <a class="block px-3 py-2 rounded-lg font-semibold text-white/90 hover:text-white hover:bg-primary transition-colors" href="#staff" onclick="closeMobileMenu()">Staff</a>
    <a class="block px-3 py-2 rounded-lg font-semibold text-white/90 hover:text-white hover:bg-primary transition-colors" href="#team" onclick="closeMobileMenu()">Team</a>
    <a class="block px-3 py-2 rounded-lg font-semibold text-white/90 hover:text-white hover:bg-primary transition-colors" href="#contact" onclick="closeMobileMenu()">Contact</a>
  </div>
</header>
