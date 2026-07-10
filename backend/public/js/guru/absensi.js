/**
 * Guru: Absensi
 * Row highlight, save with loading & toast
 */

onReady(function () {
    var rows = document.querySelectorAll('.attendance-row');
    rows.forEach(function (row) {
        row.addEventListener('change', function () {
            row.classList.add('bg-emerald-50/50');
            setTimeout(function () { row.classList.remove('bg-emerald-50/50'); }, 1000);
        });
    });
});

function simpanAbsensi() {
    var btn = document.getElementById('btnSimpan');
    var text = document.getElementById('btnText');
    var loading = document.getElementById('loadingState');
    var toast = document.getElementById('toastSuccess');

    text.classList.add('opacity-0');
    loading.classList.remove('hidden');
    btn.disabled = true;

    setTimeout(function () {
        text.classList.remove('opacity-0');
        loading.classList.add('hidden');
        btn.disabled = false;
        toast.classList.remove('translate-y-24', 'opacity-0');
        setTimeout(function () { closeToastAbsensi(); }, 4000);
    }, 2000);
}

function closeToastAbsensi() {
    var toast = document.getElementById('toastSuccess');
    toast.classList.add('translate-y-24', 'opacity-0');
}
// Keep backward-compatible name
window.closeToast = closeToastAbsensi;
