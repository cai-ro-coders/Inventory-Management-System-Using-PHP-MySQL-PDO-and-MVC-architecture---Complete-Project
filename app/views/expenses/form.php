<?php
$isEdit = isset($expense);
$page_title = $isEdit ? 'Edit Expense' : 'Add Expense';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/expenses" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/expenses/<?= $isEdit ? 'update/' . $expense->id : 'store' ?>">
            <?= Helper::csrfField() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Expense Category <span class="text-danger">*</span></label>
                    <select name="expense_category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $c): ?>
                        <option value="<?= $c->id ?>" <?= $isEdit && $expense->expense_category_id == $c->id ? 'selected' : '' ?>><?= $c->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="<?= $isEdit ? $expense->title : '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><?= CURRENCY ?></span>
                        <input type="number" step="0.01" name="amount" class="form-control" value="<?= $isEdit ? $expense->amount : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Expense Date <span class="text-danger">*</span></label>
                    <input type="date" name="expense_date" class="form-control" value="<?= $isEdit ? $expense->expense_date : date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Enter notes (optional)"><?= $isEdit ? $expense->notes : '' ?></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> Expense</button>
                <a href="<?= APP_URL ?>/expenses" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
