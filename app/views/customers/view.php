<?php
$page_title = $customer->first_name . ' ' . $customer->last_name;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><?= $customer->first_name . ' ' . $customer->last_name ?></h4>
    <div class="d-flex gap-2">
        <a href="<?= APP_URL ?>/customers/edit/<?= $customer->id ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
        <a href="<?= APP_URL ?>/customers" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back</a>
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
                                <td class="text-muted pe-3">Customer Code</td>
                                <td class="fw-medium"><?= $customer->customer_code ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">First Name</td>
                                <td class="fw-medium"><?= $customer->first_name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Last Name</td>
                                <td class="fw-medium"><?= $customer->last_name ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Company</td>
                                <td class="fw-medium"><?= $customer->company ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Email</td>
                                <td class="fw-medium"><?= $customer->email ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted pe-3">Phone</td>
                                <td class="fw-medium"><?= $customer->phone ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Address</td>
                                <td class="fw-medium"><?= nl2br($customer->address ?: '-') ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">City</td>
                                <td class="fw-medium"><?= $customer->city ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Country</td>
                                <td class="fw-medium"><?= $customer->country ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Credit Limit</td>
                                <td class="fw-medium"><?= Helper::formatMoney($customer->credit_limit ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Balance</td>
                                <td class="fw-medium"><?= Helper::formatMoney($customer->balance ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted pe-3">Status</td>
                                <td class="fw-medium"><?= Helper::getStatusBadge($customer->status) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Sales Orders</h6>
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
                            <?php foreach ($sales ?? [] as $so): ?>
                            <tr>
                                <td><a href="<?= APP_URL ?>/sales/view/<?= $so->id ?>" class="text-decoration-none fw-medium"><?= $so->invoice_no ?></a></td>
                                <td><?= Helper::formatDate($so->sale_date) ?></td>
                                <td><?= Helper::formatMoney($so->total) ?></td>
                                <td><?= Helper::getStatusBadge($so->status) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
