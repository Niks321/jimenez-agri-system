<?php
/**
 * Municipal Agriculture Office Jimenez - Footer Component
 * Path: frontend/components/footer.php
 */
$assetBase = $assetBase ?? 'assets';
?>
  <!-- COOKIES CONSENT BANNER -->
  <aside class="fixed bottom-0 inset-x-0 z-50 bg-inverse-surface text-inverse-on-surface p-space-md shadow-2xl border-t border-outline-variant/30" id="cookie-banner" style="display: none;" role="dialog" aria-labelledby="cookie-banner-title">
    <div class="max-w-container-max mx-auto px-gutter-mobile lg:px-gutter-desktop flex flex-col sm:flex-row items-center justify-between gap-space-md">
      <div class="flex items-center gap-space-sm">
        <span class="material-symbols-outlined text-primary-fixed shrink-0 text-2xl">cookie</span>
        <p id="cookie-banner-title" class="font-body-sm text-xs sm:text-sm leading-relaxed text-inverse-on-surface">
          This website uses essential cookies for staff sessions, security, and preferences. Review our <a class="underline font-semibold hover:text-primary-fixed transition-colors" href="#cookie-policy-modal" data-policy-open="cookie-policy-modal">Cookie Policy</a> and <a class="underline font-semibold hover:text-primary-fixed transition-colors" href="#privacy-policy-modal" data-policy-open="privacy-policy-modal">Privacy Policy</a>.
        </p>
      </div>
      <div class="shrink-0 flex items-center gap-space-sm w-full sm:w-auto">
        <button id="cookie-decline-btn" data-cookie-choice="declined" class="w-full sm:w-auto px-space-lg py-space-xs rounded-lg border border-white/40 text-white hover:bg-white/10 transition-all font-label-lg text-xs sm:text-sm font-bold">Decline</button>
        <button id="cookie-accept-btn" data-cookie-choice="accepted" class="w-full sm:w-auto px-space-lg py-space-xs rounded-lg bg-primary-fixed text-on-primary-fixed hover:bg-primary-fixed-dim transition-all font-label-lg text-xs sm:text-sm font-bold shadow">Accept</button>
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
          <a class="hover:text-on-primary transition-colors" href="#cookie-policy-modal" data-policy-open="cookie-policy-modal">Cookie Policy</a>
          <span class="opacity-40">•</span>
          <a class="hover:text-on-primary transition-colors" href="#privacy-policy-modal" data-policy-open="privacy-policy-modal">Privacy Policy</a>
          <span class="opacity-40">•</span>
          <a class="hover:text-on-primary transition-colors" href="#terms-of-use-modal" data-policy-open="terms-of-use-modal">Terms of Use</a>
          <span class="opacity-40">•</span>
          <a class="hover:text-on-primary transition-colors" href="#sitemap-modal" data-policy-open="sitemap-modal">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>

  <dialog id="cookie-policy-modal" class="policy-modal" aria-labelledby="cookie-policy-title">
    <article class="policy-modal-panel">
      <div class="policy-modal-header"><div><p class="policy-eyebrow">Municipal Agriculture Office Jimenez</p><h2 id="cookie-policy-title">Cookie Policy</h2><p>Effective and last updated: September 8, 2026</p></div><button type="button" class="policy-modal-close" data-policy-close aria-label="Close Cookie Policy">&times;</button></div>
      <div class="policy-modal-content">
        <p>This policy explains how cookies and similar technologies are used by the Jimenez Agricultural Information System for authorized personnel and staff.</p>
        <h3>What cookies are</h3><p>Cookies are small text files stored by the browser. Session cookies support authenticated staff sessions and are removed when the session ends. Persistent cookies remember limited preferences, such as cookie consent.</p>
        <h3>How we use them</h3><ul><li>Maintain staff login sessions and access control.</li><li>Protect forms and detect suspicious activity.</li><li>Remember essential website preferences.</li><li>Support reliable operation and diagnose technical issues.</li></ul>
        <h3>Security and staff responsibility</h3><p>Session cookies are protected with HttpOnly, SameSite, strict session handling, inactivity expiration, and no-cache response headers. Staff should log out on shared computers and must not share session credentials.</p>
        <h3>Managing cookies</h3><p>Staff may clear or block cookies in browser settings, but doing so may prevent login and other secured functions from working correctly.</p>
        <h3>Contact</h3><p>Municipal Agriculture Office Jimenez, Corrales, Jimenez, Misamis Occidental, Region X, Philippines. Email: <a href="mailto:aggies.jimenez2016@gmail.com">aggies.jimenez2016@gmail.com</a>. Phone: +63 999 723 88625.</p>
      </div>
    </article>
  </dialog>

  <dialog id="privacy-policy-modal" class="policy-modal" aria-labelledby="privacy-policy-title">
    <article class="policy-modal-panel">
      <div class="policy-modal-header"><div><p class="policy-eyebrow">Authorized Personnel and Staff</p><h2 id="privacy-policy-title">Privacy Policy</h2><p>Effective and last updated: September 8, 2026</p></div><button type="button" class="policy-modal-close" data-policy-close aria-label="Close Privacy Policy">&times;</button></div>
      <div class="policy-modal-content">
        <p>The Municipal Agriculture Office Jimenez respects the privacy of individuals whose information is handled through the Jimenez Agricultural Information System.</p>
        <h3>Information handled</h3><p>Depending on the service, records may include names, email addresses, barangay, contact numbers, assistance requests, messages, account details, IP addresses, access times, and security logs.</p>
        <h3>Purpose and access</h3><p>Information is used for legitimate municipal functions, agricultural assistance, program coordination, records management, communication, system security, and compliance with applicable Philippine laws and government requirements. Access is limited to personnel with a legitimate work need.</p>
        <h3>Protection and retention</h3><p>Reasonable safeguards include authentication, role-based access, password protection, input validation, session controls, cache controls, monitoring, and secure database practices. Records are retained only as long as needed for service delivery, government records, legal duties, and approved administrative requirements.</p>
        <h3>Disclosure and rights</h3><p>Personal information is not sold or rented. It may be shared with authorized government offices when necessary for public service or required by law. Subject to applicable limitations, individuals may request information about processing, access, correction, or other rights under Philippine data-protection requirements.</p>
        <h3>Contact</h3><p>Privacy concerns may be sent to <a href="mailto:aggies.jimenez2016@gmail.com">aggies.jimenez2016@gmail.com</a> or the Municipal Agriculture Office Jimenez, Corrales, Jimenez, Misamis Occidental.</p>
      </div>
    </article>
  </dialog>

  <dialog id="terms-of-use-modal" class="policy-modal" aria-labelledby="terms-of-use-title">
    <article class="policy-modal-panel">
      <div class="policy-modal-header"><div><p class="policy-eyebrow">Jimenez Agricultural Information System</p><h2 id="terms-of-use-title">Terms of Use</h2><p>Effective and last updated: September 8, 2026</p></div><button type="button" class="policy-modal-close" data-policy-close aria-label="Close Terms of Use">&times;</button></div>
      <div class="policy-modal-content">
        <p>These terms govern authorized staff access to the Municipal Agriculture Office Jimenez information system.</p>
        <h3>Authorized use</h3><p>Use the system only for lawful municipal work, agricultural service delivery, records management, and other duties assigned by the office. Staff are responsible for keeping account credentials confidential and logging out after use.</p>
        <h3>Prohibited activities</h3><ul><li>Attempting unauthorized access or bypassing security controls.</li><li>Introducing malware, malicious code, or harmful input.</li><li>Accessing, changing, or exporting records without authorization.</li><li>Sharing accounts or impersonating another person.</li><li>Overloading the system or using automated tools to interfere with availability.</li></ul>
        <h3>Information and availability</h3><p>System information supports municipal operations and may change as records, programs, schedules, and policies are updated. Temporary interruptions may occur for maintenance, security measures, connectivity, or technical failures.</p>
        <h3>Security reporting</h3><p>Suspected unauthorized access, data exposure, malicious activity, or other security incidents must be reported promptly to the Municipal Agriculture Office. The office may suspend access or investigate activity that threatens system integrity.</p>
        <h3>Governing framework</h3><p>These terms are interpreted with applicable laws and regulations of the Republic of the Philippines, together with the office Privacy Policy and Cookie Policy.</p>
      </div>
    </article>
  </dialog>

  <dialog id="sitemap-modal" class="policy-modal" aria-labelledby="sitemap-title">
    <article class="policy-modal-panel">
      <div class="policy-modal-header"><div><p class="policy-eyebrow">Municipal Agriculture Office Jimenez</p><h2 id="sitemap-title">Sitemap</h2><p>Quick access to public information and staff services</p></div><button type="button" class="policy-modal-close" data-policy-close aria-label="Close Sitemap">&times;</button></div>
      <div class="policy-modal-content"><div class="policy-sitemap-grid"><a href="#home">Home</a><a href="#about">About and Mandate</a><a href="#pictures">Pictures and Gallery</a><a href="#staff">Staff Hierarchy</a><a href="#team">Development Team</a><a href="#contact">Contact Us</a><a href="login.php">Staff Login</a><a href="#cookie-policy-modal" data-policy-open="cookie-policy-modal">Cookie Policy</a><a href="#privacy-policy-modal" data-policy-open="privacy-policy-modal">Privacy Policy</a><a href="#terms-of-use-modal" data-policy-open="terms-of-use-modal">Terms of Use</a></div></div>
    </article>
  </dialog>

  <style>
    .policy-modal {
      display: none;
      position: fixed;
      inset: 0;
      align-items: center;
      justify-content: center;
      width: min(760px, calc(100% - 2rem));
      max-height: min(86vh, 760px);
      padding: 0;
      border: 0;
      border-radius: 12px;
      color: #173224;
      background: #f8fbf6;
      box-shadow: 0 24px 80px rgb(0 0 0 / 35%);
    }

    .policy-modal[open],
    .policy-modal.is-open {
      display: flex;
    }

    .policy-modal.is-open {
      background: rgb(5 20 12 / 70%);
      backdrop-filter: blur(3px);
    }

    body.policy-modal-open {
      overflow-x: hidden !important;
      overflow-y: visible !important;
    }

    .policy-modal::backdrop {
      background: rgb(5 20 12 / 70%);
      backdrop-filter: blur(3px);
    }

    .policy-modal-panel {
      width: 100%;
      overflow: hidden;
      background: #f8fbf6;
      border-radius: 12px;
    }

    .policy-modal-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 1rem;
      padding: 1.5rem 1.5rem 1.25rem;
      color: #fff;
      background: #07552f;
      border-bottom: 4px solid #d6e85c;
    }

    .policy-modal-header h2 {
      margin: .2rem 0 0;
      font-size: clamp(1.4rem, 3vw, 2rem);
      font-weight: 800;
    }

    .policy-modal-header p:last-child {
      margin: .45rem 0 0;
      color: #d9f1df;
      font-size: .75rem;
    }

    .policy-eyebrow {
      margin: 0;
      color: #d6e85c;
      font-size: .7rem;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    .policy-modal-close {
      width: 2.25rem;
      height: 2.25rem;
      flex: 0 0 auto;
      border: 1px solid rgb(255 255 255 / 35%);
      border-radius: 6px;
      color: #fff;
      background: rgb(255 255 255 / 10%);
      font-size: 1.75rem;
      line-height: 1;
      cursor: pointer;
    }

    .policy-modal-close:hover,
    .policy-modal-close:focus-visible {
      background: rgb(255 255 255 / 22%);
    }

    .policy-modal-content {
      max-height: calc(min(86vh, 760px) - 130px);
      overflow-y: auto;
      padding: 1.5rem;
      font-size: .9rem;
      line-height: 1.7;
    }

    .policy-modal-content h3 {
      margin: 1.4rem 0 .35rem;
      color: #07552f;
      font-size: 1rem;
      font-weight: 800;
    }

    .policy-modal-content p {
      margin: .55rem 0;
    }

    .policy-modal-content ul {
      margin: .5rem 0;
      padding-left: 1.25rem;
    }

    .policy-modal-content a {
      color: #07552f;
      font-weight: 700;
      text-decoration: underline;
    }

    .policy-sitemap-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: .75rem;
    }

    .policy-sitemap-grid a {
      padding: .75rem;
      border: 1px solid #c8d8cb;
      border-radius: 6px;
      background: #fff;
      text-decoration: none;
    }

    .policy-sitemap-grid a:hover,
    .policy-sitemap-grid a:focus-visible {
      background: #eef6e8;
    }

    @media (max-width: 560px) {
      .policy-modal {
        width: calc(100% - 1rem);
      }

      .policy-modal-header,
      .policy-modal-content {
        padding: 1.1rem;
      }

      .policy-sitemap-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <!-- External Application Logic Script -->
  <script src="<?= $assetBase ?>/js/app.js?v=16"></script>
</body>
</html>
