$(document).ready(function() {
    var $template = $('#itemRowTemplate');

    $(document).on('change', '.product-select', function() {
        var price = parseFloat($(this).find('option:selected').data('price')) || 0;
        var $row = $(this).closest('.item-row');
        $row.find('.item-price').val(price.toFixed(2));
        calcRowTotal($row);
    });

    $(document).on('input', '.item-qty, .item-price', function() {
        calcRowTotal($(this).closest('.item-row'));
    });

    function calcRowTotal($row) {
        var qty = parseFloat($row.find('.item-qty').val()) || 0;
        var price = parseFloat($row.find('.item-price').val()) || 0;
        var total = qty * price;
        $row.find('.item-total').val(total.toFixed(2));
        calcSummary();
    }

    function calcSummary() {
        var subtotal = 0;
        $('.item-total').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });
        var taxRate = parseFloat($('#tax_rate').val()) || 0;
        var discount = parseFloat($('#discount').val()) || 0;
        var shipping = parseFloat($('#shipping_cost').val()) || 0;
        var tax = subtotal * (taxRate / 100);
        var total = subtotal + tax - discount + shipping;
        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_amount').val(tax.toFixed(2));
        $('#grand_total').val(total.toFixed(2));
    }

    $(document).on('input', '#tax_rate, #discount, #shipping_cost', calcSummary);

    $('#addItem').click(function() {
        var $row = $($template.html());
        $('#itemsTable tbody').append($row);
        $row.find('.product-select').select2({ theme: 'bootstrap-5' });
    });

    $(document).on('click', '.remove-item', function() {
        if ($('.item-row').length > 1) {
            $(this).closest('.item-row').remove();
            calcSummary();
        }
    });

    function serializeItems(form) {
        var items = [];
        $(form).find('.item-row').each(function() {
            var product_id = $(this).find('.product-select').val();
            var quantity = $(this).find('.item-qty').val();
            var price = $(this).find('.item-price').val();
            var total = $(this).find('.item-total').val();
            if (product_id) {
                items.push({
                    product_id: parseInt(product_id),
                    quantity: parseFloat(quantity),
                    price: parseFloat(price),
                    total: parseFloat(total)
                });
            }
        });
        $('<input>').attr({ type: 'hidden', name: 'items', value: JSON.stringify(items) }).appendTo(form);
    }

    $('#purchaseForm, #saleForm').submit(function(e) {
        serializeItems(this);
        $(this).find('.item-row').find('[name]').removeAttr('name');
    });

    $('.product-select').select2({ theme: 'bootstrap-5' });
});
