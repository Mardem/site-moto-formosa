/**
 * Use your application ID to retrieve the corresponding access tokens
 * created with the application manager
 */
//


let meli = $('#start-ml-session');
MELI.init({client_id: meli.data('app')});

meli.click(function () {
    if (!MELI.getToken()) {
        MELI.login(function () {
            MELI.get("/users/me", {}, function (data) {
                $(this).text('Enviar produto pro MercadoLivre');
                alert("Olá " + data[2].first_name + ' você está logado com sucesso!');
            });
            $('#start-ml-session').text('Enviar para o ML');
        });

    } else {
        let info = $('#ml-info');
        let dimensions = `${info.data('width')}x${info.data('height')}x${info.data('length')},${info.data('weight')}`;
        let mlImg = [];
        let img = $('.img-ml');
        $.each(img, (index, value) => {
            mlImg.push({
                'source': $(value).attr('src')
            });
        });

        let product = {
            'title': info.data('name'),
            'description': {
                'plain_text': info.data('description')
            },
            'condition': 'new',
            'category_id': $('#category-ml').val(),
            'listing_type_id': 'gold_special',
            'available_quantity': info.data('quantity'),
            'price': info.data('price'),
            'currency_id': 'BRL',
            // Modo de envio
            "shipping": {
                "mode": "me2",
                "dimensions": dimensions.toString(),
                "local_pick_up": false,
                "free_shipping": false
            },

            'pictures': [
                {"source": img[0].src}
            ],
            'sale_terms': [
                {'id': 'WARRANTY_TYPE', 'value_id': '2230279'},
                {'id': 'WARRANTY_TIME', 'value_name': '30 dias'},
            ]
        };


        // https://api.mercadolibre.com/sites/MLB/categories utilizado para buscar as categorias antes de inserir o produto

        // Insere os produtos no Mercado Livre
        MELI.post('/items?access_token=' + MELI.getToken(), product, function (data) {

            console.log('dados do ML');
            console.log(data);

            let update = {
                id: info.data('id'),
                link: data[2].permalink,
                linkEdit: 'https://www.mercadolivre.com.br/publicaciones/' + data[2].id + '/modificar'
            };

            axios.post(window.location.origin + '/api/set-link-product', update).then((response) => {

                $('#div-ml').removeClass('d-none');
                $('#edit-p-ml').attr('href', 'https://www.mercadolivre.com.br/publicaciones/' + data[2].id + '/modificar');
                $('#view-p-ml').attr('href', data[2].permalink);
            }).catch(function (error) {
                console.log(error);
            });
            alert('Para um melhor rankeamento no Mercado Livre, preencha completamente a ficha do produto em: https://www.mercadolivre.com.br/publicaciones/' + data[2].id + '/modificar');
        });
    }
});
