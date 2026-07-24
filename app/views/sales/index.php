<?php
$page_title = 'Sales';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Sales</h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/pos" class="btn btn-success btn-sm"><i class="bi bi-shop me-1"></i> POS</a>
        <a href="<?= APP_URL ?>/sales/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> New Sale</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search invoice..." value="<?= $search ?? '' ?>">
            </div>
            <div class="col-md-3">
                <select name="customer_id" class="form-select form-select-sm">
                    <option value="">All Customers</option>
                    <?php foreach ($customers ?? [] as $c): ?>
                    <option value="<?= $c->id ?>" <?= (($_GET['customer_id'] ?? '') == $c->id) ? 'selected' : '' ?>><?= $c->first_name . ' ' . $c->last_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="pending" <?= (($_GET['status'] ?? '') == 'pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= (($_GET['status'] ?? '') == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= (($_GET['status'] ?? '') == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="payment_status" class="form-select form-select-sm">
                    <option value="">Payment</option>
                    <option value="Paid" <?= (($_GET['payment_status'] ?? '') == 'Paid') ? 'selected' : '' ?>>Paid</option>
                    <option value="Unpaid" <?= (($_GET['payment_status'] ?? '') == 'Unpaid') ? 'selected' : '' ?>>Unpaid</option>
                    <option value="Partial" <?= (($_GET['payment_status'] ?? '') == 'Partial') ? 'selected' : '' ?>>Partial</option>
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
                        <th>Invoice No</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $s): ?>
                    <tr>
                        <td><a href="<?= APP_URL ?>/sales/view/<?= $s->id ?>" class="text-decoration-none fw-medium"><?= $s->invoice_no ?></a></td>
                        <td><?= $s->first_name . ' ' . $s->last_name ?></td>
                        <td><?= Helper::formatDate($s->sale_date) ?></td>
                        <td><?= Helper::formatMoney($s->total) ?></td>
                        <td><?= Helper::getStatusBadge($s->payment_status) ?></td>
                        <td><?= Helper::getStatusBadge($s->status) ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/sales/view/<?= $s->id ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                            <a href="<?= APP_URL ?>/sales/edit/<?= $s->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/sales/delete/<?= $s->id ?>" class="d-inline">
                                <?= Helper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">No sales found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if (isset($pagination) && $pagination['pages'] > 1):
            $filterParams = array_filter(['search' => $_GET['search'] ?? '', 'customer_id' => $_GET['customer_id'] ?? '', 'status' => $_GET['status'] ?? '', 'payment_status' => $_GET['payment_status'] ?? '']);
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
