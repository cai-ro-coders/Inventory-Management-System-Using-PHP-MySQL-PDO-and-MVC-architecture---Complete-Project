<?php
$page_title = 'Roles';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Roles</h4>
    <a href="<?= APP_URL ?>/roles/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Role</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Users</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $role): ?>
                    <tr>
                        <td class="fw-medium"><?= $role->name ?></td>
                        <td><?= $role->description ?? '-' ?></td>
                        <td><?= $role->user_count ?? 0 ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/roles/edit/<?= $role->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/roles/delete/<?= $role->id ?>" class="d-inline">
                                <?= Helper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
