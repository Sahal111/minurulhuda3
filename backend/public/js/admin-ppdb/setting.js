/**
 * Admin PPDB: Setting
 * Tab switching logic
 */

function switchTabPpdb(tabId) {
    document.querySelectorAll('.tab-content').forEach(function (content) {
        content.classList.add('hidden');
    });
    document.getElementById('tab-' + tabId).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(function (btn) {
        btn.classList.remove('active', 'text-slate-900');
        btn.classList.add('text-slate-400');
    });

    var activeBtn = document.getElementById('btn-' + tabId);
    if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.classList.remove('text-slate-400');
    }
}
// Keep backward-compatible name
window.switchTab = switchTabPpdb;

onReady(function () { initLucideIcons(); });
