<?php
$page_title = 'Invoice #' . $purchase->invoice_no;
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
    <a href="<?= APP_URL ?>/purchases/view/<?= $purchase->id ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
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
                    <p class="mb-0"><strong>Invoice No:</strong> <?= $purchase->invoice_no ?></p>
                    <p class="mb-0"><strong>Date:</strong> <?= Helper::formatDate($purchase->purchase_date) ?></p>
                    <p class="mb-0"><strong>Status:</strong> <?= ucfirst($purchase->status) ?></p>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold mb-2">Supplier</h6>
                <p class="mb-0"><?= $purchase->company_name ?></p>
                <p class="mb-0 text-muted small"><?= $purchase->supplier_address ?? '' ?></p>
                <p class="mb-0 text-muted small"><?= $purchase->supplier_phone ?? '' ?></p>
                <p class="mb-0 text-muted small"><?= $purchase->supplier_email ?? '' ?></p>
            </div>
            <div class="col-6 text-end">
                <h6 class="fw-bold mb-2">Warehouse</h6>
                <p class="mb-0"><?= $purchase->warehouse_name ?></p>
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
                    <td class="text-end"><?= Helper::formatMoney($item->purchase_price) ?></td>
                    <td class="text-end"><?= Helper::formatMoney($item->total) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-6">
                <?php if ($purchase->notes): ?>
                <h6 class="fw-bold mb-2">Notes</h6>
                <p class="text-muted small"><?= nl2br($purchase->notes) ?></p>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-end">Subtotal:</td>
                        <td class="text-end" style="width: 120px;"><?= Helper::formatMoney($purchase->subtotal) ?></td>
                    </tr>
                    <?php if ($purchase->discount > 0): ?>
                    <tr>
                        <td class="text-end">Discount:</td>
                        <td class="text-end">- <?= Helper::formatMoney($purchase->discount) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($purchase->shipping_cost > 0): ?>
                    <tr>
                        <td class="text-end">Shipping:</td>
                        <td class="text-end"><?= Helper::formatMoney($purchase->shipping_cost) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($purchase->tax > 0): ?>
                    <tr>
                        <td class="text-end">Tax:</td>
                        <td class="text-end"><?= Helper::formatMoney($purchase->tax) ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="text-end fw-bold">Total:</td>
                        <td class="text-end fw-bold"><?= Helper::formatMoney($purchase->total) ?></td>
                    </tr>
                    <tr>
                        <td class="text-end">Paid:</td>
                        <td class="text-end"><?= Helper::formatMoney($purchase->paid_amount ?? 0) ?></td>
                    </tr>
                    <tr>
                        <td class="text-end">Balance:</td>
                        <td class="text-end"><?= Helper::formatMoney(($purchase->total ?? 0) - ($purchase->paid_amount ?? 0)) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="text-center mt-5 pt-3 border-top">
            <p class="text-muted small mb-0">Thank you for your business!</p>
        </div>
    </div>
</div>
