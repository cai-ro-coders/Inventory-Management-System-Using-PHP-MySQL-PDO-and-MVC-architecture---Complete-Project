<?php
$page_title = 'Sale #' . $sale->invoice_no;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Sale #<?= $sale->invoice_no ?></h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/sales/invoice/<?= $sale->id ?>" class="btn btn-outline-secondary btn-sm" target="_blank"><i class="bi bi-printer me-1"></i> Invoice</a>
        <a href="<?= APP_URL ?>/sales/edit/<?= $sale->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
        <a href="<?= APP_URL ?>/sales" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
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
                                <td class="fw-medium"><?= $sale->invoice_no ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Customer</td>
                                <td class="fw-medium"><?= $sale->first_name . ' ' . $sale->last_name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Sale Date</td>
                                <td class="fw-medium"><?= Helper::formatDate($sale->sale_date) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($sale->status) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Payment Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($sale->payment_status) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Paid Amount</td>
                                <td class="fw-medium"><?= Helper::formatMoney($sale->paid_amount ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Balance</td>
                                <td class="fw-medium"><?= Helper::formatMoney(($sale->total ?? 0) - ($sale->paid_amount ?? 0)) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($sale->notes): ?>
                <hr>
                <h6 class="fw-bold mb-2">Notes</h6>
                <p class="text-muted mb-0"><?= nl2br($sale->notes) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Sale Items</h6>
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
                                <td><?= Helper::formatMoney($item->selling_price) ?></td>
                                <td><?= Helper::formatMoney($item->total) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="4" class="text-end">Subtotal</th>
                                <th colspan="2"><?= Helper::formatMoney($sale->subtotal) ?></th>
                            </tr>
                            <?php if ($sale->discount > 0): ?>
                            <tr>
                                <th colspan="4" class="text-end">Discount</th>
                                <th colspan="2">- <?= Helper::formatMoney($sale->discount) ?></th>
                            </tr>
                            <?php endif; ?>
                            <?php if ($sale->shipping_cost > 0): ?>
                            <tr>
                                <th colspan="4" class="text-end">Shipping</th>
                                <th colspan="2"><?= Helper::formatMoney($sale->shipping_cost) ?></th>
                            </tr>
                            <?php endif; ?>
                            <?php if ($sale->tax > 0): ?>
                            <tr>
                                <th colspan="4" class="text-end">Tax</th>
                                <th colspan="2"><?= Helper::formatMoney($sale->tax) ?></th>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">Total</th>
                                <th colspan="2" class="fw-bold"><?= Helper::formatMoney($sale->total) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
