<?php
$page_title = $supplier->company_name;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $supplier->company_name ?></h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/suppliers/edit/<?= $supplier->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
        <a href="<?= APP_URL ?>/suppliers" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
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
                                <td class="text-muted pe-3">Company Name</td>
                                <td class="fw-medium"><?= $supplier->company_name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Contact Person</td>
                                <td class="fw-medium"><?= $supplier->contact_person ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Email</td>
                                <td class="fw-medium"><?= $supplier->email ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Phone</td>
                                <td class="fw-medium"><?= $supplier->phone ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Address</td>
                                <td class="fw-medium"><?= nl2br($supplier->address ?: '-') ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">City</td>
                                <td class="fw-medium"><?= $supplier->city ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Country</td>
                                <td class="fw-medium"><?= $supplier->country ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Tax Number</td>
                                <td class="fw-medium"><?= $supplier->tax_number ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Balance</td>
                                <td class="fw-medium"><?= Helper::formatMoney($supplier->balance ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($supplier->status) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Purchase Orders</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchases ?? [] as $po): ?>
                            <tr>
                                <td><a href="<?= APP_URL ?>/purchases/view/<?= $po->id ?>" class="text-decoration-none fw-medium"><?= $po->invoice_no ?></a></td>
                                <td><?= Helper::formatDate($po->purchase_date) ?></td>
                                <td><?= Helper::formatMoney($po->total) ?></td>
                                <td><?= Helper::getStatusBadge($po->status) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
