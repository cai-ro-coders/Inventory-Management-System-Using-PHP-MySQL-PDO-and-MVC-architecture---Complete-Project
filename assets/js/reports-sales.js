$(document).ready(function() {
    var data = window.salesChartData;
    var charts = {};

    function createChart(id, label, color, bgColor) {
        var el = document.getElementById(id);
        if (!el) return null;
        return new Chart(el.getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.daily.labels,
                datasets: [{
                    label: label,
                    data: data.daily.totals,
                    backgroundColor: bgColor,
                    borderColor: color,
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
            }
        });
    }

    if (data.daily.labels.length) {
        charts.daily = new Chart(document.getElementById('dailySalesChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.daily.labels,
                datasets: [{
                    label: 'Daily Sales',
                    data: data.daily.totals,
                    backgroundColor: 'rgba(102, 126, 234, 0.7)',
                    borderColor: '#667eea',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
            }
        });
    }

    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr('data-bs-target');

        if (target === '#monthly' && !charts.monthly && data.monthly.labels.length) {
            charts.monthly = new Chart(document.getElementById('monthlySalesChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: data.monthly.labels,
                    datasets: [{
                        label: 'Monthly Sales',
                        data: data.monthly.totals,
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
                }
            });
        }

        if (target === '#yearly' && !charts.yearly && data.yearly.labels.length) {
            charts.yearly = new Chart(document.getElementById('yearlySalesChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: data.yearly.labels,
                    datasets: [{
                        label: 'Yearly Sales',
                        data: data.yearly.totals,
                        backgroundColor: 'rgba(245, 158, 11, 0.7)',
                        borderColor: '#f59e0b',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
                }
            });
        }
    });
});
