$(document).ready(function() {
    // Sales & Purchases Chart
    var ctx1 = document.getElementById('salesPurchaseChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Sales',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                fill: true,
                tension: 0.4
            }, {
                label: 'Purchases',
                data: [8000, 12000, 10000, 18000, 15000, 20000, 16000],
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
        }
    });

    // Revenue vs Expenses
    var ctx2 = document.getElementById('revenueExpenseChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Revenue', 'Expenses'],
            datasets: [{
                data: [85000, 35000],
                backgroundColor: ['#667eea', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Inventory Distribution
    var ctx3 = document.getElementById('inventoryChart').getContext('2d');
    new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Main Warehouse', 'Secondary WH', 'North Dist'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#667eea', '#10b981', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Top Selling Products
    var ctx4 = document.getElementById('topProductsChart').getContext('2d');
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
            datasets: [{
                label: 'Units Sold',
                data: [120, 90, 80, 65, 50],
                backgroundColor: ['#667eea', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
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

    // Category-wise Products Chart
    var ctx5 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx5, {
        type: 'polarArea',
        data: {
            labels: ['Electronics', 'Clothing', 'Food', 'Office', 'Health'],
            datasets: [{
                data: [15, 12, 8, 10, 5],
                backgroundColor: ['rgba(102,126,234,0.7)', 'rgba(16,185,129,0.7)', 'rgba(245,158,11,0.7)', 'rgba(239,68,68,0.7)', 'rgba(139,92,246,0.7)']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});
