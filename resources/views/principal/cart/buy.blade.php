<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Finalização de compra</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/checkout/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="d-none" id="info"
     data-route="{{ route('api.shipping') }}"
     data-width="{{ $product->width }}"
     data-height="{{ $product->height }}"
     data-length="{{ $product->length }}"
     data-weight="{{ $product->weight }}"
     data-quantity="{{ $_COOKIE['qtdProduct'] }}"
></div>

<div class="container mb-5">

    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            <strong>Oops!</strong> {{ Session::get('error') }}
        </div>
    @endif

    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('commerce/img/moto-formosa.png') }}" alt="" width="120">
        <h2>Finalização do pedido</h2>
        <p class="lead">Preencha todos os campos abaixo para finalizar o seu pedido, após a confirmação do pagamento iremos preparar a sua entreaga.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Carrinho</span>
                <span class="badge badge-secondary badge-pill" id="qtdProducts">{{ $_COOKIE['qtdProduct'] }}</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{ $product->name }}</h6>
                        @php
                            $total = $_COOKIE['qtdProduct'] * $product->price;
                        @endphp
                        <small class="text-muted">R$ {{ number_format($product->price, 2, ',', '.') }} x {{ $_COOKIE['qtdProduct'] }}</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0 text-uppercase" id="nameShipping">Selecione um frete</h6>
                        <small class="text-muted" id="priceShipping"></small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong id="totalCart" data-total="{{ $total }}">R$ {{ number_format($total, 2, ',', '.') }}</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Informações de entrega</h4>
            <form class="form" action="{{ route('cart.secondStep') }}" id="form-checkout" method="post">
                @csrf
                <input type="hidden" name="productInfo" value="{{ $product->name }};{{ $product->id }};{{ $product->price }};{{ $_COOKIE['qtdProduct'] }}">
                <input type="hidden" name="totalCart">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nome</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="{{ old('firstName') }}" required>
                        <div class="invalid-feedback">
                            O nome é obrigatório
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Sobrenome</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="{{ old('lastName') }}" required>
                        <div class="invalid-feedback">
                            Digite um sobrenome
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="address">CEP</label>
                        <input type="text" class="form-control" name="zipcode" data-mask="99999-999" value="{{ old('zipcode') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="address">Rua</label>
                        <input type="text" class="form-control" name="street" placeholder="" value="{{ old('street') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="address">Bairro</label>
                        <input type="text" class="form-control" name="neighborhood" placeholder="" value="{{ old('neighborhood') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="address">Cidade</label>
                        <input type="text" class="form-control" name="city" placeholder="" value="{{ old('city') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address">Estado</label>
                        <input type="text" class="form-control" name="uf" placeholder="" value="{{ old('uf') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address">Número</label>
                        <input type="text" class="form-control" name="number" value="{{ old('number') }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="address">Complemento <i class="text-muted">(opcional)</i></label>
                        <input type="text" class="form-control" name="complement" value="{{ old('complement') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="country">Frete</label>
                        <select class="custom-select d-block w-100" id="shipping" name="shipping" required>
                            <option value="0">--- Selecione um frete ---</option>
                        </select>
                        <span class="text-muted d-none" id="loading"><i>Carregando...</i></span>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" id="submit">Ir para pagamento</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    (function () {

        $('input[name="zipcode"]').blur(function (e) {
            let cep = $('input[name="zipcode"]').val() || '';

            if (!cep) {
                return
            }
            $('#loading').removeClass('d-none');

            let url = 'http://viacep.com.br/ws/' + cep + '/json';
            $.getJSON(url, function (data) {
                if ("error" in data) {
                    return
                }
                $('input[name="street"]').val(data.logradouro);
                $('input[name="neighborhood"]').val(data.bairro);
                $('input[name="city"]').val(data.localidade);
                $('input[name="uf"]').val(data.uf);
            })

            let info = $('#info');
            let route = info.data('route');
            let width = info.data('width');
            let height = info.data('height');
            let length = info.data('length');
            let weight = info.data('weight');
            let quantity = info.data('quantity');

            // Searching shipping product on api
            axios.get(route, {
                params: {
                    width: width,
                    height: height,
                    length: length,
                    weight: weight,
                    quantity: $('#qtdProducts').text(),
                    postCode: cep
                }
            }).then(function (response) {
                $('#loading').addClass('d-none');
                let options = "<option>--- Selecione um frete ---</option>";
                response.data.forEach(function (val) {
                    let price = (val.price).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
                    options += `<option value="${val.price};${val.name};${val.deadline}">${val.name} - Em média ${val.deadline} dia(s) - ${price}</option>`;
                });

                $("#shipping").html(options);

            }).catch(function (error) {
                alert('Não foi possível carregar o frete, tente novamente');
            });
        });
        $("#shipping").change(function (e) {
            let shipping = $(this).val();
            let exploded = shipping.split(';');
            let price = (parseFloat(exploded[0])).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});

            $('#nameShipping').text(exploded[1]);
            $('#priceShipping').text(price);

            let totalCart = $('#totalCart');
            let calc = parseFloat(totalCart.data('total')) + parseFloat(exploded[0]);

            totalCart.text((calc).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}));
            Cookies.set('totalCart', calc, {expires: 360, path: '/'});
            $('input[name="totalCart"]').val(calc);
        });
    })()
</script>
</body>
</html>
