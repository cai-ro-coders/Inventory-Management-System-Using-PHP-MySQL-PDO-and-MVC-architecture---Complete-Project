<?php
$page_title = 'Sales Report';
$dailyLabels = json_encode(array_column($daily ?? [], 'date'));
$dailyTotals = json_encode(array_map('floatval', array_column($daily ?? [], 'total')));
$monthlyLabels = json_encode(array_column($monthly ?? [], 'month'));
$monthlyTotals = json_encode(array_map('floatval', array_column($monthly ?? [], 'total')));
$yearlyLabels = json_encode(array_column($yearly ?? [], 'year'));
$yearlyTotals = json_encode(array_map('floatval', array_column($yearly ?? [], 'total')));
$hasDaily = $dailyLabels !== '[]';
$hasMonthly = $monthlyLabels !== '[]';
$hasYearly = $yearlyLabels !== '[]';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Sales Report</h4>
    <a href="<?= APP_URL ?>/reports" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Reports</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <ul class="nav nav-tabs card-header-tabs nav-justified" id="reportTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily" type="button">Daily</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button">Monthly</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly" type="button">Yearly</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="daily">
                <canvas id="dailySalesChart" height="300"></canvas>
            </div>

            <div class="tab-pane fade" id="monthly">
                <canvas id="monthlySalesChart" height="300"></canvas>
            </div>

            <div class="tab-pane fade" id="yearly">
                <canvas id="yearlySalesChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<?php if ($hasDaily || $hasMonthly || $hasYearly): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($hasDaily): ?>
    new Chart(document.getElementById('dailySalesChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?= $dailyLabels ?>,
            datasets: [{
                label: 'Daily Sales',
                data: <?= $dailyTotals ?>,
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
    <?php endif; ?>
    <?php if ($hasMonthly): ?>
    var monthlyTab = document.querySelector('button[data-bs-target="#monthly"]');
    if (monthlyTab) {
        monthlyTab.addEventListener('shown.bs.tab', function() {
            var canvas = document.getElementById('monthlySalesChart');
            if (canvas && !canvas._chart) {
                canvas._chart = new Chart(canvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: <?= $monthlyLabels ?>,
                        datasets: [{
                            label: 'Monthly Sales',
                            data: <?= $monthlyTotals ?>,
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
        });
    }
    <?php endif; ?>
    <?php if ($hasYearly): ?>
    var yearlyTab = document.querySelector('button[data-bs-target="#yearly"]');
    if (yearlyTab) {
        yearlyTab.addEventListener('shown.bs.tab', function() {
            var canvas = document.getElementById('yearlySalesChart');
            if (canvas && !canvas._chart) {
                canvas._chart = new Chart(canvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: <?= $yearlyLabels ?>,
                        datasets: [{
                            label: 'Yearly Sales',
                            data: <?= $yearlyTotals ?>,
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
    }
    <?php endif; ?>
});
</script>
<?php endif; ?>
