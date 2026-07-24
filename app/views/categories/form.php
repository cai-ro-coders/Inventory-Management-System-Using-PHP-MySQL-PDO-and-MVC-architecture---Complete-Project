<?php
$isEdit = isset($category);
$page_title = $isEdit ? 'Edit Category' : 'Create Category';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/categories" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/categories/<?= $isEdit ? 'update/' . $category->id : 'store' ?>" enctype="multipart/form-data">
            <?= Helper::csrfField() ?>

            <div class="row g-3">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= $isEdit ? $category->name : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select name="parent_id" class="form-select">
                            <option value="">None (Top Level)</option>
                            <?php foreach ($categories as $cat): ?>
                            <?php if (!$isEdit || $cat->id != $category->id): ?>
                            <option value="<?= $cat->id ?>" <?= $isEdit && $category->parent_id == $cat->id ? 'selected' : '' ?>><?= $cat->name ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= $isEdit ? $category->description : '' ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" <?= $isEdit && $category->status == 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= $isEdit && $category->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category Image</label>
                    <?php if ($isEdit && $category->image): ?>
                    <div class="mb-3">
                        <img src="<?= APP_URL ?>/assets/uploads/<?= $category->image ?>" class="img-fluid rounded border" style="max-height: 150px;">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Allowed: jpg, png, gif. Max 2MB.</small>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> Category</button>
                <a href="<?= APP_URL ?>/categories" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
