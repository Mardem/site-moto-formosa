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


<div class="container mb-5">
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
                        <h6 class="my-0">{{ $productInfo[0] }}</h6>
                        @php
                            $total = $_COOKIE['qtdProduct'] * $productInfo[2];
                            $shippingAndTotal = $total + $shipping[0];
                        @endphp
                        <small class="text-muted">R$ {{ number_format($productInfo[2], 2, ',', '.') }} x {{ $_COOKIE['qtdProduct'] }}</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0 text-uppercase" id="nameShipping">{{ $shipping[1] }}</h6>
                        <small class="text-muted" id="priceShipping">R$ {{ number_format($shipping[0], 2, ',', '.') }}</small>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong id="totalCart" data-total="{{ $total }}">R$ {{ number_format($shippingAndTotal, 2, ',', '.') }}</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Informações de entrega</h4>
            @csrf
            <input type="hidden" name="totalCart">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Nome</label>
                    <div class="text-muted">
                        {{ $order->firstName }}
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Sobrenome</label>
                    <div class="text-muted">
                        {{ $order->lastName }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="address">CEP</label>
                    <div class="text-muted">
                        {{ $order->address }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="address">Rua</label>
                    <div class="text-muted">
                        {{ $order->address }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="address">Bairro</label>
                    <div class="text-muted">
                        {{ $order->neighborhood }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="address">Cidade</label>
                    <div class="text-muted">
                        {{ $order->city }}
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Estado</label>
                    <div class="text-muted">
                        {{ $order->state }}
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Número</label>
                    <div class="text-muted">
                        {{ $order->number}}
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="address">Complemento <i class="text-muted">(opcional)</i></label>
                    <div class="text-muted">
                        {{ $order->complement }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="country">Entrega</label>
                    <div class="text-muted">
                        Em até {{ $shipping[2] }} {{ $shipping[2] > 1 ? 'dias' : 'dia' }} enviado via <strong>{{ $shipping[1] }}</strong> &mdash; R$ {{ number_format($shipping[0], 2, ',', '.') }}
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <form action="{{ route('saveCart') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="{{ $shipping[2] }}">
                <input type="hidden" name="description" value="{{ $shipping[3] }}x{{ $shipping[0] }}">

                <script
                    src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
                    data-public-key="TEST-88ddbea9-f780-4c53-9310-7234ee4f6083"
                    data-transaction-amount="{{ $shippingAndTotal }}">
                </script>
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
</body>
</html>
