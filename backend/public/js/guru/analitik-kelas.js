/**
 * Guru: Analitik Kelas
 * Chart.js line, doughnut, and bar charts
 */

Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
Chart.defaults.color = '#94a3b8';

// 1. Line Chart: Perkembangan Nilai
var ctxLineEl = document.getElementById('lineChartPerkembangan');
if (ctxLineEl) {
    var ctxLine = ctxLineEl.getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Rata-rata Nilai', data: [72, 78, 75, 85, 82, 88],
                borderColor: '#6366f1', borderWidth: 4, fill: true,
                backgroundColor: function (context) {
                    var gradient = context.chart.ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.1)');
                    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');
                    return gradient;
                },
                tension: 0.4, pointRadius: 0, pointHoverRadius: 6,
                pointHoverBackgroundColor: '#6366f1', pointHoverBorderColor: '#fff', pointHoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: false, grid: { display: false }, border: { display: false } },
                x: { grid: { display: false }, border: { display: false } }
            }
        }
    });
}

// 2. Pie Chart: Distribusi Nilai
var ctxPieEl2 = document.getElementById('pieChartDistribusi');
if (ctxPieEl2) {
    new Chart(ctxPieEl2.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Sangat Baik', 'Cukup', 'Remedial'],
            datasets: [{ data: [65, 25, 10], backgroundColor: ['#10b981', '#6366f1', '#f43f5e'], borderWidth: 0, hoverOffset: 20 }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '80%', plugins: { legend: { display: false } } }
    });
}

// 3. Bar Chart: Kehadiran
var ctxBarEl = document.getElementById('barChartKehadiran');
if (ctxBarEl) {
    new Chart(ctxBarEl.getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                { label: 'Hadir', data: [95, 98, 92, 96, 94, 97], backgroundColor: '#6366f1', borderRadius: 12, barThickness: 25 },
                { label: 'Izin/Sakit', data: [5, 2, 8, 4, 6, 3], backgroundColor: '#e2e8f0', borderRadius: 12, barThickness: 25 }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { stacked: true, grid: { color: '#f1f5f9' }, border: { display: false } },
                x: { stacked: true, grid: { display: false }, border: { display: false } }
            }
        }
    });
}
