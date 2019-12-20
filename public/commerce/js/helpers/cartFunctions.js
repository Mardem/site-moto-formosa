function errorMessage() {
    iziToast.error({
        title: 'Oops...',
        message: 'Não foi possível carregar os dados do carrinho, entre em contato conosco'
    });
}


function createId(page) {
    let key = lil.uuid();


    if (localStorage.getItem('userKeyCommerce') == null || localStorage.getItem('userKeyCommerce') === undefined) {
        localStorage.userKeyCommerce = key;
        document.cookie = 'userKeyCommerce=' + key;

        /*
        * Create a new cart on database and set a link with browser and database
        * */
        let router = page.origin + '/api/';
        let obj = {
            key: localStorage.userKeyCommerce
        };

        axios.post(router + 'create-cart', obj).then((response) => {
        }).catch(() => {
            errorMessage();
        });
    }
    if (Cookies.get('userKeyCommerce') === undefined) {
        Cookies.set('userKeyCommerce', localStorage.userKeyCommerce, {expires: 360, path: '/'})
    }
}

// This function is responsible per create a item on api
function itemToCart(id) {
    let route = window.location.origin + '/api/add-item/';
    let product = $('#' + id);

    let attrObj = {
        image: $('.image-productmf')[0].src,
        link: window.location.href,
        name: $('#name-product').text()
    };

    let item = {
        price: product.data('price'),
        id_product: product.data('idProduct'),
        token: localStorage.userKeyCommerce,
        attr: JSON.stringify(attrObj),
        quantity: $('#item-quantity').val()
    };

    axios.post(route, item).then(function (response) {
        console.log(response);
    }).catch(function (error) {
        console.log(error);
    });
}

function loadValue() {
    if (localStorage.getItem('userKeyCommerce') != null || localStorage.getItem('userKeyCommerce') !== undefined) {
        let route = window.location.origin + '/api/calculate-items/' + localStorage.userKeyCommerce;

        axios.get(route).then((response) => {
            $('#cart-value').text(response.data.formatted);
        }).catch((error) => {
            $('#cart-value').text('R$ 0,00')
        });
    }
}

$('#remove-item').click(function () {
    axios.get(window.location.origin + '/api/remove-item/' + $(this).data('id')).then((response) => {
        window.location.replace(window.location.href);
        console.log(response);
    }).catch(function (error) {
        console.error(error)
    });
});
