/**
 * Admin PPDB: Verifikasi Detail
 * Lightbox for document images, note adding
 */

function openLightbox(src) {
    var lightbox = document.getElementById('lightbox');
    var img = document.getElementById('lightbox-img');
    if (!lightbox || !img) return;
    img.src = src;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
}

function closeLightbox() {
    var lightbox = document.getElementById('lightbox');
    if (!lightbox) return;
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
}

function addNote(text) {
    var textarea = document.querySelector('textarea');
    if (textarea) textarea.value = text;
}
