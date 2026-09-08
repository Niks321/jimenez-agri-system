<?php
/**
 * Municipal Agriculture Office Jimenez - Login Page
 */
$turnstileClass = __DIR__ . '/../backend/security/Turnstile.php';
require_once $turnstileClass;
require_once __DIR__ . '/../backend/security/InputSanitizer.php';
require_once __DIR__ . '/../backend/security/SessionSecurity.php';
call_user_func(['SessionSecurity', 'start']);
call_user_func(['SessionSecurity', 'preventCaching']);
$turnstileConfig = require __DIR__ . '/../config/security.php';
$turnstileConfigured = $turnstileConfig['turnstile_site_key'] !== '' && $turnstileConfig['turnstile_secret_key'] !== '';
$loginError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = call_user_func(['InputSanitizer', 'email'], $_POST['email'] ?? null);
	$password = call_user_func(['InputSanitizer', 'password'], $_POST['password'] ?? null);
	$turnstileProof = $turnstileConfigured
		&& Turnstile::verify((string) ($_POST['cf-turnstile-response'] ?? ''));
	$localHumanCheck = !$turnstileConfigured
		&& !empty($_POST['anti_bot'])
		&& $_POST['anti_bot'] === 'on';
	$honeypot = call_user_func(['InputSanitizer', 'honeypot'], $_POST['website'] ?? null);

	if ($email === '' || $password === '' || ((!$turnstileProof && !$localHumanCheck) || $honeypot !== '')) {
		$loginError = 'Please complete the human verification before signing in.';
    }
}

$pageTitle = 'Login - Municipal Agriculture Office Jimenez';
$pageDescription = 'Sign in to the Municipal Agriculture Office Jimenez information system.';
$assetBase = 'assets';
require_once __DIR__ . '/../frontend/components/header.php';
?>

<main class="min-h-screen bg-surface-container-low flex flex-col">
	<header class="h-20 bg-primary text-on-primary border-b-4 border-secondary-fixed shadow-lg">
		<div class="max-w-container-max mx-auto h-full px-gutter-mobile lg:px-gutter-desktop flex items-center justify-between gap-space-md">
			<a class="flex items-center gap-space-sm" href="index.php" aria-label="Return to Municipal Agriculture Office public portal">
				<div class="w-11 h-11 rounded-full bg-white p-1 flex items-center justify-center shadow-md shrink-0">
					<img src="<?= $assetBase ?>/images/banners/jimenez-logo-no-bg.png" alt="Municipality of Jimenez Logo" class="w-full h-full object-contain">
				</div>
				<div>
					<span class="block font-headline-sm text-sm sm:text-base font-extrabold uppercase leading-tight">Municipal Agriculture Office</span>
					<span class="block font-label-sm text-[11px] text-emerald-200 font-semibold tracking-wider uppercase">Municipality of Jimenez, Misamis Occidental</span>
				</div>
			</a>
			<a class="inline-flex items-center gap-space-xs px-space-md lg:px-space-lg py-space-xs rounded-xl bg-secondary-fixed text-on-secondary-fixed hover:bg-secondary-fixed-dim transition-all font-label-lg text-xs sm:text-sm shadow font-bold uppercase tracking-wider" href="index.php">Public Portal</a>
		</div>
	</header>

	<div class="flex-1 flex items-center py-space-lg lg:py-space-xl">
		<div class="max-w-container-max mx-auto w-full px-gutter-mobile lg:px-gutter-desktop">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-space-lg lg:gap-space-xl items-stretch">
				<section class="bg-surface-container-lowest p-space-lg sm:p-space-xl rounded-lg shadow-md border border-surface-container flex items-center">
					<div class="w-full max-w-md mx-auto">
						<div class="mb-space-lg">
							<p class="font-label-sm text-xs uppercase tracking-wider text-primary font-bold">Restricted system access</p>
							<h1 class="font-headline-xl text-3xl sm:text-4xl text-on-surface font-extrabold mt-2">Sign in to continue</h1>
							<p class="font-body-md text-sm text-on-surface-variant mt-2 leading-relaxed">Authorized personnel may access the Jimenez Agricultural Information System using their official account.</p>
						</div>

						<div class="border-l-4 border-secondary-fixed bg-surface-container-low px-space-md py-space-xs mb-space-md">
							<p class="font-body-sm text-xs text-on-surface-variant leading-relaxed"><strong class="text-on-surface">Notice:</strong> This system is for official municipal business. Activity may be recorded for security and accountability.</p>
						</div>

						<form class="space-y-space-sm" method="post" action="" id="login-form" novalidate>
							<div>
								<label class="block font-label-lg text-sm font-semibold text-on-surface mb-2" for="email">Email address</label>
								<input class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-3 text-sm text-on-surface border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary" id="email" name="email" type="email" autocomplete="off" required>
							</div>

							<div>
								<div class="flex items-center justify-between mb-2">
									<label class="font-label-lg text-sm font-semibold text-on-surface" for="password">Password</label>
									<a class="font-label-sm text-xs text-primary font-semibold hover:underline" href="#">Forgot password?</a>
								</div>
								<input class="form-input-custom w-full bg-surface-container-lowest rounded-lg p-3 text-sm text-on-surface border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary" id="password" name="password" type="password" autocomplete="off" required>
							</div>

							<div class="hidden" aria-hidden="true">
								<label for="website">Leave this blank</label>
								<input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
							</div>

							<div class="rounded-lg border border-outline-variant bg-surface-container-low p-3">
								<?php if ($turnstileConfigured): ?>
									<div class="cf-turnstile" data-sitekey="<?= htmlspecialchars(Turnstile::siteKey(), ENT_QUOTES, 'UTF-8') ?>" data-theme="light" data-size="normal" data-appearance="always" data-execution="render" data-action="login"></div>
								<?php else: ?>
									<label class="flex items-start gap-3 text-sm text-on-surface-variant cursor-pointer" for="anti_bot">
										<input id="anti_bot" name="anti_bot" type="checkbox" value="on" class="mt-1 h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary" required>
										<span>
											<strong class="text-on-surface">I am not a robot</strong>
											<span class="mt-1 block text-xs">Local development verification.</span>
										</span>
									</label>
								<?php endif; ?>
							</div>

							<label class="flex items-center gap-2 text-sm text-on-surface-variant">
								<input class="rounded border-outline-variant text-primary focus:ring-primary" name="remember" type="checkbox">
								<span>Remember me</span>
							</label>

							<?php if ($loginError !== ''): ?>
								<div class="rounded-lg border border-error bg-error-container/30 px-3 py-2 text-sm text-on-error-container" role="alert">
									<?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?>
								</div>
							<?php endif; ?>

							<button class="w-full rounded-lg bg-primary text-on-primary px-space-lg py-space-sm font-label-lg text-sm font-bold hover:bg-primary-container transition-colors disabled:opacity-60 disabled:cursor-not-allowed" id="login-submit" type="submit">Sign in securely</button>
						</form>

						<p class="text-center mt-space-lg text-sm text-on-surface-variant">
							<a class="text-primary font-semibold hover:underline" href="index.php">Return to the public portal</a>
						</p>
					</div>
				</section>

				<section id="login-carousel" class="relative min-h-[360px] lg:min-h-0 rounded-lg overflow-hidden shadow-md border border-primary-container bg-primary text-on-primary">
					<img src="<?= $assetBase ?>/images/banners/jimenez.jpg" alt="Jimenez landscape" class="absolute inset-0 w-full h-full object-cover">
					<div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/85 to-primary/45"></div>
					<div class="relative z-10 h-full p-space-lg sm:p-space-xl flex flex-col">
						<div class="flex items-center justify-between gap-space-sm border-b border-white/20 pb-space-sm">
							<span class="inline-flex px-space-sm py-space-xxs rounded bg-secondary-fixed text-on-secondary-fixed font-label-sm text-xs font-bold uppercase tracking-wider">Official Municipal System</span>
							<span data-login-counter class="font-label-sm text-xs text-secondary-fixed font-bold">01 / 04</span>
						</div>

						<div class="relative flex-1 flex items-center py-space-lg">
							<div data-login-slide="0" class="login-slide block opacity-100">
								<p class="font-label-sm text-xs text-secondary-fixed uppercase tracking-wider font-bold">Official Municipal System</p>
								<h2 class="font-display-hero text-2xl sm:text-3xl text-white font-extrabold leading-tight mt-space-sm">Agriculture and fisheries services for Jimenez.</h2>
								<p class="font-body-md text-sm text-surface-variant leading-relaxed mt-space-md max-w-lg">A centralized information system for municipal programs, records, technical assistance, and public service coordination.</p>
							</div>
							<div data-login-slide="1" class="login-slide hidden opacity-0">
								<p class="font-label-sm text-xs text-secondary-fixed uppercase tracking-wider font-bold">Vision</p>
								<h2 class="font-display-hero text-2xl sm:text-3xl text-white font-extrabold leading-tight mt-space-sm">Food security and sufficiency for every community.</h2>
								<p class="font-body-md text-sm text-surface-variant leading-relaxed mt-space-md max-w-lg">Building resilient agricultural and fisheries communities through sustainable, inclusive, and service-driven development.</p>
							</div>
							<div data-login-slide="2" class="login-slide hidden opacity-0">
								<p class="font-label-sm text-xs text-secondary-fixed uppercase tracking-wider font-bold">Mission</p>
								<h2 class="font-display-hero text-2xl sm:text-3xl text-white font-extrabold leading-tight mt-space-sm">Empowering rural communities to prosper.</h2>
								<p class="font-body-md text-sm text-surface-variant leading-relaxed mt-space-md max-w-lg">Supporting farmers, fisherfolk, and rural entrepreneurs through coordinated programs, technical assistance, and responsible public service.</p>
							</div>
							<div data-login-slide="3" class="login-slide hidden opacity-0">
								<p class="font-label-sm text-xs text-secondary-fixed uppercase tracking-wider font-bold">Core Objectives</p>
								<h2 class="font-display-hero text-2xl sm:text-3xl text-white font-extrabold leading-tight mt-space-sm">Serve, protect, and sustain Jimenez.</h2>
								<p class="font-body-md text-sm text-surface-variant leading-relaxed mt-space-md max-w-lg">Improve records and planning, strengthen livelihoods, promote climate resilience, and protect the municipality's natural resources.</p>
							</div>
						</div>

						<div class="flex items-center justify-between gap-space-md border-t border-white/20 pt-space-sm">
							<div class="flex items-center gap-space-xs">
								<button type="button" data-login-prev aria-label="Previous statement" class="w-8 h-8 rounded bg-white/10 hover:bg-white/20 text-white border border-white/20">‹</button>
								<button type="button" data-login-next aria-label="Next statement" class="w-8 h-8 rounded bg-white/10 hover:bg-white/20 text-white border border-white/20">›</button>
							</div>
							<div class="flex items-center gap-space-xs" aria-label="Carousel navigation">
								<button type="button" data-login-dot="0" aria-label="Show official system" class="h-2 w-8 rounded-full bg-secondary-fixed"></button>
								<button type="button" data-login-dot="1" aria-label="Show vision" class="h-2 w-2.5 rounded-full bg-white/40"></button>
								<button type="button" data-login-dot="2" aria-label="Show mission" class="h-2 w-2.5 rounded-full bg-white/40"></button>
								<button type="button" data-login-dot="3" aria-label="Show core objectives" class="h-2 w-2.5 rounded-full bg-white/40"></button>
							</div>
						</div>

						<div class="mt-space-sm">
							<p class="font-label-sm text-xs text-secondary-fixed uppercase tracking-wider font-bold">Office of the Municipal Agriculturist</p>
							<p class="font-body-sm text-xs text-surface-variant mt-1">Municipality of Jimenez, Misamis Occidental</p>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>

	<footer class="border-t border-surface-container bg-surface-container-lowest py-space-md">
		<p class="text-center font-caption text-xs text-on-surface-variant">Municipal Agriculture Office Jimenez · Official Government Information System</p>
	</footer>
</main>

<style>
.login-slide,
.login-slide-enter {
	animation: login-slide-in 220ms ease-out both;
}

@keyframes login-slide-in {
	from {
		opacity: 0;
		transform: translateX(18px);
	}
	to {
		opacity: 1;
		transform: translateX(0);
	}
}

@media (prefers-reduced-motion: reduce) {
	.login-slide {
		animation: none;
	}
}
</style>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
	const carousel = document.getElementById('login-carousel');
	if (!carousel) return;

	const slides = carousel.querySelectorAll('[data-login-slide]');
	const dots = carousel.querySelectorAll('[data-login-dot]');
	const counter = carousel.querySelector('[data-login-counter]');
	let currentIndex = 0;

	function showSlide(index) {
		currentIndex = (index + slides.length) % slides.length;
		slides.forEach((slide, slideIndex) => {
			slide.classList.remove('login-slide-enter');
			slide.classList.toggle('hidden', slideIndex !== currentIndex);
			slide.classList.toggle('block', slideIndex === currentIndex);
			slide.classList.toggle('opacity-0', slideIndex !== currentIndex);
			slide.classList.toggle('opacity-100', slideIndex === currentIndex);
			if (slideIndex === currentIndex) {
				void slide.offsetWidth;
				slide.classList.add('login-slide-enter');
			}
		});
		dots.forEach((dot, dotIndex) => {
			dot.classList.toggle('w-8', dotIndex === currentIndex);
			dot.classList.toggle('w-2.5', dotIndex !== currentIndex);
			dot.classList.toggle('bg-secondary-fixed', dotIndex === currentIndex);
			dot.classList.toggle('bg-white/40', dotIndex !== currentIndex);
		});
		if (counter) counter.textContent = `0${currentIndex + 1} / 0${slides.length}`;
	}

	carousel.querySelector('[data-login-prev]').addEventListener('click', () => showSlide(currentIndex - 1));
	carousel.querySelector('[data-login-next]').addEventListener('click', () => showSlide(currentIndex + 1));
	dots.forEach((dot) => dot.addEventListener('click', () => showSlide(Number(dot.dataset.loginDot))));
	setInterval(() => showSlide(currentIndex + 1), 6000);
});
</script>

</body>
</html>
