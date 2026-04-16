/**
 * Sales Reports & Charts Logic
 */
export function initReports() {
    const canvas = document.getElementById('reportChart');
    if (!canvas) return;

    if (typeof Chart === 'undefined') {
        console.warn('Chart.js library is required for reports.');
        return;
    }

    const ctx = canvas.getContext('2d');
    
    // Retrieve data from data-attributes (populated by PHP in the Blade view)
    const labels = JSON.parse(canvas.getAttribute('data-labels') || '[]');
    const dataValues = JSON.parse(canvas.getAttribute('data-values') || '[]');

    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(249, 115, 22, 0.4)');
    gradient.addColorStop(1, 'rgba(249, 115, 22, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventas',
                data: dataValues,
                borderColor: '#f97316',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#ea580c',
                pointBorderWidth: 2,
                pointRadius: 4,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111827',
                    padding: 12,
                    callbacks: {
                        label: function(context) { return ' S/ ' + context.parsed.y.toFixed(2); }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#9ca3af', font: { size: 10, weight: '600' } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(156, 163, 175, 0.1)', borderDash: [5, 5] },
                    ticks: { color: '#9ca3af', font: { size: 10 } }
                }
            }
        }
    });
}
