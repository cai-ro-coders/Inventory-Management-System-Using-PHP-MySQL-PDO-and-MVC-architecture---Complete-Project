<?php
$page_title = 'Search Results';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Search Results for "<?= Helper::escape($q) ?>"</h4>
</div>

<?php if (empty($products) && empty($customers) && empty($suppliers)): ?>
<div class="text-center py-5">
    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
    <p class="text-muted mt-2">No results found for "<?= Helper::escape($q) ?>"</p>
</div>
<?php endif; ?>

<?php if (!empty($products)): ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-box me-2"></i> Products Found (<?= count($products) ?>)</h6>
        <a href="<?= APP_URL ?>/products" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                    <tr>
                        <td><a href="<?= APP_URL ?>/products/view/<?= $p->id ?>"><?= $p->name ?></a></td>
                        <td><?= $p->sku ?></td>
                        <td><?= $p->category_name ?? '-' ?></td>
                        <td><?= Helper::formatMoney($p->selling_price) ?></td>
                        <td><?= $p->quantity ?? 0 ?></td>
                        <td><?= Helper::getStatusBadge($p->status) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($customers)): ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-people me-2"></i> Customers Found (<?= count($customers) ?>)</h6>
        <a href="<?= APP_URL ?>/customers" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Sales</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $c): ?>
                    <tr>
                        <td><a href="<?= APP_URL ?>/customers/view/<?= $c->id ?>"><?= $c->first_name . ' ' . $c->last_name ?></a></td>
                        <td><?= $c->email ?></td>
                        <td><?= $c->phone ?? '-' ?></td>
                        <td><?= Helper::formatMoney($c->total_sales ?? 0) ?></td>
                        <td><?= Helper::getStatusBadge($c->status) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($suppliers)): ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-truck me-2"></i> Suppliers Found (<?= count($suppliers) ?>)</h6>
        <a href="<?= APP_URL ?>/suppliers" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suppliers as $s): ?>
                    <tr>
                        <td><a href="<?= APP_URL ?>/suppliers/view/<?= $s->id ?>"><?= $s->company_name ?></a></td>
                        <td><?= $s->contact_person ?? '-' ?></td>
                        <td><?= $s->email ?></td>
                        <td><?= $s->phone ?? '-' ?></td>
                        <td><?= Helper::getStatusBadge($s->status) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>
