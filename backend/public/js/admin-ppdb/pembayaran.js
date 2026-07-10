/**
 * Admin PPDB: Pembayaran
 * Payment verification modal
 */

function openModalPembayaran(name, id, type, nominal, date, img) {
    var modal = document.getElementById('modal-verification');
    var card = document.getElementById('modal-card');
    if (!modal || !card) return;

    document.getElementById('m-name').innerText = name;
    document.getElementById('m-id').innerText = 'ID REG: ' + id;
    document.getElementById('m-type').innerText = type;
    document.getElementById('m-nominal').innerText = nominal;
    document.getElementById('m-date').innerText = date;
    document.getElementById('m-img').src = img;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(function () {
        card.classList.remove('scale-95', 'opacity-0');
        card.classList.add('scale-100', 'opacity-100');
    }, 10);
}
window.openModal = openModalPembayaran;

function closeModalPembayaran() {
    var modal = document.getElementById('modal-verification');
    var card = document.getElementById('modal-card');
    if (!modal || !card) return;
    card.classList.remove('scale-100', 'opacity-100');
    card.classList.add('scale-95', 'opacity-0');
    setTimeout(function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}
window.closeModal = closeModalPembayaran;

onReady(function () { initLucideIcons(); });
