/**
 * Guru: Penilaian
 * Score validation, save with loading & toast
 */

function validateScore(input) {
    if (input.value > 100) {
        input.classList.add('border-red-500', 'bg-red-50', 'text-red-600');
    } else {
        input.classList.remove('border-red-500', 'bg-red-50', 'text-red-600');
    }
}

function saveGrades() {
    var btn = document.getElementById('btnSave');
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
        toast.classList.remove('-translate-y-24', 'opacity-0');
        setTimeout(function () { toast.classList.add('-translate-y-24', 'opacity-0'); }, 3000);
    }, 1500);
}
