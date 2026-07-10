/**
 * Admin PPDB: Upload Import
 * File upload with progress bar and validation logs
 */

var ppdbFileInput = document.getElementById('file-input');
var statusBox = document.getElementById('upload-status');
var ppdbProgressBar = document.getElementById('progress-bar');
var percentText = document.getElementById('percent-text');
var resultsTable = document.getElementById('results-table');
var logContainer = document.getElementById('validation-log');

if (ppdbFileInput) {
    ppdbFileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            statusBox.classList.remove('hidden');
            var progress = 0;

            logContainer.innerHTML = '<div class="flex gap-4 animate-pulse"><div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0"><i data-lucide="search" class="w-4 h-4 text-emerald-600"></i></div><p class="text-xs font-bold text-slate-600 italic mt-1 leading-relaxed">Membaca struktur Excel...</p></div>';
            initLucideIcons();

            var timer = setInterval(function () {
                progress += 2;
                ppdbProgressBar.style.width = progress + '%';
                percentText.innerText = progress + '%';

                if (progress === 40) {
                    logContainer.insertAdjacentHTML('afterbegin', '<div class="flex gap-4 mb-4"><div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0"><i data-lucide="check" class="w-4 h-4 text-blue-600"></i></div><p class="text-xs font-bold text-slate-600 italic mt-1 leading-relaxed">Header kolom terverifikasi (18 Kolom).</p></div>');
                    initLucideIcons();
                }

                if (progress >= 100) {
                    clearInterval(timer);
                    setTimeout(function () {
                        resultsTable.classList.remove('hidden');
                        resultsTable.classList.add('opacity-100', 'translate-y-0');
                        document.getElementById('stat-total').innerText = '154';
                        document.getElementById('stat-valid').innerText = '148';
                    }, 500);
                }
            }, 30);
        }
    });
}
