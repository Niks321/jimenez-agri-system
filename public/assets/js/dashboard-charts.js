document.addEventListener('DOMContentLoaded', () => {
    const dashboard = document.querySelector('[data-dashboard-analytics]');
    if (!dashboard || typeof Chart === 'undefined') return;

    const analytics = JSON.parse(dashboard.dataset.dashboardAnalytics || '{}');
    const palette = ['#0b6b3a', '#d6e85c', '#e4772e', '#2f7f92', '#8d5a97', '#b44d5e', '#5b7c45', '#c49a38'];
    const chartDefaults = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true, grid: { color: '#e3e9e2' } }
        }
    };
    const labels = (rows = []) => rows.map((row) => row.label);
    const values = (rows = []) => rows.map((row) => Number(row.value));
    const chart = (id, config) => {
        const canvas = document.getElementById(id);
        if (canvas) new Chart(canvas, config);
    };

    chart('price-trend-chart', {
        type: 'line',
        data: { labels: labels(analytics.priceTrend), datasets: [{ data: values(analytics.priceTrend), borderColor: '#0b6b3a', backgroundColor: 'rgba(11,107,58,.14)', fill: true, tension: .35, pointRadius: 3 }] },
        options: chartDefaults
    });
    chart('catch-trend-chart', {
        type: 'bar',
        data: { labels: labels(analytics.catchTrend), datasets: [{ data: values(analytics.catchTrend), backgroundColor: '#2f7f92', borderRadius: 5 }] },
        options: chartDefaults
    });
    chart('livestock-chart', {
        type: 'doughnut',
        data: { labels: labels(analytics.livestockBySpecies), datasets: [{ data: values(analytics.livestockBySpecies), backgroundColor: palette, borderWidth: 2, borderColor: '#fff' }] },
        options: { ...chartDefaults, cutout: '62%', scales: {} }
    });
    chart('farmers-chart', {
        type: 'bar',
        data: { labels: labels(analytics.farmersByBarangay), datasets: [{ data: values(analytics.farmersByBarangay), backgroundColor: '#e4772e', borderRadius: 5 }] },
        options: { ...chartDefaults, indexAxis: 'y' }
    });
});
