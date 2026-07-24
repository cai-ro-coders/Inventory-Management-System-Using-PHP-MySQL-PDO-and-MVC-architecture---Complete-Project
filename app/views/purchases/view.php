<?php
$page_title = 'Purchase #' . $purchase->invoice_no;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Purchase #<?= $purchase->invoice_no ?></h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/purchases/invoice/<?= $purchase->id ?>" class="btn btn-outline-secondary btn-sm" target="_blank"><i class="bi bi-printer me-1"></i> Invoice</a>
        <a href="<?= APP_URL ?>/purchases/edit/<?= $purchase->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
        <a href="<?= APP_URL ?>/purchases" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Invoice No</td>
                                <td class="fw-medium"><?= $purchase->invoice_no ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Supplier</td>
                                <td class="fw-medium"><?= $purchase->company_name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Warehouse</td>
                                <td class="fw-medium"><?= $purchase->warehouse_name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Order Date</td>
                                <td class="fw-medium"><?= Helper::formatDate($purchase->purchase_date) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($purchase->status) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Payment Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($purchase->payment_status) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Paid Amount</td>
                                <td class="fw-medium"><?= Helper::formatMoney($purchase->paid_amount ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Balance</td>
                                <td class="fw-medium"><?= Helper::formatMoney(($purchase->total ?? 0) - ($purchase->paid_amount ?? 0)) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($purchase->notes): ?>
                <hr>
                <h6 class="fw-bold mb-2">Notes</h6>
                <p class="text-muted mb-0"><?= nl2br($purchase->notes) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Purchase Items</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-medium"><?= $item->name ?></td>
                                <td><?= $item->sku ?? '' ?></td>
                                <td><?= $item->quantity ?></td>
                                <td><?= Helper::formatMoney($item->purchase_price) ?></td>
                                <td><?= Helper::formatMoney($item->total) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="4" class="text-end">Subtotal</th>
                                <th colspan="2"><?= Helper::formatMoney($purchase->subtotal) ?></th>
                            </tr>
                            <?php if ($purchase->discount > 0): ?>
                            <tr>
                                <th colspan="4" class="text-end">Discount</th>
                                <th colspan="2">- <?= Helper::formatMoney($purchase->discount) ?></th>
                            </tr>
                            <?php endif; ?>
                            <?php if ($purchase->shipping_cost > 0): ?>
                            <tr>
                                <th colspan="4" class="text-end">Shipping</th>
                                <th colspan="2"><?= Helper::formatMoney($purchase->shipping_cost) ?></th>
                            </tr>
                            <?php endif; ?>
                            <?php if ($purchase->tax > 0): ?>
                            <tr>
                                <th colspan="4" class="text-end">Tax</th>
                                <th colspan="2"><?= Helper::formatMoney($purchase->tax) ?></th>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">Total</th>
                                <th colspan="2" class="fw-bold"><?= Helper::formatMoney($purchase->total) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
