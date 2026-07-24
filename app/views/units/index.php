<?php
$page_title = 'Units';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Units</h4>
    <a href="<?= APP_URL ?>/units/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Unit</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $unit): ?>
                    <tr>
                        <td class="fw-medium"><?= $unit->name ?></td>
                        <td><?= $unit->short_name ?></td>
                        <td><?= $unit->product_count ?? 0 ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/units/edit/<?= $unit->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/units/delete/<?= $unit->id ?>" class="d-inline">
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
