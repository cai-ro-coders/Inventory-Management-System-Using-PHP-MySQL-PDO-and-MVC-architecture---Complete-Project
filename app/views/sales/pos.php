<?php
$page_title = 'POS System';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-shop me-2"></i>Point of Sale</h4>
    <a href="<?= APP_URL ?>/sales" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to Sales</a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="productSearch" placeholder="Search products by name, SKU, or barcode...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                            <input type="text" class="form-control" id="barcodeInput" placeholder="Scan barcode..." autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <ul class="nav nav-pills nav-fill gap-2" id="categoryTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-category="all">All</a>
                </li>
                <?php foreach ($categories ?? [] as $cat): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-category="<?= $cat->id ?>"><?= $cat->name ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="row g-2" id="productGrid">
            <?php foreach ($products as $p): ?>
            <div class="col-6 col-md-4 col-lg-3 product-card" data-category="<?= $p->category_id ?>" data-name="<?= strtolower($p->name) ?>" data-sku="<?= strtolower($p->sku) ?>" data-barcode="<?= strtolower($p->barcode ?? '') ?>">
                <div class="card border-0 shadow-sm h-100 product-item" data-id="<?= $p->id ?>" data-name="<?= $p->name ?>" data-price="<?= $p->selling_price ?>" data-stock="<?= $p->stock ?>" style="cursor: pointer;">
                    <div class="card-body text-center p-3">
                        <div class="product-img mb-2">
                            <img src="<?= APP_URL ?>/assets/uploads/<?= $p->image ?: 'default.png' ?>" alt="<?= $p->name ?>" class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                        </div>
                        <h6 class="fw-bold small mb-1 text-truncate"><?= $p->name ?></h6>
                        <div class="text-primary fw-bold mb-1"><?= Helper::formatMoney($p->selling_price) ?></div>
                        <span class="badge bg-<?= $p->stock > 0 ? 'success' : 'danger' ?> fs-10">
                            <i class="bi bi-box me-1"></i><?= $p->stock ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-cart me-2"></i>Shopping Cart</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" id="clearCart"><i class="bi bi-cart-x me-1"></i> Clear</button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="cartTable">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th style="width: 80px;" class="text-center">Qty</th>
                                <th style="width: 90px;" class="text-end">Price</th>
                                <th style="width: 90px;" class="text-end">Total</th>
                                <th style="width: 30px;"></th>
                            </tr>
                        </thead>
                        <tbody id="cartItems"></tbody>
                    </table>
                </div>
                <div id="emptyCart" class="text-center text-muted py-5">
                    <i class="bi bi-cart3" style="font-size: 3rem;"></i>
                    <p class="mt-2 mb-0">Cart is empty</p>
                    <small>Click products to add them</small>
                </div>
            </div>
            <div class="card-footer bg-white border-top">
                <div class="mb-2">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Subtotal:</span>
                        <span id="cartSubtotal"><?= Helper::formatMoney(0) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Tax (<?= TAX_RATE ?>%):</span>
                        <span id="cartTax"><?= Helper::formatMoney(0) ?></span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span id="cartTotal"><?= Helper::formatMoney(0) ?></span>
                    </div>
                </div>
                <hr>
                <form method="POST" action="<?= APP_URL ?>/sales/store" id="posForm">
                    <?= Helper::csrfField() ?>
                    <input type="hidden" name="items" id="itemsField">
                    <input type="hidden" name="warehouse_id" value="1">
                    <input type="hidden" name="sale_date" value="<?= date('Y-m-d') ?>">
                    <input type="hidden" name="subtotal" id="hiddenSubtotal">
                    <input type="hidden" name="discount" value="0">
                    <input type="hidden" name="shipping_cost" value="0">
                    <input type="hidden" name="status" value="completed">
                    <input type="hidden" id="taxRate" value="<?= TAX_RATE ?>">
                    <input type="hidden" name="total" id="hiddenTotal">

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Customer</label>
                            <select name="customer_id" class="form-select select2">
                                <option value="">Walk-in Customer</option>
                                <?php foreach ($customers ?? [] as $c): ?>
                                <option value="<?= $c->id ?>"><?= $c->first_name ?> <?= $c->last_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Mobile Payment">Mobile Payment</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Amount Received</label>
                            <div class="input-group">
                                <span class="input-group-text"><?= CURRENCY ?></span>
                                <input type="number" step="0.01" name="paid_amount" id="paidAmount" class="form-control" value="0" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Change</label>
                            <div class="input-group">
                                <span class="input-group-text"><?= CURRENCY ?></span>
                                <input type="text" id="changeAmount" class="form-control" value="0.00" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100 btn-lg" id="submitSale" disabled>
                        <i class="bi bi-check2-circle me-1"></i> Complete Sale
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var baseUrl = '<?= APP_URL ?>';
var currency = '<?= CURRENCY ?>';
var taxRate = <?= TAX_RATE ?>;
var posProducts = <?= json_encode(array_map(function($p) {
    return ['id' => $p->id, 'name' => $p->name, 'sku' => $p->sku, 'price' => (float)$p->selling_price, 'stock' => (int)$p->stock, 'image' => $p->image, 'category_id' => $p->category_id];
}, $products)) ?>;
</script>
<?php $extra_js = ['pos']; ?>
