<?php
$page_title = $product->name;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $product->name ?></h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/products/edit/<?= $product->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
        <a href="<?= APP_URL ?>/products" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <img src="<?= APP_URL ?>/assets/uploads/<?= $product->image ?: 'default.png' ?>" class="img-fluid rounded" style="max-height: 300px;" alt="<?= $product->name ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Name</td>
                                <td class="fw-medium"><?= $product->name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">SKU</td>
                                <td class="fw-medium"><?= $product->sku ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Barcode</td>
                                <td class="fw-medium"><?= $product->barcode ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Category</td>
                                <td class="fw-medium"><?= $product->category_name ?? '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Brand</td>
                                <td class="fw-medium"><?= $product->brand_name ?? '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Unit</td>
                                <td class="fw-medium"><?= $product->unit_name ?? '-' ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Supplier</td>
                                <td class="fw-medium"><?= $product->supplier_name ?? '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Purchase Price</td>
                                <td class="fw-medium"><?= Helper::formatMoney($product->purchase_price) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Selling Price</td>
                                <td class="fw-medium"><?= Helper::formatMoney($product->selling_price) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Tax</td>
                                <td class="fw-medium"><?= $product->tax ?>%</td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Discount</td>
                                <td class="fw-medium"><?= $product->discount ?>%</td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($product->status) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($product->description): ?>
                <hr>
                <h6 class="fw-bold mb-2">Description</h6>
                <p class="text-muted mb-0"><?= nl2br($product->description) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Stock Levels by Warehouse</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="table-light">
                            <tr>
                                <th>Warehouse</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inventory ?? [] as $inv): ?>
                            <tr>
                                <td><?= $inv->warehouse_name ?></td>
                                <td><?= $inv->quantity ?></td>
                                <td>
                                    <span class="badge bg-<?= $inv->quantity <= ($product->minimum_stock ?? 0) ? 'warning' : ($inv->quantity > 0 ? 'success' : 'danger') ?>">
                                        <?= $inv->quantity <= 0 ? 'Out of Stock' : ($inv->quantity <= ($product->minimum_stock ?? 0) ? 'Low Stock' : 'In Stock') ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($inventory)): ?>
                            <tr class="datatable-empty">
                                <td class="text-center text-muted py-3">No stock records found.</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
