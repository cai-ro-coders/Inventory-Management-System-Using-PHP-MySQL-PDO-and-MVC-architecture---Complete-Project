<?php
$isEdit = isset($transfer);
$page_title = $isEdit ? 'Edit Transfer' : 'New Transfer';
?>

<script>var stockMap = <?= json_encode($stockMap ?? []) ?>;</script>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/inventory/transfers" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/inventory/transfers/<?= $isEdit ? 'update/' . $transfer->id : 'store' ?>" id="transferForm">
            <?= Helper::csrfField() ?>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">From Warehouse <span class="text-danger">*</span></label>
                    <select name="from_warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach ($warehouses as $w): ?>
                        <option value="<?= $w->id ?>" <?= $isEdit && $transfer->from_warehouse_id == $w->id ? 'selected' : '' ?>><?= $w->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">To Warehouse <span class="text-danger">*</span></label>
                    <select name="to_warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach ($warehouses as $w): ?>
                        <option value="<?= $w->id ?>" <?= $isEdit && $transfer->to_warehouse_id == $w->id ? 'selected' : '' ?>><?= $w->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Transfer Date <span class="text-danger">*</span></label>
                    <input type="date" name="transfer_date" class="form-control" value="<?= $isEdit ? $transfer->transfer_date : date('Y-m-d') ?>" required>
                </div>
            </div>

            <h6 class="fw-bold mb-3">Items to Transfer</h6>
            <div class="table-responsive mb-3">
                <table class="table table-bordered" id="itemsTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50%;">Product</th>
                            <th style="width: 20%;">Quantity</th>
                            <th style="width: 20%;">Available</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody id="itemsContainer">
                        <?php if ($isEdit && !empty($items)): ?>
                        <?php foreach ($items as $i => $item): ?>
                        <tr class="item-row">
                            <td>
                                <select name="items[<?= $i ?>][product_id]" class="form-select product-select" required>
                                    <option value="">Select Product</option>
                                    <?php foreach ($products as $p): ?>
                                    <option value="<?= $p->id ?>" <?= $item->product_id == $p->id ? 'selected' : '' ?>><?= $p->name ?> (<?= $p->sku ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="items[<?= $i ?>][quantity]" class="form-control item-qty" value="<?= $item->quantity ?>" min="1" required></td>
                            <td><input type="text" class="form-control item-available" value="<?= $item->available_qty ?? 0 ?>" readonly></td>
                            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr class="item-row">
                            <td>
                                <select name="items[0][product_id]" class="form-select product-select" required>
                                    <option value="">Select Product</option>
                                    <?php foreach ($products as $p): ?>
                                    <option value="<?= $p->id ?>"><?= $p->name ?> (<?= $p->sku ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="items[0][quantity]" class="form-control item-qty" value="1" min="1" required></td>
                            <td><input type="text" class="form-control item-available" value="0" readonly></td>
                            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addItem"><i class="bi bi-plus-lg me-1"></i> Add Item</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes (optional)"><?= $isEdit ? $transfer->notes : '' ?></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> Transfer</button>
                <a href="<?= APP_URL ?>/inventory/transfers" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php $extra_js = ['transfer-form']; ?>
