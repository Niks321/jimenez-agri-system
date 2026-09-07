<?php
/**
 * Municipal Agriculture Office Jimenez - Footer Component
 * Path: frontend/components/footer.php
 */
$assetBase = $assetBase ?? 'assets';
?>
  <!-- COOKIES CONSENT BANNER -->
  <aside class="fixed bottom-0 inset-x-0 z-50 bg-inverse-surface text-inverse-on-surface p-space-md shadow-2xl border-t border-outline-variant/30" id="cookie-banner" style="display: none;">
    <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop flex flex-col sm:flex-row items-center justify-between gap-space-md">
      <div class="flex items-center gap-space-sm">
        <span class="material-symbols-outlined text-primary-fixed shrink-0 text-2xl">cookie</span>
        <p class="font-body-sm text-xs sm:text-sm leading-relaxed text-inverse-on-surface">
          Cookies help us deliver our services. By using our services, you agree to our use of cookies. <a class="underline font-semibold hover:text-primary-fixed transition-colors" href="#">Cookie Policy</a>. For information on how we protect your privacy, please read our <a class="underline font-semibold hover:text-primary-fixed transition-colors" href="#">Privacy Policy</a>.
        </p>
      </div>
      <div class="shrink-0 flex items-center gap-space-sm w-full sm:w-auto">
        <button id="cookie-accept-btn" class="w-full sm:w-auto px-space-lg py-space-xs rounded-lg bg-primary-fixed text-on-primary-fixed hover:bg-primary-fixed-dim transition-all font-label-lg text-xs sm:text-sm font-bold shadow">
          I accept
        </button>
      </div>
    </div>
  </aside>

  <!-- FOOTER -->
  <footer class="w-full bg-primary text-on-primary pt-space-3xl pb-space-2xl">
    <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl pb-space-2xl">
        <!-- Col 1: Brand & Emblem -->
        <div class="flex flex-col gap-space-sm">
          <div class="flex items-center gap-space-sm">
            <div class="w-11 h-11 rounded-full bg-white p-1 flex items-center justify-center shadow-md shrink-0 border border-white/40">
              <img src="<?= $assetBase ?>/images/banners/jimenez-logo-no-bg.png" 
                   alt="Municipality of Jimenez Logo" 
                   class="w-full h-full object-contain">
            </div>
            <span class="font-headline-sm text-base text-primary-fixed font-bold">Municipal Agriculture Office</span>
          </div>
          <span class="font-label-sm text-xs text-surface-variant font-medium">Jimenez, Misamis Occidental</span>
          <p class="font-body-sm text-xs text-surface-variant mt-space-xs leading-relaxed">
            Responsible for the promotion of agricultural and fisheries growth, modern rural agro-enterprises, and food security in the Municipality of Jimenez.
          </p>
        </div>

        <!-- Col 2: Navigation Links -->
        <div class="flex flex-col gap-space-sm">
          <span class="font-headline-sm text-sm text-primary-fixed font-bold uppercase tracking-wider">Quick Links</span>
          <div class="flex flex-col gap-2 font-body-sm text-xs text-surface-variant">
            <a class="hover:text-on-primary transition-colors" href="#home">Home</a>
            <a class="hover:text-on-primary transition-colors" href="#about">About</a>
            <a class="hover:text-on-primary transition-colors" href="#pictures">Pictures</a>
            <a class="hover:text-on-primary transition-colors" href="#staff">Staff Hierarchy</a>
            <a class="hover:text-on-primary transition-colors" href="#team">Dev Team</a>
            <a class="hover:text-on-primary transition-colors" href="#contact">Contact Us</a>
          </div>
        </div>

        <!-- Col 3: Official Details -->
        <div class="flex flex-col gap-space-sm">
          <span class="font-headline-sm text-sm text-primary-fixed font-bold uppercase tracking-wider">Office Address</span>
          <p class="font-body-sm text-xs text-surface-variant leading-relaxed">
            Municipal Agriculture Office, Corrales, Jimenez Misamis Occidental, Region X, Philippines
          </p>
          <p class="font-body-sm text-xs text-surface-variant mt-space-xxs">
            Call: <strong class="text-on-primary">+6399972388625</strong><br>
            Email: <strong class="text-on-primary">aggies.jimenez2016@gmail.com</strong>
          </p>
        </div>

        <!-- Col 4: Institutional Seal -->
        <div class="flex flex-col gap-space-sm">
          <span class="font-headline-sm text-sm text-primary-fixed font-bold uppercase tracking-wider">Governance</span>
          <p class="font-body-sm text-xs text-surface-variant leading-relaxed">
            In collaborative partnership with the Department of Agriculture Regional Field Office X & Municipal Government of Jimenez.
          </p>
          <div class="mt-space-xs inline-flex items-center px-space-sm py-space-xs rounded bg-primary-container text-on-primary-container font-label-sm text-xs font-semibold">
            Republic of the Philippines • Transparency Seal
          </div>
        </div>
      </div>

      <!-- Bottom Bar with Copyright & Policy Links -->
      <div class="pt-space-lg border-t border-primary-container flex flex-col sm:flex-row items-center justify-between gap-space-md text-surface-variant font-caption text-xs">
        <p>Copyright © 1996-2026 Municipal Agriculture Office Jimenez. All Rights Reserved</p>
        <div class="flex flex-wrap items-center gap-space-md">
          <a class="hover:text-on-primary transition-colors" href="#">Cookie Policy</a>
          <span class="opacity-40">•</span>
          <a class="hover:text-on-primary transition-colors" href="#">Privacy Policy</a>
          <span class="opacity-40">•</span>
          <a class="hover:text-on-primary transition-colors" href="#">Terms of Use</a>
          <span class="opacity-40">•</span>
          <a class="hover:text-on-primary transition-colors" href="#">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- External Application Logic Script -->
  <script src="<?= $assetBase ?>/js/app.js"></script>
</body>
</html>
