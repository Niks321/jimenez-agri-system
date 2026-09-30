document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.fishery-application .reference-form');
    if (!form) return;

    const application = window.fisheryApplication || {};
    const values = {
        ...application,
        applicant_first_name: application.applicant_first_name ?? application.first_name,
        applicant_last_name: application.applicant_last_name ?? application.last_name,
        applicant_middle_name: application.applicant_middle_name ?? application.middle_name,
    };

    Object.entries(values).forEach(([name, value]) => {
        const field = form.elements.namedItem(name);
        if (!field || field.type === 'hidden' || value === null || value === undefined || value === '') return;
        field.value = String(value).slice(0, 10) === '0000-00-00' ? '' : value;
    });

    if (window.fisheryPrintRequested) {
        window.setTimeout(() => window.print(), 200);
    }
});