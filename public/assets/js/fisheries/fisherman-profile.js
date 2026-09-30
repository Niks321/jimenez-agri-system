document.addEventListener('click', (event) => {
    const openButton = event.target.closest('[data-fisherman-details-open]');
    if (openButton) {
        const dialog = document.getElementById(openButton.dataset.fishermanDetailsOpen);
        if (dialog instanceof HTMLDialogElement) dialog.showModal();
        return;
    }

    const closeButton = event.target.closest('[data-fisherman-details-close]');
    if (closeButton) {
        closeButton.closest('dialog')?.close();
        return;
    }

    if (event.target instanceof HTMLDialogElement && event.target.classList.contains('fishery-details-dialog')) {
        const bounds = event.target.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom) {
            event.target.close();
        }
    }
});