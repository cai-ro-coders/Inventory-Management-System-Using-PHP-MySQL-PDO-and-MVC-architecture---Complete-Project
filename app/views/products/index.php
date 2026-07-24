<?php
$page_title = 'Products';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Products</h4>
    <div class="d-flex gap-2">
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Export</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= APP_URL ?>/products/export/csv"><i class="bi bi-file-earmark-spreadsheet me-2"></i>Export CSV</a></li>
                <li><a class="dropdown-item" href="<?= APP_URL ?>/products/export/json"><i class="bi bi-file-earmark-code me-2"></i>Export JSON</a></li>
            </ul>
        </div>
        <a href="<?= APP_URL ?>/products/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Product</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search products..." value="<?= $search ?>">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat->id ?>" <?= ($_GET['category_id'] ?? '') == $cat->id ? 'selected' : '' ?>><?= $cat->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="brand_id" class="form-select form-select-sm">
                    <option value="">All Brands</option>
                    <?php foreach ($brands as $b): ?>
                    <option value="<?= $b->id ?>" <?= ($_GET['brand_id'] ?? '') == $b->id ? 'selected' : '' ?>><?= $b->name ?></option>
                    <?php endforeach; ?>
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
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $p): ?>
                    <tr>
                        <td><img src="<?= APP_URL ?>/assets/uploads/<?= $p->image ?>" class="img-thumb" alt=""></td>
                        <td><a href="<?= APP_URL ?>/products/view/<?= $p->id ?>" class="text-decoration-none fw-medium"><?= $p->name ?></a></td>
                        <td><?= $p->sku ?></td>
                        <td><?= $p->category_name ?></td>
                        <td><?= $p->brand_name ?></td>
                        <td><?= Helper::formatMoney($p->selling_price) ?></td>
                        <td>
                            <span class="badge bg-<?= $p->stock_qty <= $p->minimum_stock ? 'warning' : ($p->stock_qty > 0 ? 'success' : 'danger') ?>">
                                <?= $p->stock_qty ?>
                            </span>
                        </td>
                        <td><?= Helper::getStatusBadge($p->status) ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/products/view/<?= $p->id ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                            <a href="<?= APP_URL ?>/products/edit/<?= $p->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/products/delete/<?= $p->id ?>" class="d-inline">
                                <?= Helper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($pagination['pages'] > 1): 
            $qs = http_build_query(array_filter(['search' => $search, 'category_id' => $_GET['category_id'] ?? '', 'brand_id' => $_GET['brand_id'] ?? '']));
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
