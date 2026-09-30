document.addEventListener('DOMContentLoaded', () => {
    const page = document.querySelector('[data-fishery-page]');
    if (!page) return;

    window.fisheryRegistryIds = JSON.parse(page.dataset.fisheryRegistryIds || '[]');
    window.fisheryApplication = JSON.parse(page.dataset.fisheryApplication || '{}');
    window.fisheryPrintRequested = page.dataset.fisheryPrintRequested === 'true';
});
