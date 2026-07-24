<?php
$page_title = 'Reports';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Reports Dashboard</h4>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/reports/sales" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="display-4 text-primary mb-3">
                        <i class="bi bi-cart"></i>
                    </div>
                    <h5 class="fw-bold">Sales Reports</h5>
                    <p class="text-muted mb-0">View daily, monthly, and yearly sales data with charts.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/reports/purchases" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="display-4 text-success mb-3">
                        <i class="bi bi-cart-plus"></i>
                    </div>
                    <h5 class="fw-bold">Purchase Reports</h5>
                    <p class="text-muted mb-0">Track purchase orders and supplier spending.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/reports/inventory" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="display-4 text-info mb-3">
                        <i class="bi bi-archive"></i>
                    </div>
                    <h5 class="fw-bold">Inventory Reports</h5>
                    <p class="text-muted mb-0">Product stock levels and movement history.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/reports/financial" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="display-4 text-warning mb-3">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="fw-bold">Financial Reports</h5>
                    <p class="text-muted mb-0">Revenue vs expenses, profit calculation, charts.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/reports/customers" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="display-4 text-danger mb-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="fw-bold">Customer Reports</h5>
                    <p class="text-muted mb-0">Customer sales data and performance.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/reports/suppliers" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="display-4 text-secondary mb-3">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5 class="fw-bold">Supplier Reports</h5>
                    <p class="text-muted mb-0">Supplier purchase history and analysis.</p>
                </div>
            </div>
        </a>
    </div>
</div>
