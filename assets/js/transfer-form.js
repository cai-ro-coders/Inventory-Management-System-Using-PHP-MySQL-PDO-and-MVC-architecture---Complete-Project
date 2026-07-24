$(document).ready(function() {
    var $templateRow = $('.item-row').first().clone();

    $('.product-select').select2({ theme: 'bootstrap-5' });

    $(document).on('change', '.product-select', function() {
        var $row = $(this).closest('.item-row');
        var productId = $(this).val();
        var fromWarehouse = $('select[name="from_warehouse_id"]').val();
        if (productId && fromWarehouse && typeof stockMap !== 'undefined') {
            var qty = (stockMap[productId] && stockMap[productId][fromWarehouse]) ? stockMap[productId][fromWarehouse] : 0;
            $row.find('.item-available').val(qty);
        } else {
            $row.find('.item-available').val(0);
        }
    });

    $('select[name="from_warehouse_id"]').change(function() {
        $('.product-select').trigger('change');
    });

    $('#addItem').click(function() {
        var $newRow = $templateRow.clone();
        $newRow.find('select').val('');
        $newRow.find('input').val('');
        $('#itemsContainer').append($newRow);
        $newRow.find('.product-select').select2({ theme: 'bootstrap-5' });
    });

    $(document).on('click', '.remove-item', function() {
        if ($('.item-row').length > 1) {
            $(this).closest('.item-row').remove();
        }
    });

    function serializeItems(form) {
        var items = [];
        $(form).find('.item-row').each(function() {
            var product_id = $(this).find('.product-select').val();
            var quantity = $(this).find('.item-qty').val();
            if (product_id) {
                items.push({
                    product_id: parseInt(product_id),
                    quantity: parseInt(quantity)
                });
            }
        });
        $('<input>').attr({ type: 'hidden', name: 'items', value: JSON.stringify(items) }).appendTo(form);
    }

    $('#transferForm').submit(function(e) {
        serializeItems(this);
        $(this).find('.item-row').find('[name]').removeAttr('name');
    });
});
