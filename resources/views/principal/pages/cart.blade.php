@extends('layouts.principal.main')

@section('content')
    <div class="b-crumbs-wrap">
        <div class="cont b-crumbs">
            <ul>
                <li>
                    <a href="{{ route('home-site') }}">Início</a>
                </li>
                <li>
                    <span>Meu carrinho</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="cont maincont">

        <h1><span>Meu carrinho</span></h1>
        <span class="maincont-line1 maincont-line12"></span>
        <span class="maincont-line2 maincont-line22"></span>


        <!-- Cart Items - start -->
        <div class="section-list cart-list">
            @foreach($items as $item)
                @php
                    $attr = json_decode($item->attr, true);
                    $total = $item->price * $item->quantity;
                @endphp
                <div class="sectls">
                    <a href="{{ $attr['link'] }}" class="sectls-img">
                        <img src="{{ $attr['image'] }}" alt="">
                    </a>
                    <div class="sectls-cont">
                        <div class="sectls-ttl-wrap">
                            <h3><a href="{{ route('catalog.show', $attr['link']) }}">{{ $attr['name'] }}</a></h3>
                        </div>
                        <div class="sectls-price-wrap">
                            <p>Preço</p>
                            <p class="sectls-price">R$ {{ number_format($item->price, 2, ',', '.') }}</p>
                        </div>
                        <div class="sectls-qnt-wrap">
                            <p>Quantitdade</p>
                            <p class="qnt-wrap sectls-qnt">
                                <a href="#" class="qnt-minus sectls-minus">-</a>
                                <input type="text" value="{{ $item->quantity }}">
                                <a href="#" class="qnt-plus sectls-plus">+</a>
                            </p>
                        </div>
                        <div class="sectls-total-wrap">
                            <p>Total da compra</p>
                            <p class="sectls-total">R$ {{ number_format($total, 2, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="sectls-info">
                        <div class="sectls-rating-wrap">
                            <p class="sectls-rating">

                            </p>
                            <p></p>
                        </div>
                        <p class="sectls-add">
                            <a href="javascript:" id="remove-item" data-id="{{ $item->id }}">Remover do Carrinho</a>
                        </p>
                        <p class="sectls-favorites">
                            <a href="#"></a>
                        </p>
                    </div>
                </div>
            @endforeach

            @guest
                <a href="{{ route('register') }}" class="btn-checkout">Finalizar pagamento</a>
            @else
                <form action="https://www.meu-site.com/processar-pagamento" method="POST">
                    <script
                        src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
                        data-public-key="TEST-88ddbea9-f780-4c53-9310-7234ee4f6083"
                        data-transaction-amount="100.00">
                    </script>
                </form>
            @endguest
        </div>
        <!-- Cart Items - start -->

        <!-- Pagination -->
        {{ $items->links() }}

    </div>
@endsection

@push('css')
    <style>
        button.mercadopago-button {
            background: #ed1c24;
            color: #fff;
            box-shadow: 1px 1px 10px #a2a2a2;
            float: right;
            border: 1px solid #d20008;
            transition: all .1s ease-in;
        }
    </style>
@endpush
