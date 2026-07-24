<?php
$page_title = 'Settings';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Settings</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#companyTab">Company</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#invoiceTab">Invoice</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#taxTab">Tax & Currency</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#localizationTab">Localization</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#systemTab">System</a>
            </li>
        </ul>
    </div>
    <div class="card-body p-4">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="companyTab">
                <form method="POST" action="<?= APP_URL ?>/settings/update" enctype="multipart/form-data">
                    <?= Helper::csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control" value="<?= $settings->company_name ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company Email</label>
                            <input type="email" name="company_email" class="form-control" value="<?= $settings->email ?? '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company Phone</label>
                            <input type="text" name="company_phone" class="form-control" value="<?= $settings->phone ?? '' ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Company Address</label>
                            <textarea name="company_address" class="form-control" rows="2"><?= $settings->address ?? '' ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company Logo</label>
                            <?php if ($settings->company_logo ?? false): ?>
                            <div class="mb-2">
                                <img src="<?= APP_URL ?>/assets/uploads/<?= $settings->company_logo ?>" class="img-fluid rounded border" style="max-height: 80px;">
                            </div>
                            <?php endif; ?>
                            <input type="file" name="company_logo" class="form-control" accept="image/*">
                            <small class="text-muted">Allowed: jpg, png, gif. Max 2MB.</small>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Save Settings</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="invoiceTab">
                <form method="POST" action="<?= APP_URL ?>/settings/update" enctype="multipart/form-data">
                    <?= Helper::csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Invoice Prefix</label>
                            <input type="text" name="invoice_prefix" class="form-control" value="<?= $settings->invoice_prefix ?? 'INV-' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Invoice Logo</label>
                            <?php if ($settings->invoice_logo ?? false): ?>
                            <div class="mb-2">
                                <img src="<?= APP_URL ?>/assets/uploads/<?= $settings->invoice_logo ?>" class="img-fluid rounded border" style="max-height: 80px;">
                            </div>
                            <?php endif; ?>
                            <input type="file" name="invoice_logo" class="form-control" accept="image/*">
                            <small class="text-muted">Allowed: jpg, png, gif. Max 2MB.</small>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Save Settings</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="taxTab">
                <form method="POST" action="<?= APP_URL ?>/settings/update">
                    <?= Helper::csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Currency Symbol</label>
                            <input type="text" name="currency_symbol" class="form-control" value="<?= $settings->currency ?? '$' ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tax Rate (%)</label>
                            <input type="number" step="0.01" name="tax_rate" class="form-control" value="<?= $settings->tax_rate ?? '0' ?>">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Save Settings</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="localizationTab">
                <form method="POST" action="<?= APP_URL ?>/settings/update">
                    <?= Helper::csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Timezone</label>
                            <select name="timezone" class="form-select">
                                <?php
                                $timezones = [
                                    'UTC' => 'UTC',
                                    'America/New_York' => 'America/New_York',
                                    'America/Chicago' => 'America/Chicago',
                                    'America/Denver' => 'America/Denver',
                                    'America/Los_Angeles' => 'America/Los_Angeles',
                                    'Europe/London' => 'Europe/London',
                                    'Europe/Paris' => 'Europe/Paris',
                                    'Europe/Berlin' => 'Europe/Berlin',
                                    'Asia/Dubai' => 'Asia/Dubai',
                                    'Asia/Kolkata' => 'Asia/Kolkata',
                                    'Asia/Singapore' => 'Asia/Singapore',
                                    'Asia/Tokyo' => 'Asia/Tokyo',
                                    'Australia/Sydney' => 'Australia/Sydney',
                                    'Pacific/Auckland' => 'Pacific/Auckland',
                                ];
                                ?>
                                <?php foreach ($timezones as $val => $label): ?>
                                <option value="<?= $val ?>" <?= ($settings->timezone ?? 'UTC') == $val ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Save Settings</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="systemTab">
                <form method="POST" action="<?= APP_URL ?>/settings/update">
                    <?= Helper::csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Low Stock Limit</label>
                            <input type="number" name="low_stock_limit" class="form-control" value="<?= $settings->low_stock_limit ?? '10' ?>">
                            <small class="text-muted">Products below this quantity will be marked as low stock.</small>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Save Settings</button>
                    </div>
                </form>
                <hr>
                <div class="mt-3">
                    <h6 class="fw-bold">Backup</h6>
                    <p class="text-muted small">Download a backup of the entire system database.</p>
                    <a href="<?= APP_URL ?>/settings/backup" class="btn btn-outline-secondary"><i class="bi bi-download me-1"></i> Download Backup</a>
                </div>
            </div>
        </div>
    </div>
</div>
