/**
 * Layout: Guru Panel
 * Sidebar toggle, date display, and dashboard charts
 */

// Initialize Lucide Icons
initLucideIcons();

// Current Date
const updateDate = () => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const today = new Date();
    const el = document.getElementById('currentDate');
    if (el) el.innerText = today.toLocaleDateString('id-ID', options);
};
updateDate();

// Mobile Sidebar Toggle
const toggleBtn = document.getElementById('toggleMobileSidebar');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');

if (toggleBtn && sidebar && overlay) {
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-hidden');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('sidebar-hidden');
        overlay.classList.add('hidden');
    });
}

// Attendance Chart
const ctxAttendanceEl = document.getElementById('attendanceChart');
if (ctxAttendanceEl) {
    const ctxAttendance = ctxAttendanceEl.getContext('2d');
    const attendanceGradient = ctxAttendance.createLinearGradient(0, 0, 0, 300);
    attendanceGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
    attendanceGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

    new Chart(ctxAttendance, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            datasets: [{
                label: 'Kehadiran (%)',
                data: [98, 95, 99, 94, 96, 92],
                borderColor: '#10b981',
                borderWidth: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                tension: 0.4,
                fill: true,
                backgroundColor: attendanceGradient
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index', intersect: false,
                    backgroundColor: '#1e293b', padding: 12, cornerRadius: 12,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 12 }
                }
            },
            scales: {
                y: {
                    beginAtZero: false, min: 80, max: 100,
                    grid: { borderDash: [5, 5], color: '#e2e8f0' },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                }
            }
        }
    });
}

// Grade Distribution Chart (Doughnut)
const ctxGradeEl = document.getElementById('gradeDistributionChart');
if (ctxGradeEl) {
    const ctxGrade = ctxGradeEl.getContext('2d');
    new Chart(ctxGrade, {
        type: 'doughnut',
        data: {
            labels: ['A (Istimewa)', 'B (Baik)', 'C (Cukup)', 'D (Perlu Bimbingan)'],
            datasets: [{
                data: [12, 16, 3, 1],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#f43f5e'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: { legend: { display: false } }
        }
    });
}
