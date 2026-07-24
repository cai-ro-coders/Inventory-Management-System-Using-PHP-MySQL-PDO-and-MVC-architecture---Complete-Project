<?php
$page_title = 'Stock Out';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Stock Out</h4>
    <a href="<?= APP_URL ?>/inventory" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Stock</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/inventory/stock-out/store">
            <?= Helper::csrfField() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Product <span class="text-danger">*</span></label>
                    <select name="product_id" class="form-select select2" required>
                        <option value="">Select Product</option>
                        <?php foreach ($products as $p): ?>
                        <option value="<?= $p->id ?>" <?= (isset($product_id) && $product_id == $p->id) ? 'selected' : '' ?>>
                            <?= $p->name ?> (<?= $p->sku ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Warehouse <span class="text-danger">*</span></label>
                    <select name="warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach ($warehouses as $w): ?>
                        <option value="<?= $w->id ?>"><?= $w->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" class="form-control" min="1" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Remarks</label>
                    <textarea name="remarks" class="form-control" rows="3" placeholder="Enter remarks (optional)"></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-box-arrow-right me-1"></i> Remove Stock</button>
                <a href="<?= APP_URL ?>/inventory" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
