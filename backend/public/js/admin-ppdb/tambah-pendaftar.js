/**
 * Admin PPDB: Tambah Pendaftar
 * File name display and image preview
 */

function updateFileName(input, labelId) {
    var label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        label.innerText = input.files[0].name;
        label.classList.remove('text-white/40');
        label.classList.add('text-emerald-400', 'font-bold');
    }
}

function previewImage(input, type) {
    var preview = document.getElementById('preview-' + type);
    var container = document.getElementById('preview-container-' + type);
    var placeholder = document.getElementById('placeholder-' + type);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
