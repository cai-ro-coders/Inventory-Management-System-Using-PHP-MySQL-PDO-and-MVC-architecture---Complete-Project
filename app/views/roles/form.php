<?php
$isEdit = isset($role);
$page_title = $isEdit ? 'Edit Role' : 'Create Role';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/roles" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/roles/<?= $isEdit ? 'update/' . $role->id : 'store' ?>">
            <?= Helper::csrfField() ?>

            <div class="row g-3">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= $isEdit ? $role->name : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= $isEdit ? $role->description : '' ?></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-4 mb-3">
                <h6 class="fw-bold">Permissions</h6>
                <hr>
                <div class="row g-3">
                    <?php
                    $grouped = [];
                    foreach ($permissions as $perm) {
                        $grouped[$perm->module][] = $perm;
                    }
                    ?>
                    <?php foreach ($grouped as $module => $perms): ?>
                    <div class="col-md-4">
                        <div class="card border">
                            <div class="card-header bg-light py-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input module-check" data-module="<?= $module ?>" id="module_<?= $module ?>">
                                    <label class="form-check-label fw-semibold" for="module_<?= $module ?>"><?= ucfirst($module) ?></label>
                                </div>
                            </div>
                            <div class="card-body py-2">
                                <?php foreach ($perms as $perm): ?>
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" class="form-check-input perm-check" value="<?= $perm->id ?>" id="perm_<?= $perm->id ?>" data-module="<?= $module ?>" <?= in_array($perm->id, $rolePermIds ?? []) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="perm_<?= $perm->id ?>"><?= $perm->name ?></label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> Role</button>
                <a href="<?= APP_URL ?>/roles" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php $extra_js = ['roles-form']; ?>
