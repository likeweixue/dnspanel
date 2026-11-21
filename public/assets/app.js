document.documentElement.classList.add('js');

const openButton = document.querySelector('[data-sidebar-open]');
const closeButton = document.querySelector('[data-sidebar-close]');

function closeSidebar() {
    document.body.classList.remove('sidebar-open');
}

if (openButton) {
    openButton.addEventListener('click', () => document.body.classList.add('sidebar-open'));
}
if (closeButton) {
    closeButton.addEventListener('click', closeSidebar);
}
document.querySelectorAll('.sidebar-nav a').forEach((link) => link.addEventListener('click', closeSidebar));
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeSidebar();
});

document.addEventListener('submit', (event) => {
    const form = event.target;
    const message = form.dataset.confirm || event.submitter?.dataset.confirmClick;
    if (message && !window.confirm(message)) {
        event.preventDefault();
    }
});

document.querySelectorAll('.locale-select').forEach((select) => {
    select.addEventListener('change', () => {
        if (select.form) select.form.requestSubmit();
    });
});

const domainSelect = document.querySelector('[data-domain-select]');
const hostnameInput = document.querySelector('[data-hostname-input]');
const hostnamePreview = document.querySelector('[data-hostname-preview]');

function updateHostnamePreview() {
    if (!domainSelect || !hostnameInput || !hostnamePreview) return;
    const suffix = domainSelect.selectedOptions[0]?.dataset.suffix || '';
    const hostname = hostnameInput.value.trim().toLowerCase() || 'beta';
    hostnamePreview.textContent = suffix ? `${hostname}.${suffix}` : hostname;
}

if (domainSelect) domainSelect.addEventListener('change', updateHostnamePreview);
if (hostnameInput) hostnameInput.addEventListener('input', updateHostnamePreview);

const recordType = document.querySelector('[data-record-type]');
const recordHint = document.querySelector('[data-record-hint]');
if (recordType && recordHint) {
    recordType.addEventListener('change', () => {
        recordHint.textContent = recordType.selectedOptions[0]?.dataset.hint || '';
    });
}
