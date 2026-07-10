/**
 * Shared Utility Functions
 * MI Nurul Huda 3 - School Management System
 * 
 * File ini berisi fungsi-fungsi umum yang dipakai di banyak halaman.
 * Harus di-load sebelum file JS page-specific.
 */

// =============================================
// LUCIDE ICONS INIT
// =============================================
function initLucideIcons() {
    if (typeof lucide !== 'undefined' && lucide.createIcons) {
        lucide.createIcons();
    }
}

// =============================================
// TOAST NOTIFICATION
// =============================================
function showToast(message, type) {
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toastMsg');

    if (!toast || !toastMsg) return;

    toastMsg.innerText = message;
    toast.classList.remove('hidden');

    // Auto-hide after 3 seconds
    clearTimeout(window._toastTimer);
    window._toastTimer = setTimeout(() => toast.classList.add('hidden'), 3000);
}

// =============================================
// MODAL OPEN / CLOSE (Generic)
// =============================================
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    initLucideIcons();
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

// =============================================
// TABLE FILTER (Generic)
// =============================================
function filterTable(type) {
    const input = document.getElementById('search-' + type);
    const tableBody = document.getElementById('table-' + type);

    if (!input || !tableBody) return;

    const filter = input.value.toLowerCase();
    tableBody.querySelectorAll('tr').forEach((row) => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
}

// =============================================
// DOM READY HELPER
// =============================================
function onReady(fn) {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}

// =============================================
// ESC KEY MODAL CLOSE
// =============================================
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        // Close any visible modal
        document.querySelectorAll('.fixed[id*="modal"], .fixed[id*="Modal"]').forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
        document.body.style.overflow = '';
    }
});

// Auto-init lucide icons on DOMContentLoaded
onReady(function () {
    initLucideIcons();
});
