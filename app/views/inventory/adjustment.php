<?php
$page_title = 'Stock Adjustment';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Stock Adjustment</h4>
    <a href="<?= APP_URL ?>/inventory" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Stock</a>
</div>

<script>var stockMap = <?= json_encode($stockMap) ?>;</script>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/inventory/adjustment/store" id="adjustmentForm">
            <?= Helper::csrfField() ?>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Warehouse <span class="text-danger">*</span></label>
                    <select name="warehouse_id" id="warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach ($warehouses as $w): ?>
                        <option value="<?= $w->id ?>"><?= $w->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Adjustment Date</label>
                    <input type="date" name="adjustment_date" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
            </div>

            <h6 class="fw-bold mb-3">Items</h6>
            <div class="table-responsive mb-3">
                <table class="table table-bordered" id="itemsTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 35%;">Product</th>
                            <th style="width: 15%;">Current Qty</th>
                            <th style="width: 15%;">New Qty</th>
                            <th style="width: 15%;">Difference</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody id="itemsContainer">
                        <tr class="item-row">
                            <td>
                                <select name="items[0][product_id]" class="form-select product-select" required>
                                    <option value="">Select Product</option>
                                    <?php foreach ($products as $p): ?>
                                    <option value="<?= $p->id ?>"><?= $p->name ?> (<?= $p->sku ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="items[0][old_qty]" class="form-control old-qty" readonly></td>
                            <td><input type="number" name="items[0][new_qty]" class="form-control new-qty" min="0" required></td>
                            <td><input type="text" class="form-control diff-qty" readonly></td>
                            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addItem"><i class="bi bi-plus-lg me-1"></i> Add Item</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <label class="form-label">Reason / Notes</label>
                    <textarea name="remarks" class="form-control" rows="3" placeholder="Reason for adjustment"></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Save Adjustment</button>
                <a href="<?= APP_URL ?>/inventory" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php $extra_js = ['adjustment-form']; ?>
