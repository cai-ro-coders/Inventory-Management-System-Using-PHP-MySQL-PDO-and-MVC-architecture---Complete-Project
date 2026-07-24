<?php
$page_title = 'Customer Report';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Customer Report</h4>
    <a href="<?= APP_URL ?>/reports" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Reports</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search customer..." value="<?= $search ?? '' ?>">
            </div>
            <div class="col-md-2">
                <input type="date" name="from" class="form-control form-control-sm" value="<?= $_GET['from'] ?? '' ?>" placeholder="From">
            </div>
            <div class="col-md-2">
                <input type="date" name="to" class="form-control form-control-sm" value="<?= $_GET['to'] ?? '' ?>" placeholder="To">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary btn-sm w-100">Filter</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Orders</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $c): ?>
                    <tr>
                        <td class="fw-medium"><?= $c->first_name . ' ' . ($c->last_name ?? '') ?></td>
                        <td><?= $c->email ?? '-' ?></td>
                        <td><?= $c->phone ?? '-' ?></td>
                        <td><?= $c->sale_count ?? 0 ?></td>
                        <td><?= Helper::formatMoney($c->total_sales ?? 0) ?></td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <?php if (isset($pagination) && $pagination['pages'] > 1): ?>
        <nav>
            <ul class="pagination pagination-sm justify-content-center mt-3">
                <li class="page-item <?= $pagination['page'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['prev'] ?>&search=<?= $search ?? '' ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['pages']; $i++): ?>
                <li class="page-item <?= $i == $pagination['page'] ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?? '' ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['next'] ?>&search=<?= $search ?? '' ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>
