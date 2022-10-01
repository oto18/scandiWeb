$(document).ready(function () {

    $('#productType').change(function () {
        let selectedVal = $('#productType :selected').val();
        // console.log(`selectedVal = ${selectedVal}`);
        let template = '';
        switch (selectedVal) {
            case 'dvd':
                template = `
                    <div class="row mt-3">
                        <div class="col-md-1">Size (MB)</div>
                        <div class="col-md-2"><input id="size" class="form-control"></div>
                        <div id="size_messages" class="col-md-5"></div>
                    </div>
                `;
                break;
            case 'furniture':
                template = `
                    <div class="row mt-3">
                        <div class="col-md-1">Height (CM)</div>
                        <div class="col-md-2"><input id="height" class="form-control"></div>
                        <div id="height_messages" class="col-md-5"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-1">Width (CM)</div>
                        <div class="col-md-2"><input id="width" class="form-control"></div>
                        <div id="width_messages" class="col-md-5"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-1">Length (CM)</div>
                        <div class="col-md-2"><input id="length" class="form-control"></div>
                        <div id="length_messages" class="col-md-5"></div>
                    </div>
                `;
                break;
            case 'book':
                template = `
                    <div class="row mt-3">
                        <div class="col-md-1">Weight (KG)</div>
                        <div class="col-md-2"><input id="weight" class="form-control"></div>
                        <div id="weight-messages" class="col-md-5"></div>
                    </div>
                `;
                break;
            default:
                break;
        }

        $('#section').html(template);
    });


    function cstTrim(txt) {        //custom trim
        if (txt === undefined || txt === null) {
            return null;
        }
        return txt.trim();
    }

    function validateSKU(txt) {
        if (txt === null) {
            return null;
        }
        let len = txt.length;
        return len >= 2 && len <= 15;
    }

    function validateName(txt) {
        if (txt === null) {
            return null;
        }
        let len = txt.length;
        return len >= 2 && len <= 15;
    }

    function validateNumber(txt) {
        if (txt === null) {
            return null;
        }
        return !isNaN(txt) && !isNaN(parseFloat(txt));
    }

    function validateForm(sku, name, price, productType, size, height, width, length, weight) {
        let isSKU = validateSKU(sku);
        let isName = validateName(name);
        let isPrice = validateNumber(price);
        let isProductType = (productType !== '-1');

        let isSize = (productType === 'dvd' && validateNumber(size) || productType !== 'dvd');
        let isHeight = (productType === 'furniture' && validateNumber(height) || productType !== 'furniture');
        let isWidth = (productType === 'furniture' && validateNumber(width) || productType !== 'furniture');
        let isLength = (productType === 'furniture' && validateNumber(length) || productType !== 'furniture');
        let isWeight = (productType === 'book' && validateNumber(weight) || productType !== 'book');

        // update messages
        if (!isSKU)
            $('#sku_messages').html(`<h6 class="error">* please enter valid SKU</h6>`);
        else
            $('#sku_messages').html('');

        if (!isName)
            $('#name_messages').html(`<h6 class="error">* please enter valid Names</h6>`);
        else
            $('#name_messages').html('');

        if (!isPrice)
            $('#price_messages').html(`<h6 class="error">* please enter valid Price</h6>`);
        else
            $('#price_messages').html('');

        if (!isProductType)
            $('#product_type_messages').html(`<h6 class="error">* please enter valid Product Type</h6>`);
        else
            $('#product_type_messages').html('');

        if (!isSize)
            $('#size_messages').html(`<h6 class="error">* please enter valid Size</h6>`);
        else
            $('#size_messages').html('');

        if (!isHeight)
            $('#height_messages').html(`<h6 class="error">* please enter valid Height</h6>`);
        else
            $('#height_messages').html('');

        if (!isWidth)
            $('#width_messages').html(`<h6 class="error">* please enter valid Width</h6>`);
        else
            $('#width_messages').html('');

        if (!isLength)
            $('#length_messages').html(`<h6 class="error">* please enter valid Length</h6>`);
        else
            $('#length_messages').html('');

        if (!isWeight)
            $('#weight_messages').html(`<h6 class="error">* please enter valid Weight</h6>`);
        else
            $('#weight_messages').html('');

        // end messages here

        return isSKU && isName && isPrice && isProductType && isSize && isHeight &&
            isWidth && isLength && isWeight;

    }

    function updateMessages(id, status, text) {
        let msgs = $(id);
        if (status === 'success') {
            msgs.removeClass('alert-danger');
            msgs.addClass('alert-primary');
            msgs.html(text);
            msgs.show('slow');
            setTimeout(function () {
                msgs.hide('slow');
            }, 5000)
        } else if (status === 'error') {
            msgs.addClass('alert-danger');
            msgs.removeClass('alert-primary');
            msgs.html(text);
            msgs.show('slow');
            setTimeout(function () {
                msgs.hide('slow');
            }, 5000)
        }

    }


    $('#product_form').on('submit', function (e) {
        e.preventDefault();
        let sku = cstTrim($('#sku').val());
        let name = cstTrim($('#name').val());
        let price = cstTrim($('#price').val());
        let productType = $('#productType :selected').val();
        let size = cstTrim($('#size').val());
        let height = cstTrim($('#height').val());
        let width = cstTrim($('#width').val());
        let length = cstTrim($('#length').val());
        let weight = cstTrim($('#weight').val());

        if (validateForm(sku, name, price, productType, size, height, width, length, weight)) {
            const postData = {
                sku: sku,
                name: name,
                price: price,
                productType: productType,
                size: (size !== null) ? parseFloat(size).toFixed(2) : null,
                height: (height !== null) ? parseFloat(height).toFixed(2) : null,
                width: (width !== null) ? parseFloat(width).toFixed(2) : null,
                length: (length !== null) ? parseFloat(length).toFixed(2) : null,
                weight: (weight !== null) ? parseFloat(weight).toFixed(2) : null,
            };


            $.post('../Controllers/saveProduct.php', postData, function (data) {
                console.log(data);
                let info = JSON.parse(data);
                if (info.status === 'success') {
                    updateMessages('#save_product_messages', 'success', 'product has been saved');
                    $('#product_form').trigger('reset');
                } else if (info.status === 'error' && info.message === 'SKU_must_be_unique') {
                    $('#sku_messages').html(`<h6 class="error"> SKU must be unique</h6>`)
                    updateMessages('#save_product_messages', 'error', 'SKU must be unique');
                }
            })
        }
    });

});