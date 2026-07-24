<?php $page_title = 'Transfer #' . $transfer->transfer_no; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Transfer #<?= $transfer->transfer_no ?></h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/inventory/transfers/edit/<?= $transfer->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
        <a href="<?= APP_URL ?>/inventory/transfers" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
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
                                <td class="text-muted pe-3">Transfer No</td>
                                <td class="fw-medium"><?= $transfer->transfer_no ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">From Warehouse</td>
                                <td class="fw-medium"><?= $transfer->from_warehouse ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">To Warehouse</td>
                                <td class="fw-medium"><?= $transfer->to_warehouse ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Transfer Date</td>
                                <td class="fw-medium"><?= Helper::formatDate($transfer->transfer_date) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($transfer->status) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Created At</td>
                                <td class="fw-medium"><?= Helper::formatDate($transfer->created_at) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($transfer->notes): ?>
                <hr>
                <h6 class="fw-bold mb-2">Notes</h6>
                <p class="text-muted mb-0"><?= nl2br($transfer->notes) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Transfer Items</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-medium"><?= $item->product_name ?></td>
                                <td><?= $item->sku ?></td>
                                <td><?= $item->unit_name ?></td>
                                <td><?= $item->quantity ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
