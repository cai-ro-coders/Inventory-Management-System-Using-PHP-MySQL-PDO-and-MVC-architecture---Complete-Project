<?php
$isEdit = isset($purchase);
$page_title = $isEdit ? 'Edit Purchase' : 'Create Purchase';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $page_title ?></h4>
    <a href="<?= APP_URL ?>/purchases" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="<?= APP_URL ?>/purchases/<?= $isEdit ? 'update/' . $purchase->id : 'store' ?>" id="purchaseForm">
            <?= Helper::csrfField() ?>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Supplier <span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-select select2" required>
                        <option value="">Select Supplier</option>
                        <?php foreach ($suppliers as $s): ?>
                        <option value="<?= $s->id ?>" <?= $isEdit && $purchase->supplier_id == $s->id ? 'selected' : '' ?>><?= $s->company_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Warehouse <span class="text-danger">*</span></label>
                    <select name="warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        <?php foreach ($warehouses as $w): ?>
                        <option value="<?= $w->id ?>" <?= $isEdit && $purchase->warehouse_id == $w->id ? 'selected' : '' ?>><?= $w->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Purchase Date <span class="text-danger">*</span></label>
                    <input type="date" name="purchase_date" class="form-control" value="<?= $isEdit ? $purchase->purchase_date : date('Y-m-d') ?>" required>
                </div>
            </div>

            <h6 class="fw-bold mb-3">Purchase Items</h6>
            <div class="table-responsive mb-3">
                <table class="table table-bordered" id="itemsTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40%;">Product</th>
                            <th style="width: 15%;">Quantity</th>
                            <th style="width: 15%;">Price</th>
                            <th style="width: 15%;">Total</th>
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
                                    <option value="<?= $p->id ?>" data-price="<?= $p->purchase_price ?>" <?= $item->product_id == $p->id ? 'selected' : '' ?>><?= $p->name ?> (<?= $p->sku ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="items[<?= $i ?>][quantity]" class="form-control item-qty" value="<?= $item->quantity ?>" min="1" required></td>
                            <td><input type="number" step="0.01" name="items[<?= $i ?>][price]" class="form-control item-price" value="<?= $item->price ?>" min="0" required></td>
                            <td><input type="text" class="form-control item-total" value="<?= Helper::formatMoney($item->total) ?>" readonly></td>
                            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr class="item-row">
                            <td>
                                <select name="items[0][product_id]" class="form-select product-select" required>
                                    <option value="">Select Product</option>
                                    <?php foreach ($products as $p): ?>
                                    <option value="<?= $p->id ?>" data-price="<?= $p->purchase_price ?>"><?= $p->name ?> (<?= $p->sku ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="items[0][quantity]" class="form-control item-qty" value="1" min="1" required></td>
                            <td><input type="number" step="0.01" name="items[0][price]" class="form-control item-price" value="0" min="0" required></td>
                            <td><input type="text" class="form-control item-total" value="<?= Helper::formatMoney(0) ?>" readonly></td>
                            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></td>
                        </tr>
                        <?php endif; ?>
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

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label">Subtotal</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= CURRENCY ?></span>
                                        <input type="text" id="subtotal" class="form-control" value="<?= $isEdit ? number_format($purchase->subtotal, 2) : '0.00' ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tax Rate (%)</label>
                                    <input type="number" step="0.01" name="tax_rate" id="tax_rate" class="form-control" value="<?= $isEdit ? $purchase->tax_rate : TAX_RATE ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tax Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= CURRENCY ?></span>
                                        <input type="text" id="tax_amount" class="form-control" value="<?= $isEdit ? number_format($purchase->tax, 2) : '0.00' ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Discount</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= CURRENCY ?></span>
                                        <input type="number" step="0.01" name="discount" id="discount" class="form-control" value="<?= $isEdit ? $purchase->discount : '0' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Shipping Cost</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= CURRENCY ?></span>
                                        <input type="number" step="0.01" name="shipping_cost" id="shipping_cost" class="form-control" value="<?= $isEdit ? $purchase->shipping_cost : '0' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= CURRENCY ?></span>
                                        <input type="text" id="grand_total" class="form-control fw-bold" value="<?= $isEdit ? number_format($purchase->total, 2) : '0.00' ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Paid Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= CURRENCY ?></span>
                                        <input type="number" step="0.01" name="paid_amount" id="paid_amount" class="form-control" value="<?= $isEdit ? $purchase->paid_amount : '0' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" <?= $isEdit && $purchase->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="approved" <?= $isEdit && $purchase->status == 'approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="completed" <?= $isEdit && $purchase->status == 'completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="cancelled" <?= $isEdit && $purchase->status == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Status</label>
                            <select name="payment_status" class="form-select">
                                <option value="Unpaid" <?= $isEdit && $purchase->payment_status == 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
                                <option value="Partial" <?= $isEdit && $purchase->payment_status == 'Partial' ? 'selected' : '' ?>>Partial</option>
                                <option value="Paid" <?= $isEdit && $purchase->payment_status == 'Paid' ? 'selected' : '' ?>>Paid</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="4"><?= $isEdit ? $purchase->notes : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Update' : 'Save' ?> Purchase</button>
                <a href="<?= APP_URL ?>/purchases" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<template id="itemRowTemplate">
    <tr class="item-row">
        <td>
            <select class="form-select product-select" required>
                <option value="">Select Product</option>
                <?php foreach ($products as $p): ?>
                <option value="<?= $p->id ?>" data-price="<?= $p->purchase_price ?>"><?= $p->name ?> (<?= $p->sku ?>)</option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><input type="number" class="form-control item-qty" value="1" min="1" required></td>
        <td><input type="number" step="0.01" class="form-control item-price" value="0" min="0" required></td>
        <td><input type="text" class="form-control item-total" value="0.00" readonly></td>
        <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></td>
    </tr>
</template>

<?php $extra_js = ['purchase-form']; ?>
