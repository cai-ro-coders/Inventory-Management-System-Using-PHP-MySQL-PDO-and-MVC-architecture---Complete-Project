<?php
$page_title = 'Expenses';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Expenses</h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/expenses/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Expense</a>
        <a href="<?= APP_URL ?>/expenses/categories" class="btn btn-outline-secondary btn-sm"><i class="bi bi-tags me-1"></i> Categories</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search expenses..." value="<?= $search ?? '' ?>">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    <?php foreach ($categories ?? [] as $c): ?>
                    <option value="<?= $c->id ?>" <?= (($_GET['category_id'] ?? '') == $c->id) ? 'selected' : '' ?>><?= $c->name ?></option>
                    <?php endforeach; ?>
                </select>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $e): ?>
                    <tr>
                        <td class="fw-medium"><?= $e->title ?></td>
                        <td><span class="badge bg-secondary"><?= $e->category_name ?></span></td>
                        <td><?= Helper::formatMoney($e->amount) ?></td>
                        <td><?= Helper::formatDate($e->expense_date) ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/expenses/edit/<?= $e->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/expenses/delete/<?= $e->id ?>" class="d-inline">
                                <?= Helper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No expenses found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        $qp = array_filter(['search' => $_GET['search'] ?? '', 'category_id' => $_GET['category_id'] ?? '', 'from' => $_GET['from'] ?? '', 'to' => $_GET['to'] ?? '']);
        $q = http_build_query($qp);
        ?>
        <?php if (isset($pagination) && $pagination['pages'] > 1): ?>
        <nav>
            <ul class="pagination pagination-sm justify-content-center mt-3">
                <li class="page-item <?= $pagination['page'] <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['prev'] ?>&<?= $q ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $pagination['pages']; $i++): ?>
                <li class="page-item <?= $i == $pagination['page'] ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&<?= $q ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $pagination['next'] ?>&<?= $q ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>
