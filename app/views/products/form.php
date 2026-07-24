<?php
$isEdit = isset($product);
$page_title = $isEdit ? 'Edit Product' : 'Create Product';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/products" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/products/<?= $isEdit ? 'update/' . $product->id : 'store' ?>" enctype="multipart/form-data">
            <?= Helper::csrfField() ?>

            <div class="row g-3">
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?= $isEdit ? $product->name : '' ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" class="form-control" value="<?= $isEdit ? $product->sku : '' ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Barcode</label>
                            <input type="text" name="barcode" class="form-control" value="<?= $isEdit ? $product->barcode : '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat->id ?>" <?= $isEdit && $product->category_id == $cat->id ? 'selected' : '' ?>><?= $cat->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select">
                                <option value="">Select Brand</option>
                                <?php foreach ($brands as $b): ?>
                                <option value="<?= $b->id ?>" <?= $isEdit && $product->brand_id == $b->id ? 'selected' : '' ?>><?= $b->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit <span class="text-danger">*</span></label>
                            <select name="unit_id" class="form-select" required>
                                <option value="">Select Unit</option>
                                <?php foreach ($units as $u): ?>
                                <option value="<?= $u->id ?>" <?= $isEdit && $product->unit_id == $u->id ? 'selected' : '' ?>><?= $u->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Supplier</label>
                            <select name="supplier_id" class="form-select">
                                <option value="">Select Supplier</option>
                                <?php foreach ($suppliers as $s): ?>
                                <option value="<?= $s->id ?>" <?= $isEdit && $product->supplier_id == $s->id ? 'selected' : '' ?>><?= $s->company_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" <?= $isEdit && $product->status == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= $isEdit && $product->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Purchase Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><?= CURRENCY ?? '$' ?></span>
                                <input type="number" step="0.01" name="purchase_price" class="form-control" value="<?= $isEdit ? $product->purchase_price : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Selling Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><?= CURRENCY ?? '$' ?></span>
                                <input type="number" step="0.01" name="selling_price" class="form-control" value="<?= $isEdit ? $product->selling_price : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tax (%)</label>
                            <input type="number" step="0.01" name="tax" class="form-control" value="<?= $isEdit ? $product->tax : '0' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Discount (%)</label>
                            <input type="number" step="0.01" name="discount" class="form-control" value="<?= $isEdit ? $product->discount : '0' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Minimum Stock</label>
                            <input type="number" name="minimum_stock" class="form-control" value="<?= $isEdit ? $product->minimum_stock : '0' ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"><?= $isEdit ? $product->description : '' ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Product Image</label>
                    <?php if ($isEdit && $product->image): ?>
                    <div class="mb-3">
                        <img src="<?= APP_URL ?>/assets/uploads/<?= $product->image ?>" class="img-fluid rounded border" style="max-height: 200px;">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Allowed: jpg, png, gif. Max 2MB.</small>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> Product</button>
                <a href="<?= APP_URL ?>/products" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
