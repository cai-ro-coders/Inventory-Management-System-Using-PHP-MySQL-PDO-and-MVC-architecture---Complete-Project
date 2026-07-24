<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0"><?= isset($warehouse) ? 'Edit' : 'Add' ?> Warehouse</h5>
    <a href="<?= APP_URL ?>/warehouses" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="<?= APP_URL ?>/warehouses/<?= isset($warehouse) ? 'update/' . $warehouse->id : 'store' ?>">
            <?= Helper::csrfField() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?= $warehouse->name ?? '' ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control" value="<?= $warehouse->code ?? '' ?>" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"><?= $warehouse->address ?? '' ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="<?= $warehouse->city ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="<?= $warehouse->country ?? 'Philippines' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= $warehouse->phone ?? '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Manager</label>
                    <input type="text" name="manager" class="form-control" value="<?= $warehouse->manager ?? '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" <?= isset($warehouse) && $warehouse->status == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= isset($warehouse) && $warehouse->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><?= isset($warehouse) ? 'Update' : 'Save' ?> Warehouse</button>
                </div>
            </div>
        </form>
    </div>
</div>
