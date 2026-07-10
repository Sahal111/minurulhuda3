/**
 * Layout: Bendahara Panel
 * Sidebar toggle, dark mode, modal, toast, charts
 */

// Lucide Icons Init
initLucideIcons();

// Sidebar Toggle
const sidebarBendahara = document.getElementById('sidebar');
const toggleBtnBendahara = document.getElementById('toggleSidebar');
if (toggleBtnBendahara && sidebarBendahara) {
    toggleBtnBendahara.addEventListener('click', () => {
        sidebarBendahara.classList.toggle('-translate-x-full');
    });
}

// Dark Mode
const darkModeToggle = document.getElementById('darkModeToggle');
const moonIcon = document.getElementById('moonIcon');
if (darkModeToggle && moonIcon) {
    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        const isDark = document.documentElement.classList.contains('dark');
        moonIcon.setAttribute('data-lucide', isDark ? 'sun' : 'moon');
        initLucideIcons();
    });
}

// Modal Logic
const modalOverlay = document.getElementById('modalOverlay');
if (modalOverlay) {
    const modalContentDiv = modalOverlay.querySelector('div');

    window.openModalBendahara = function () {
        modalOverlay.classList.remove('opacity-0', 'pointer-events-none');
        if (modalContentDiv) modalContentDiv.classList.remove('scale-95');
    };

    window.closeModalBendahara = function () {
        modalOverlay.classList.add('opacity-0', 'pointer-events-none');
        if (modalContentDiv) modalContentDiv.classList.add('scale-95');
    };

    // Keep backward-compatible global names
    window.openModal = window.openModalBendahara;
    window.closeModal = window.closeModalBendahara;
}

// Handle Save with Loading State
window.handleSave = function () {
    const btn = document.getElementById('saveBtn');
    if (!btn) return;
    const originalContent = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;

    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = originalContent;
        if (window.closeModal) window.closeModal();
        showToast('Transaksi berhasil ditambahkan!');
    }, 1500);
};

// Toast (bendahara version using translate animation)
window.showToastBendahara = function (msg) {
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toastMsg');
    if (!toast || !toastMsg) return;
    toastMsg.innerText = msg;
    toast.classList.remove('translate-y-20', 'opacity-0');
    setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
    }, 3000);
};

// Charts Configuration
window.onload = function () {
    // Main Chart (Income vs Expense)
    const ctxMainEl = document.getElementById('mainChart');
    if (ctxMainEl) {
        const ctxMain = ctxMainEl.getContext('2d');
        new Chart(ctxMain, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: [35, 45, 40, 50, 48, 55],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Pengeluaran',
                        data: [15, 12, 18, 20, 15, 18],
                        borderColor: '#ef4444',
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Pie Chart (Revenue Sources)
    const ctxPieEl = document.getElementById('pieChart');
    if (ctxPieEl) {
        const ctxPie = ctxPieEl.getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['SPP', 'Donasi', 'Pendaftaran', 'Lainnya'],
                datasets: [{
                    data: [70, 15, 10, 5],
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#6366f1'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, boxWidth: 6, font: { size: 10 } }
                    }
                }
            }
        });
    }
};
