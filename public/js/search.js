$("#search-shipping").click(function (e) {
    e.preventDefault();
    let postCode = $('#postcode');

    if (postCode.val().length >= 9) {
        let route = $(this).data('route');
        let width = $(this).data('width');
        let height = $(this).data('height');
        let length = $(this).data('length');
        let weight = $(this).data('weight');
        let quantity = $('#item-quantity');
        let postcode = $('#postcode');

        let me = $(this);
        me.text('Buscando...');

        // Optionally the request above could also be done as
        axios.get(route, {
            params: {
                width: width,
                height: height,
                length: length,
                weight: weight,
                quantity: quantity.val(),
                postCode: postcode.val()
            }
        }).then(function (response) {
            let prices = $('#shipping-plans');
            prices.removeClass('d-none');

            let newRow = $('<tbody>');
            let cols = "";


            if(response.data[0].error.length >= 0) {
                response.data.forEach(function (val) {
                    let price = (val.price).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
                    cols += `<tr>`;
                    cols += `<td><b>${val.name}</b></td>`;
                    cols += `<td>${price}</td>`;
                    cols += `<td>Em média ${val.deadline} dia(s)</td>`;
                    cols += `</tr>`;
                });

                newRow.append(cols);
                $("#shipping-plans").html(newRow);

            } else {
                console.log(response);
                iziToast.show({
                    title: 'Ops!',
                    message: response.data[0].error.message,
                    theme: 'dark',
                    backgroundColor: '#f04c4f',
                    color: '#fff',
                    icon: 'ti-close',
                    position: 'bottomCenter',
                });
            }
            me.text('OK');
        }).catch(function (error) {
            console.log(error);
            iziToast.show({
                title: 'Ops!',
                message: "Por favor, tente novamente!",
                theme: 'dark',
                backgroundColor: '#f04c4f',
                color: '#fff',
                icon: 'ti-close',
                position: 'bottomCenter',
            });
        });
    } else {
        iziToast.show({
            title: 'Ops!',
            message: "Preencha corretamente o campo de CEP!",
            theme: 'dark',
            backgroundColor: '#f04c4f',
            color: '#fff',
            icon: 'ti-close',
            position: 'bottomCenter',
        });
    }
});

$('#buy').click(function(e) {
    e.preventDefault();
    let me = $(this);
    Cookies.set('productId', me.data('id'), {expires: 720, path: '/'});
    Cookies.set('qtdProduct', $('#item-quantity').val(), {expires: 720, path: '/'});
    window.location.href = me.data('route');
});
