/**
 * Guru Wali: Rekap Nilai
 * Top student bar chart and grade distribution doughnut
 */

// Top 5 Bar Chart
var barCtxEl = document.getElementById('topStudentChart');
if (barCtxEl) {
    new Chart(barCtxEl.getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Rafli', 'Zahra', 'Budi', 'Siti', 'Fajar'],
            datasets: [{ label: 'Nilai Akhir', data: [98, 96, 94, 92, 91], backgroundColor: '#10b981', borderRadius: 12, barThickness: 30 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { display: false }, border: { display: false }, ticks: { display: false } },
                x: { grid: { display: false }, border: { display: false }, ticks: { font: { weight: 'bold', size: 10 } } }
            }
        }
    });
}

// Grade Distribution Pie Chart
var pieCtxEl = document.getElementById('gradeDistChart');
if (pieCtxEl) {
    new Chart(pieCtxEl.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'],
            datasets: [{ data: [15, 12, 3, 2], backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#f43f5e'], borderWidth: 0 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '75%',
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, font: { size: 10, weight: 'bold' } } } }
        }
    });
}
