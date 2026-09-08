<?php
$personnelHeaderTitle = $personnelHeaderTitle ?? 'Personnel Workspace';
$personnelHeaderSubtitle = $personnelHeaderSubtitle ?? 'Municipal Agriculture Office Jimenez';
$userName = $_SESSION['user']['full_name'] ?? 'Personnel user';
?>
<header class="relative z-[60] bg-primary text-on-primary border-b-4 border-secondary-fixed">
    <div class="personnel-header-inner relative min-h-[96px] px-16 sm:px-20 lg:px-gutter-desktop py-4 flex items-center justify-center text-center">
        <div class="min-w-0 max-w-full">
            <p class="text-xs uppercase tracking-wider text-secondary-fixed font-bold">Personnel workspace</p>
            <h1 class="text-xl sm:text-2xl font-extrabold mt-1 truncate"><?= htmlspecialchars($personnelHeaderTitle, ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="text-xs sm:text-sm text-surface-variant mt-1 truncate"><?= htmlspecialchars($personnelHeaderSubtitle, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <button id="personnel-nav-reopen" type="button" class="hidden inline-flex items-center justify-center rounded-lg border border-outline-variant p-2 text-on-primary hover:bg-white/10" aria-label="Show personnel navigation" aria-controls="personnel-sidebar" aria-expanded="false">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="personnel-header-actions absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 flex items-center gap-3 shrink-0">
            <span class="hidden sm:block text-xs text-surface-variant"><?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></span>
            <a class="inline-flex items-center gap-2 rounded-lg bg-secondary-fixed text-on-secondary-fixed px-3 py-2 font-bold text-xs sm:text-sm hover:bg-secondary-fixed-dim" href="logout.php">
                <span class="material-symbols-outlined text-base">logout</span> Sign out
            </a>
        </div>
    </div>
</header>
<style>
.personnel-header-inner > div:first-child {
    width: 100%;
}
@media (max-width: 639px) {
    .personnel-header-inner > div:first-child {
        max-width: calc(100% - 8rem);
    }
    .personnel-header-actions > span {
        display: none;
    }
}
@media (min-width: 640px) and (max-width: 1023px) {
    .personnel-header-inner > div:first-child {
        max-width: calc(100% - 12rem);
    }
}
@media (min-width: 1024px) {
    .personnel-header-inner > div:first-child {
        max-width: calc(100% - 28rem);
    }
}
</style>
