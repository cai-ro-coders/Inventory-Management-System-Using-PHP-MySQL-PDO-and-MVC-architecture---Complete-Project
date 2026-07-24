<?php
$page_title = 'Expense Categories';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Expense Categories</h4>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal"><i class="bi bi-plus-lg me-1"></i> Add Category</button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $c): ?>
                    <tr>
                        <td class="fw-medium"><?= $c->name ?></td>
                        <td><?= $c->description ?? '-' ?></td>
                        <td><?= Helper::getStatusBadge('active') ?></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary edit-btn"
                                data-id="<?= $c->id ?>"
                                data-name="<?= $c->name ?>"
                                data-description="<?= $c->description ?>"
                                data-status="active"><i class="bi bi-pencil"></i></button>
                            <form method="POST" action="<?= APP_URL ?>/expenses/categories/delete/<?= $c->id ?>" class="d-inline">
                                <?= Helper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">No categories found.</td>
                    </tr>
                    <?php endif; ?>
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

<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= APP_URL ?>/expenses/categories/store" id="categoryForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?= Helper::csrfField() ?>
                    <input type="hidden" name="id" id="categoryId">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="categoryName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="categoryDescription" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="categoryStatus" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $extra_js = ['expense-categories']; ?>
