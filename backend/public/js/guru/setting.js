/**
 * Guru: Setting
 * Confirm modal and save handler
 */

var settingModal = null;
onReady(function () {
    settingModal = document.getElementById('modalConfirm');
});

function openModal() {
    if (settingModal) {
        settingModal.classList.remove('hidden');
        settingModal.classList.add('flex');
    }
}

function closeModal() {
    if (settingModal) {
        settingModal.classList.add('hidden');
        settingModal.classList.remove('flex');
    }
}

function handleSave() {
    closeModal();
    alert('Data berhasil diperbarui!');
}
