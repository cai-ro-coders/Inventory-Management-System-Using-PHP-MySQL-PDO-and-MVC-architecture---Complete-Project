$(document).ready(function() {
    var $templateRow = $('.item-row').first().clone();

    function getCurrentQty($row) {
        var productId = $row.find('.product-select').val();
        var warehouseId = $('#warehouse_id').val();
        if (productId && warehouseId && stockMap[productId] && stockMap[productId][warehouseId] !== undefined) {
            return stockMap[productId][warehouseId];
        }
        return 0;
    }

    function updateOldQty($row) {
        var qty = getCurrentQty($row);
        $row.find('.old-qty').val(qty);
        calcDiff($row);
    }

    function calcDiff($row) {
        var oldQty = parseFloat($row.find('.old-qty').val()) || 0;
        var newQty = parseFloat($row.find('.new-qty').val()) || 0;
        var diff = newQty - oldQty;
        $row.find('.diff-qty').val(diff >= 0 ? '+' + diff : diff);
    }

    $(document).on('change', '.product-select', function() {
        updateOldQty($(this).closest('.item-row'));
    });

    $('#warehouse_id').change(function() {
        $('.item-row').each(function() {
            if ($(this).find('.product-select').val()) {
                updateOldQty($(this));
            }
        });
    });

    $(document).on('input', '.new-qty', function() {
        calcDiff($(this).closest('.item-row'));
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

    $('#adjustmentForm').submit(function() {
        $('#itemsContainer .item-row').each(function(index) {
            $(this).find('[name]').each(function() {
                var name = $(this).attr('name');
                name = name.replace(/items\[\d+\]/, 'items[' + index + ']');
                $(this).attr('name', name);
            });
        });
    });

    $('.product-select').select2({ theme: 'bootstrap-5' });
});
