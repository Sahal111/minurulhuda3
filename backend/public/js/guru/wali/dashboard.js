/**
 * Guru Wali: Dashboard
 * Class performance chart
 */

var ctxEl = document.getElementById('classPerformanceChart');
if (ctxEl) {
    var ctx = ctxEl.getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
    gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Rata-rata Kelas', data: [78, 82, 80, 85, 88, 92],
                borderColor: '#10b981', borderWidth: 6, tension: 0.4,
                fill: true, backgroundColor: gradient,
                pointRadius: 0, pointHoverRadius: 8,
                pointHoverBackgroundColor: '#10b981', pointHoverBorderColor: '#fff', pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: false },
                x: { grid: { display: false }, border: { display: false }, ticks: { font: { weight: 'bold' } } }
            }
        }
    });
}
