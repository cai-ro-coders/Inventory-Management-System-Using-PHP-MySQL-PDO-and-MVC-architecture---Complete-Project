<?php
$page_title = 'Categories';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Categories</h4>
    <a href="<?= APP_URL ?>/categories/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Category</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $cat): ?>
                    <tr>
                        <td>
                            <img src="<?= APP_URL ?>/assets/uploads/<?= $cat->image ?: 'default.png' ?>" class="img-thumb" alt="" style="width: 40px; height: 40px; object-fit: cover;">
                        </td>
                        <td class="fw-medium"><?= $cat->name ?></td>
                        <td><?= $cat->parent_name ?? '-' ?></td>
                        <td><?= $cat->product_count ?? 0 ?></td>
                        <td><?= Helper::getStatusBadge($cat->status) ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/categories/edit/<?= $cat->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/categories/delete/<?= $cat->id ?>" class="d-inline">
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
