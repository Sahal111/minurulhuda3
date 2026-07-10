/**
 * Admin PPDB: Konversi
 * Confirm modal with animation
 */

function openModalKonversi(nama, id) {
    var modal = document.getElementById('modal-confirm');
    var card = document.getElementById('card-confirm');
    if (!modal || !card) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(function () {
        card.classList.remove('scale-95', 'opacity-0');
        card.classList.add('scale-100', 'opacity-100');
    }, 10);
}
// Keep backward-compatible name
window.openModal = openModalKonversi;

function closeModalKonversi() {
    var modal = document.getElementById('modal-confirm');
    var card = document.getElementById('card-confirm');
    if (!modal || !card) return;
    card.classList.remove('scale-100', 'opacity-100');
    card.classList.add('scale-95', 'opacity-0');
    setTimeout(function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}
window.closeModal = closeModalKonversi;

onReady(function () { initLucideIcons(); });
window.confirmConversion = openModalKonversi;
