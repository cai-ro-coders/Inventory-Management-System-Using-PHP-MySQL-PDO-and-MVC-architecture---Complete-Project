<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Warehouses</h5>
    <a href="<?= APP_URL ?>/warehouses/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Warehouse</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4"><input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="<?= $search ?>"></div>
            <div class="col-md-2"><button type="submit" class="btn btn-outline-primary btn-sm w-100">Search</button></div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>Code</th><th>Name</th><th>City</th><th>Phone</th><th>Manager</th><th>Items</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($data as $w): ?>
                    <tr>
                        <td><strong><?= $w->code ?></strong></td>
                        <td><?= $w->name ?></td>
                        <td><?= $w->city ?></td>
                        <td><?= $w->phone ?></td>
                        <td><?= $w->manager ?></td>
                        <td><span class="badge bg-info"><?= $w->stock_items ?></span></td>
                        <td><?= Helper::getStatusBadge($w->status) ?></td>
                        <td>
                            <a href="<?= APP_URL ?>/warehouses/edit/<?= $w->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= APP_URL ?>/warehouses/delete/<?= $w->id ?>" class="d-inline">
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
