$(document).ready(function() {
    var products = window.posProducts || [];
    var cart = [];
    var $productGrid = $('#productGrid');
    var $cartItems = $('#cartItems');
    var $subtotal = $('#cartSubtotal');
    var $tax = $('#cartTax');
    var $total = $('#cartTotal');
    var $paymentAmount = $('#paidAmount');
    var $changeAmount = $('#changeAmount');

    function renderProducts(filter) {
        var html = '';
        var filtered = filter ? products.filter(function(p) { return p.name.toLowerCase().indexOf(filter.toLowerCase()) > -1 || p.sku.indexOf(filter) > -1; }) : products;
        $.each(filtered, function(i, p) {
            html += '<div class="col-6 col-md-4 col-lg-3 mb-2">';
            html += '<div class="card product-item p-2" data-id="' + p.id + '" data-name="' + p.name + '" data-price="' + p.price + '" data-stock="' + p.stock + '">';
            html += '<img src="' + baseUrl + '/assets/uploads/' + (p.image || 'default.png') + '" class="card-img-top" alt="" style="height:80px;object-fit:cover;">';
            html += '<div class="card-body p-1"><small class="fw-bold d-block text-truncate">' + p.name + '</small>';
            html += '<span class="text-primary fw-bold">' + currency + number_format(p.price) + '</span>';
            html += ' <small class="text-muted">Stock: ' + p.stock + '</small>';
            html += '</div></div></div>';
        });
        $productGrid.html(html);
    }

    function renderCart() {
        var html = '';
        var subtotal = 0;
        $.each(cart, function(i, item) {
            var total = item.qty * item.price;
            subtotal += total;
            html += '<tr>';
            html += '<td><small>' + item.name + '</small></td>';
            html += '<td><input type="number" class="form-control form-control-sm qty-input" data-index="' + i + '" value="' + item.qty + '" min="1" style="width:60px;"></td>';
            html += '<td class="text-end">' + currency + number_format(item.price) + '</td>';
            html += '<td class="text-end">' + currency + number_format(total) + '</td>';
            html += '<td><button class="btn btn-sm btn-outline-danger remove-item" data-index="' + i + '"><i class="bi bi-x"></i></button></td>';
            html += '</tr>';
        });
        $cartItems.html(html);
        var taxAmt = subtotal * (taxRate / 100);
        var grandTotal = subtotal + taxAmt;
        $subtotal.text(currency + number_format(subtotal));
        $tax.text(currency + number_format(taxAmt));
        $total.text(currency + number_format(grandTotal));
        $('#hiddenTotal').val(grandTotal.toFixed(2));
        $('#hiddenSubtotal').val(subtotal.toFixed(2));
        $('#emptyCart').toggle(cart.length === 0);
        $('#submitSale').prop('disabled', cart.length === 0);
        updateItemsField();
        calcChange();
    }

    function updateItemsField() {
        var items = [];
        $.each(cart, function(i, item) {
            items.push({ product_id: item.id, quantity: item.qty, price: item.price, total: (item.qty * item.price).toFixed(2) });
        });
        $('#itemsField').val(JSON.stringify(items));
    }

    function calcChange() {
        var totalVal = parseFloat($total.text().replace(/[^0-9.-]/g, '')) || 0;
        var paid = parseFloat($paymentAmount.val()) || 0;
        var change = paid - totalVal;
        $changeAmount.val(number_format(Math.max(0, change)));
    }

    $(document).on('click', '.product-item', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = parseFloat($(this).data('price'));
        var stock = parseInt($(this).data('stock'));
        var existing = false;
        $.each(cart, function(i, item) {
            if (item.id === id) { cart[i].qty++; existing = true; return false; }
        });
        if (!existing) { cart.push({ id: id, name: name, price: price, qty: 1, stock: stock }); }
        renderCart();
    });

    $(document).on('change', '.qty-input', function() {
        var idx = $(this).data('index');
        cart[idx].qty = Math.max(1, parseInt($(this).val()) || 1);
        renderCart();
    });

    $(document).on('click', '.remove-item', function() {
        var idx = $(this).data('index');
        cart.splice(idx, 1);
        renderCart();
    });

    $('#clearCart').click(function() { cart = []; renderCart(); });

    $paymentAmount.on('input', calcChange);

    $('#productSearch').on('keyup', function() { renderProducts($(this).val()); });

    function number_format(n) { return n.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','); }

    $('#categoryTabs .nav-link').click(function(e) {
        e.preventDefault();
        $('#categoryTabs .nav-link').removeClass('active');
        $(this).addClass('active');
        var catId = $(this).data('category');
        if (catId === 'all') { renderProducts(''); }
        else {
            var html = '';
            var filtered = products.filter(function(p) { return p.category_id == catId; });
            $.each(filtered, function(i, p) {
                html += '<div class="col-6 col-md-4 col-lg-3 mb-2">';
                html += '<div class="card product-item p-2" data-id="' + p.id + '" data-name="' + p.name + '" data-price="' + p.price + '" data-stock="' + p.stock + '">';
                html += '<img src="' + baseUrl + '/assets/uploads/' + (p.image || 'default.png') + '" class="card-img-top" alt="" style="height:80px;object-fit:cover;">';
                html += '<div class="card-body p-1"><small class="fw-bold d-block text-truncate">' + p.name + '</small>';
                html += '<span class="text-primary fw-bold">' + currency + number_format(p.price) + '</span>';
                html += ' <small class="text-muted">Stock: ' + p.stock + '</small>';
                html += '</div></div></div>';
            });
            $productGrid.html(html);
        }
    });

    renderProducts('');
});
