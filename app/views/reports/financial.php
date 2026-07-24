<?php
$page_title = 'Financial Report';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Financial Report</h4>
    <a href="<?= APP_URL ?>/reports" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Reports</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card border-start border-success border-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Revenue</h6>
                <h3 class="fw-bold mb-0 text-success"><?= Helper::formatMoney($totalRevenue ?? 0) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card border-start border-danger border-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Expenses</h6>
                <h3 class="fw-bold mb-0 text-danger"><?= Helper::formatMoney($totalExpenses ?? 0) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card border-start border-primary border-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Net Profit</h6>
                <h3 class="fw-bold mb-0 text-<?= ($netProfit ?? 0) >= 0 ? 'primary' : 'danger' ?>"><?= Helper::formatMoney($netProfit ?? 0) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card border-start border-info border-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Profit Margin</h6>
                <h3 class="fw-bold mb-0 text-info"><?= number_format($profitMargin ?? 0, 1) ?>%</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0">Revenue vs Expenses (Monthly)</h6>
                <form method="GET" class="d-inline">
                    <select name="year" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                        <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                        <option value="<?= $y ?>" <?= ($selectedYear ?? date('Y')) == $y ? 'selected' : '' ?>><?= $y ?></option>
                        <?php endfor; ?>
                    </select>
                </form>
            </div>
            <div class="card-body">
                <canvas id="financialChart" height="320"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Expense Breakdown</h6>
            </div>
            <div class="card-body">
                <canvas id="expensePieChart" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="fw-bold mb-0">Monthly Summary</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Revenue</th>
                        <th>Expenses</th>
                        <th>Profit</th>
                        <th>Margin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($monthlySummary ?? [] as $row): ?>
                    <tr>
                        <td class="fw-medium"><?= $row->month ?></td>
                        <td class="text-success"><?= Helper::formatMoney($row->revenue) ?></td>
                        <td class="text-danger"><?= Helper::formatMoney($row->expenses) ?></td>
                        <td class="text-<?= ($row->revenue - $row->expenses) >= 0 ? 'primary' : 'danger' ?>"><?= Helper::formatMoney($row->revenue - $row->expenses) ?></td>
                        <td><?= $row->revenue > 0 ? number_format(($row->revenue - $row->expenses) / $row->revenue * 100, 1) : 0 ?>%</td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$chartLabels = json_encode(array_column($monthlySummary ?? [], 'month'));
$chartRevenue = json_encode(array_map('floatval', array_column($monthlySummary ?? [], 'revenue')));
$chartExpenses = json_encode(array_map('floatval', array_column($monthlySummary ?? [], 'expenses')));
$pieLabels = json_encode(array_column($expenseBreakdown ?? [], 'name'));
$pieData = json_encode(array_map('floatval', array_column($expenseBreakdown ?? [], 'total')));
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx1 = document.getElementById('financialChart');
    if (ctx1) {
        new Chart(ctx1.getContext('2d'), {
            type: 'bar',
            data: {
                labels: <?= $chartLabels ?>,
                datasets: [
                    {
                        label: 'Revenue',
                        data: <?= $chartRevenue ?>,
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        borderRadius: 5
                    },
                    {
                        label: 'Expenses',
                        data: <?= $chartExpenses ?>,
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: '#ef4444',
                        borderWidth: 1,
                        borderRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
            }
        });
    }

    var ctx2 = document.getElementById('expensePieChart');
    if (ctx2) {
        new Chart(ctx2.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?= $pieLabels ?>,
                datasets: [{
                    data: <?= $pieData ?>,
                    backgroundColor: ['rgba(102,126,234,0.7)', 'rgba(16,185,129,0.7)', 'rgba(245,158,11,0.7)', 'rgba(239,68,68,0.7)', 'rgba(139,92,246,0.7)', 'rgba(236,72,153,0.7)', 'rgba(14,165,233,0.7)', 'rgba(168,85,247,0.7)', 'rgba(249,115,22,0.7)', 'rgba(34,211,238,0.7)'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }
});
</script>
