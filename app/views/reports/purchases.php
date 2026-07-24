<?php
$page_title = 'Purchase Report';
$dailyLabels = json_encode(array_column($daily ?? [], 'date'));
$dailyTotals = json_encode(array_map('floatval', array_column($daily ?? [], 'total')));
$monthlyLabels = json_encode(array_column($monthly ?? [], 'month'));
$monthlyTotals = json_encode(array_map('floatval', array_column($monthly ?? [], 'total')));
$hasDaily = $dailyLabels !== '[]';
$hasMonthly = $monthlyLabels !== '[]';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Purchase Report</h4>
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
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="daily">
                <canvas id="dailyPurchaseChart" height="300"></canvas>
            </div>
            <div class="tab-pane fade" id="monthly">
                <canvas id="monthlyPurchaseChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<?php if ($hasDaily || $hasMonthly): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($hasDaily): ?>
    new Chart(document.getElementById('dailyPurchaseChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?= $dailyLabels ?>,
            datasets: [{
                label: 'Daily Purchases',
                data: <?= $dailyTotals ?>,
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
    <?php endif; ?>
    <?php if ($hasMonthly): ?>
    var monthlyTab = document.querySelector('button[data-bs-target="#monthly"]');
    if (monthlyTab) {
        monthlyTab.addEventListener('shown.bs.tab', function() {
            var canvas = document.getElementById('monthlyPurchaseChart');
            if (canvas && !canvas._chart) {
                canvas._chart = new Chart(canvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: <?= $monthlyLabels ?>,
                        datasets: [{
                            label: 'Monthly Purchases',
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
});
</script>
<?php endif; ?>
