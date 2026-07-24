<?php
$isEdit = isset($user);
$page_title = $isEdit ? 'Edit User' : 'Create User';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/users" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/users/<?= $isEdit ? 'update/' . $user->id : 'store' ?>" enctype="multipart/form-data">
            <?= Helper::csrfField() ?>

            <div class="row g-3">
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control" value="<?= $isEdit ? $user->first_name : '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control" value="<?= $isEdit ? $user->last_name : '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" value="<?= $isEdit ? $user->username : '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= $isEdit ? $user->email : '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password <?= !$isEdit ? '<span class="text-danger">*</span>' : '' ?></label>
                            <input type="password" name="password" class="form-control" <?= !$isEdit ? 'required' : '' ?>>
                            <?php if ($isEdit): ?>
                            <small class="text-muted">Leave blank to keep current</small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-select" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role): ?>
                                <option value="<?= $role->id ?>" <?= $isEdit && $user->role_id == $role->id ? 'selected' : '' ?>><?= $role->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?= $isEdit ? $user->phone : '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" <?= $isEdit && $user->status == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= $isEdit && $user->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2"><?= $isEdit ? $user->address : '' ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Avatar</label>
                    <?php if ($isEdit && $user->avatar): ?>
                    <div class="mb-3">
                        <img src="<?= APP_URL ?>/assets/uploads/<?= $user->avatar ?>" class="img-fluid rounded border" style="max-height: 150px;">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="avatar" class="form-control" accept="image/*">
                    <small class="text-muted">Allowed: jpg, png, gif. Max 2MB.</small>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> User</button>
                <a href="<?= APP_URL ?>/users" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
