$(document).ready(function () {

    displayAllProducts();

    function displayAllProducts() {
        $.post('../Controllers/showProducts.php', function (data) {
            // console.log(data);
            // let  cont = JSON.parse(data);
            // console.log(cont);

            let template = '';

            let colCount = 0;

            JSON.parse(data).forEach((obj) => {
                if (colCount === 0) {
                    template += `<div class="row">`;

                }
                template += `<div class="col-md-3">
                                <fieldset>
                                <div class="form-check ms-4 mt-2">
                                    <input class="form-check-input" name="type" type="checkbox" value="${obj.ID}">
                                </div>
                                    <p>${obj.SKU}</p>
                                    <p>${obj.Name}</p>
                                    <p>${obj.Price} $</p>
                                    <p>${(obj.Type === 'dvd') ? 'MB: ' + obj.MB :
                                        (obj.Type === 'furniture') ?
                                        'Dimentions: ' + obj.Height + 'X' + obj.Width + 'X' + obj.Length : 
                                        'KG: ' + obj.KG}
                                    </p>
                                </fieldset>
                              </div>`;
                colCount++;
                if (colCount === 4) {
                    template += `</div>`;
                    colCount = 0;
                }
            });
            $('#product_list').html(template);
        })
    }


//
    $('#delete-product-btn').click(function () {
        let productIds = [];
        $("input:checkbox[name=type]:checked").each(function(){
            productIds.push($(this).val());


            // console.log($(this).val());
        });

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

        if (productIds.length) {
            $.post('../Controllers/deleteProducts.php', {productIds: productIds}, function (data) {
                let info = JSON.parse(data);
                if (info.status === 'success') {
                    displayAllProducts();
                    updateMessages('#show_product_messages', 'success', `${info.rowCount} rows deleted`);
                }
                else if (info.status === 'error') {
                    updateMessages('#show_product_messages', 'error', `something went wrong ${info.message}`);
                }


                // console.log(data);
            });
        }
    });


});