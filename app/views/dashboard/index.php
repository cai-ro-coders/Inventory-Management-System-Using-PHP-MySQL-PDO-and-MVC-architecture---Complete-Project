<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Dashboard</h4>
    <div>
        <span class="text-muted"><?= date('F d, Y') ?></span>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Products</h6>
                        <h3 class="fw-bold mb-0"><?= $totalProducts ?></h3>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary rounded-3 p-3">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Categories</h6>
                        <h3 class="fw-bold mb-0"><?= $totalCategories ?></h3>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success rounded-3 p-3">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Suppliers</h6>
                        <h3 class="fw-bold mb-0"><?= $totalSuppliers ?></h3>
                    </div>
                    <div class="stat-icon bg-warning-subtle text-warning rounded-3 p-3">
                        <i class="bi bi-truck fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Customers</h6>
                        <h3 class="fw-bold mb-0"><?= $totalCustomers ?></h3>
                    </div>
                    <div class="stat-icon bg-info-subtle text-info rounded-3 p-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Warehouses</h6>
                        <h3 class="fw-bold mb-0"><?= $totalWarehouses ?></h3>
                    </div>
                    <div class="stat-icon bg-danger-subtle text-danger rounded-3 p-3">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Today Sales</h6>
                        <h3 class="fw-bold mb-0"><?= CURRENCY . number_format($todaySales->total, 0) ?></h3>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success rounded-3 p-3">
                        <i class="bi bi-cart fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Month Sales</h6>
                        <h3 class="fw-bold mb-0"><?= CURRENCY . number_format($monthSales->total, 0) ?></h3>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary rounded-3 p-3">
                        <i class="bi bi-graph-up fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Low Stock</h6>
                        <h3 class="fw-bold mb-0 text-warning"><?= $lowStock ?></h3>
                    </div>
                    <div class="stat-icon bg-warning-subtle text-warning rounded-3 p-3">
                        <i class="bi bi-exclamation-triangle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Out of Stock</h6>
                        <h3 class="fw-bold mb-0 text-danger"><?= $outOfStock ?></h3>
                    </div>
                    <div class="stat-icon bg-danger-subtle text-danger rounded-3 p-3">
                        <i class="bi bi-x-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0">Sales & Purchases Overview</h6>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary active" id="weeklyView">Weekly</button>
                    <button class="btn btn-outline-primary" id="monthlyView">Monthly</button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="salesPurchaseChart" height="280"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Revenue vs Expenses</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueExpenseChart" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Inventory Distribution</h6>
            </div>
            <div class="card-body">
                <canvas id="inventoryChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Top Selling Products</h6>
            </div>
            <div class="card-body">
                <canvas id="topProductsChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Category-wise Products</h6>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0">Recent Sales</h6>
                <a href="<?= APP_URL ?>/sales" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentSales as $sale): ?>
                            <tr>
                                <td><a href="<?= APP_URL ?>/sales/view/<?= $sale->id ?>"><?= $sale->invoice_no ?></a></td>
                                <td><?= $sale->first_name . ' ' . $sale->last_name ?></td>
                                <td><?= Helper::formatMoney($sale->total) ?></td>
                                <td><?= Helper::getStatusBadge($sale->status) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0">Recent Purchases</h6>
                <a href="<?= APP_URL ?>/purchases" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentPurchases as $po): ?>
                            <tr>
                                <td><a href="<?= APP_URL ?>/purchases/view/<?= $po->id ?>"><?= $po->invoice_no ?></a></td>
                                <td><?= $po->company_name ?></td>
                                <td><?= Helper::formatMoney($po->total) ?></td>
                                <td><?= Helper::getStatusBadge($po->status) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $extra_js = ['dashboard']; ?>
