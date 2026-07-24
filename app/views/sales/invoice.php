<?php
$page_title = 'Invoice #' . $sale->invoice_no;
?>
<style>
@media print {
    .no-print { display: none !important; }
    body { background: #fff !important; }
    .invoice-box { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
}
.invoice-box {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
}
.invoice-header {
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 1.5rem;
    margin-bottom: 1.5rem;
}
.invoice-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
}
</style>

<div class="text-center mb-3 no-print">
    <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer me-1"></i> Print</button>
    <a href="<?= APP_URL ?>/sales/view/<?= $sale->id ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm invoice-box">
    <div class="card-body p-5">
        <div class="invoice-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="fw-bold mb-1"><?= $settings->company_name ?? APP_NAME ?></h4>
                    <p class="mb-0 text-muted small"><?= $settings->address ?? '' ?></p>
                    <p class="mb-0 text-muted small"><?= $settings->phone ?? '' ?></p>
                    <p class="mb-0 text-muted small"><?= $settings->email ?? '' ?></p>
                </div>
                <div class="col-6 text-end">
                    <div class="invoice-title">INVOICE</div>
                    <p class="mb-0"><strong>Invoice No:</strong> <?= $sale->invoice_no ?></p>
                    <p class="mb-0"><strong>Date:</strong> <?= Helper::formatDate($sale->sale_date) ?></p>
                    <p class="mb-0"><strong>Status:</strong> <?= ucfirst($sale->status) ?></p>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold mb-2">Customer</h6>
                <p class="mb-0"><?= $sale->first_name . ' ' . $sale->last_name ?></p>
                <p class="mb-0 text-muted small"><?= $sale->customer_address ?? '' ?></p>
                <p class="mb-0 text-muted small"><?= $sale->customer_phone ?? '' ?></p>
                <p class="mb-0 text-muted small"><?= $sale->customer_email ?? '' ?></p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $item->name ?></td>
                    <td><?= $item->sku ?></td>
                    <td class="text-center"><?= $item->quantity ?></td>
                    <td class="text-end"><?= Helper::formatMoney($item->selling_price) ?></td>
                    <td class="text-end"><?= Helper::formatMoney($item->total) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-6">
                <?php if ($sale->notes): ?>
                <h6 class="fw-bold mb-2">Notes</h6>
                <p class="text-muted small"><?= nl2br($sale->notes) ?></p>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-end">Subtotal:</td>
                        <td class="text-end" style="width: 120px;"><?= Helper::formatMoney($sale->subtotal) ?></td>
                    </tr>
                    <?php if ($sale->discount > 0): ?>
                    <tr>
                        <td class="text-end">Discount:</td>
                        <td class="text-end">- <?= Helper::formatMoney($sale->discount) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($sale->shipping_cost > 0): ?>
                    <tr>
                        <td class="text-end">Shipping:</td>
                        <td class="text-end"><?= Helper::formatMoney($sale->shipping_cost) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($sale->tax > 0): ?>
                    <tr>
                        <td class="text-end">Tax:</td>
                        <td class="text-end"><?= Helper::formatMoney($sale->tax) ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="text-end fw-bold">Total:</td>
                        <td class="text-end fw-bold"><?= Helper::formatMoney($sale->total) ?></td>
                    </tr>
                    <tr>
                        <td class="text-end">Paid:</td>
                        <td class="text-end"><?= Helper::formatMoney($sale->paid_amount ?? 0) ?></td>
                    </tr>
                    <tr>
                        <td class="text-end">Balance:</td>
                        <td class="text-end"><?= Helper::formatMoney(($sale->total ?? 0) - ($sale->paid_amount ?? 0)) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="text-center mt-5 pt-3 border-top">
            <p class="text-muted small mb-0">Thank you for your purchase!</p>
        </div>
    </div>
</div>
