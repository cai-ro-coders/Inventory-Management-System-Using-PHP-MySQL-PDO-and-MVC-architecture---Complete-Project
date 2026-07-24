<?php
$page_title = 'Current Stock';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Current Stock</h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/inventory/stock-in" class="btn btn-success btn-sm"><i class="bi bi-box-arrow-in-right me-1"></i> Stock In</a>
        <a href="<?= APP_URL ?>/inventory/stock-out" class="btn btn-warning btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Stock Out</a>
        <a href="<?= APP_URL ?>/inventory/adjustment" class="btn btn-outline-secondary btn-sm"><i class="bi bi-sliders me-1"></i> Adjustment</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search products..." value="<?= $search ?? '' ?>">
            </div>
            <div class="col-md-3">
                <select name="warehouse_id" class="form-select form-select-sm">
                    <option value="">All Warehouses</option>
                    <?php foreach ($warehouses ?? [] as $w): ?>
                    <option value="<?= $w->id ?>" <?= (($_GET['warehouse_id'] ?? '') == $w->id) ? 'selected' : '' ?>><?= $w->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="low" <?= (($_GET['status'] ?? '') == 'low') ? 'selected' : '' ?>>Low Stock</option>
                    <option value="out" <?= (($_GET['status'] ?? '') == 'out') ? 'selected' : '' ?>>Out of Stock</option>
                    <option value="available" <?= (($_GET['status'] ?? '') == 'available') ? 'selected' : '' ?>>Available</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary btn-sm w-100">Filter</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Total Qty</th>
                        <th>Available</th>
                        <th>Warehouses</th>
                        <th>Stock Value</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                    <?php
                    $lowStock = $row->total_qty <= ($row->minimum_stock ?: 0);
                    $outOfStock = $row->total_qty <= 0;
                    ?>
                    <tr>
                        <td><img src="<?= APP_URL ?>/assets/uploads/<?= $row->image ?: 'default.png' ?>" class="img-thumb" alt="" style="width: 40px; height: 40px; object-fit: cover;"></td>
                        <td><a href="<?= APP_URL ?>/products/view/<?= $row->product_id ?>" class="text-decoration-none fw-medium"><?= $row->product_name ?></a></td>
                        <td><?= $row->sku ?></td>
                        <td><?= $row->total_qty ?></td>
                        <td><?= $row->available_qty ?></td>
                        <td>
                            <?php if ($row->warehouses): ?>
                            <span class="text-muted small"><?= $row->warehouses ?></span>
                            <?php else: ?>
                            <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>
                        <td><?= Helper::formatMoney($row->total_qty * ($row->selling_price ?? 0)) ?></td>
                        <td>
                            <?php if ($outOfStock): ?>
                            <span class="badge bg-danger">Out of Stock</span>
                            <?php elseif ($lowStock): ?>
                            <span class="badge bg-warning text-dark">Low Stock</span>
                            <?php else: ?>
                            <span class="badge bg-success">In Stock</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= APP_URL ?>/inventory/stock-in?product_id=<?= $row->product_id ?>" class="btn btn-sm btn-outline-success" title="Stock In"><i class="bi bi-box-arrow-in-right"></i></a>
                            <a href="<?= APP_URL ?>/inventory/stock-out?product_id=<?= $row->product_id ?>" class="btn btn-sm btn-outline-warning" title="Stock Out"><i class="bi bi-box-arrow-right"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (isset($pagination) && $pagination['pages'] > 1):
            $filterParams = array_filter(['search' => $_GET['search'] ?? '', 'warehouse_id' => $_GET['warehouse_id'] ?? '', 'status' => $_GET['status'] ?? '']);
            $qs = http_build_query($filterParams);
        ?>
        <nav>
            <ul class="pagination pagination-sm justify-content-center mt-3">
                <li class="page-item <?= $pagination['page'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['prev'] ?>&<?= $qs ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['pages']; $i++): ?>
                <li class="page-item <?= $i == $pagination['page'] ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&<?= $qs ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['next'] ?>&<?= $qs ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>
