<?php
$page_title = 'Stock Transfers';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Stock Transfers</h4>
    <a href="<?= APP_URL ?>/inventory/transfers/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> New Transfer</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search transfer..." value="<?= $search ?? '' ?>">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="pending" <?= (($_GET['status'] ?? '') == 'pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= (($_GET['status'] ?? '') == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= (($_GET['status'] ?? '') == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary btn-sm w-100">Filter</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Transfer No</th>
                        <th>From Warehouse</th>
                        <th>To Warehouse</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $t): ?>
                    <tr>
                        <td><a href="<?= APP_URL ?>/inventory/transfers/view/<?= $t->id ?>" class="text-decoration-none fw-medium"><?= $t->transfer_no ?></a></td>
                        <td><?= $t->from_warehouse ?></td>
                        <td><?= $t->to_warehouse ?></td>
                        <td><?= Helper::formatDate($t->transfer_date) ?></td>
                        <td><?= $t->total_items ?? '-' ?></td>
                        <td><?= Helper::getStatusBadge($t->status) ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/inventory/transfers/view/<?= $t->id ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                            <?php if ($t->status == 'pending'): ?>
                            <a href="<?= APP_URL ?>/inventory/transfers/edit/<?= $t->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/inventory/transfers/delete/<?= $t->id ?>" class="d-inline">
                                <?= Helper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (isset($pagination) && $pagination['pages'] > 1):
            $filterParams = array_filter(['search' => $_GET['search'] ?? '', 'status' => $_GET['status'] ?? '']);
            $qs = http_build_query($filterParams);
        ?>
        <nav>
            <ul class="pagination pagination-sm justify-content-center mt-3">
                <li class="page-item <?= $pagination['page'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['prev'] ?>&<?= $qs ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['pages']; $i++): ?>
                <li class="page-item <?= $i == $pagination['page'] ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&<?= $qs ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['next'] ?>&<?= $qs ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>
