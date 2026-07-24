<?php
$page_title = 'Inventory Report';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Inventory Report</h4>
    <a href="<?= APP_URL ?>/reports" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Reports</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Products</h6>
                <h3 class="fw-bold mb-0"><?= $totalProducts ?? 0 ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Stock</h6>
                <h3 class="fw-bold mb-0"><?= $totalStock ?? 0 ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <h6 class="text-muted mb-1">Low Stock</h6>
                <h3 class="fw-bold mb-0 text-warning"><?= $lowStock ?? 0 ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <h6 class="text-muted mb-1">Out of Stock</h6>
                <h3 class="fw-bold mb-0 text-danger"><?= $outOfStock ?? 0 ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold mb-0">Stock Levels by Product</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Stock Qty</th>
                        <th>Minimum Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products ?? [] as $p): ?>
                    <tr>
                        <td class="fw-medium"><?= $p->name ?></td>
                        <td><?= $p->sku ?></td>
                        <td><?= $p->category_id ?? '-' ?></td>
                        <td><?= $p->stock ?></td>
                        <td><?= $p->minimum_stock ?></td>
                        <td>
                            <?php if ($p->stock <= 0): ?>
                            <span class="badge bg-danger">Out of Stock</span>
                            <?php elseif ($p->stock <= $p->minimum_stock): ?>
                            <span class="badge bg-warning text-dark">Low Stock</span>
                            <?php else: ?>
                            <span class="badge bg-success">In Stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="fw-bold mb-0">Recent Stock Movements</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Warehouse</th>
                        <th>Reference</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movements ?? [] as $m): ?>
                    <tr>
                        <td><?= Helper::formatDate($m->created_at) ?></td>
                        <td><?= $m->product_name ?></td>
                        <td>
                            <?php if ($m->movement_type == 'purchase'): ?>
                            <span class="badge bg-success">Purchase</span>
                            <?php elseif ($m->movement_type == 'sale'): ?>
                            <span class="badge bg-warning text-dark">Sale</span>
                            <?php elseif ($m->movement_type == 'transfer_in'): ?>
                            <span class="badge bg-info">Transfer In</span>
                            <?php elseif ($m->movement_type == 'transfer_out'): ?>
                            <span class="badge bg-info">Transfer Out</span>
                            <?php elseif ($m->movement_type == 'adjustment'): ?>
                            <span class="badge bg-secondary">Adjustment</span>
                            <?php else: ?>
                            <span class="badge bg-secondary"><?= ucfirst($m->movement_type) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= $m->quantity ?></td>
                        <td><?= $m->warehouse_name ?? '-' ?></td>
                        <td><?= ($m->reference_type ? ucfirst($m->reference_type) . ' #' . $m->reference_id : '-') ?></td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
