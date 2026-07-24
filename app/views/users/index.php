<?php
$page_title = 'Users';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Users</h4>
    <a href="<?= APP_URL ?>/users/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add User</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $user): ?>
                    <tr>
                        <td>
                            <img src="<?= APP_URL ?>/assets/uploads/<?= $user->avatar ?: 'default.png' ?>" class="img-avatar" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                        </td>
                        <td class="fw-medium"><?= $user->first_name . ' ' . $user->last_name ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->role_name ?? '-' ?></td>
                        <td><?= Helper::getStatusBadge($user->status) ?></td>
                        <td><?= $user->last_login ? Helper::timeAgo($user->last_login) : '-' ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/users/edit/<?= $user->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/users/delete/<?= $user->id ?>" class="d-inline">
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
