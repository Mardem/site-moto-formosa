@extends('layouts.principal.main')

@section('meta-description', $product->seo_description)
@section('title', $product->name .' | ' .  env('APP_NAME') )
@section('content')
    <div class="b-crumbs-wrap">
        <div class="cont b-crumbs">
            <ul>
                <li>
                    <a href="{{ route('home-site') }}">Moto Formosa</a>
                </li>
                <li>
                    <a href="">{{ $product->category->name }}</a>
                </li>
                <li>
                    <span>{{ $product->name }}</span>
                </li>
            </ul>
            <div class="b-crumbs-menu">
                <a id="b-crumbs-menu" href="#"></a>
                <ul class="b-crumbs-menulist">
                    <li><a href="catalog.html">Categorias</a></li>
                    <li><a href="catalog-gallery.html">Produtos da categoria</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cont maincont">

        <h1><span>{{ $product->name }}</span></h1>
        <span class="maincont-line1"></span>
        <span class="maincont-line2"></span>

        <!-- Product - start -->
        <div class="prod">

            <!-- Product Slider - start -->
            <div class="prod-slider-wrap">
                <div class="flexslider prod-slider" id="prod-slider">
                    <ul class="slides">

                        @foreach($product->images as $key => $image)
                            <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;"
                                class="flex-active-slide">
                                <!-- <a> & <img> Without Spaces -->
                                <a data-fancybox-group="prod" class="fancy-img" href="{{ asset($image->path ?? 'commerce/img/moto-formosa.png') }}">
                                    <img src="{{ asset($image->path ?? 'commerce/img/moto-formosa.png') }}" alt="Imagem número {{ $key }} do produto {{ strtolower($product->name) }} " draggable="false">
                                </a>
                            </li>
                        @endforeach

                    </ul>
                    <ul class="flex-direction-nav">
                        <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="flex-nav-next"><a class="flex-next" href="#">Próximo</a></li>
                    </ul>
                </div>
                <div class="flexslider prod-thumbs" id="prod-thumbs">

                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="slides" style="width: 1000%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                            @foreach($product->images as $image)
                                <li style="width: 116.75px; margin-right: 0px; float: left; display: block;" class="flex-active-slide">
                                    <img src="{{ asset($image->path ?? 'commerce/img/moto-formosa.png') }}" alt="" draggable="false">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <ul class="flex-direction-nav">
                        <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="flex-nav-next"><a class="flex-next" href="#">Próximo</a></li>
                    </ul>
                </div>
            </div>
            <!-- Product Slider - end -->

            <!-- Product Content - start -->
            <div class="prod-cont" id="app">
                <div class="prod-desc">
                    <p class="prod-desc-ttl"><span>Descrição</span></p>
                    <p>{{ \Illuminate\Support\Str::limit($product->seo_description, 172) }} <a id="prod-showdesc" href="#">ler mais</a></p>
                </div>
                <div class="prod-props">
                    <dl>
                        @foreach($product->details()->limit(4)->get() as $detail)
                            <dt>{{ $detail->name }}</dt>
                            <dd>{{ $detail->description }}</dd>
                        @endforeach

                        <dt style="width: 15%"><a id="prod-showprops" href="#">ver todos os detalhes</a></dt>
                        <dd></dd>
                    </dl>
                </div>
                <div class="prod-info">
                    <div class="prod-price-wrap">
                        <p>Valor</p>
                        <h2 class="prod-price">R$ {{ number_format($product->price, 2, ',', '.') }}</h2>
                    </div>
                    <div class="prod-qnt-wrap">
                        <p>Quantidade</p>
                        <p class="qnt-wrap prod-qnt">
                            <a href="#" class="qnt-minus prod-minus">-</a>
                            <input type="text" value="1" id="item-quantity">
                            <a href="#" class="qnt-plus prod-plus">+</a>
                        </p>
                    </div>
                    <div class="prod-shipping-wrap" >
                        <p>Frete</p>
                        <div class="form-group">
                            <input type="text" id="postcode" class="form-control" style="border: 1px solid #999999;padding: 8px;">
                            <a href="#" id="search-shipping" data-route="{{ route('api.shipping') }}"
                               data-width="{{ $product->width }}"
                               data-height="{{ $product->height }}"
                               data-length="{{ $product->length }}"
                               data-weight="{{ $product->weight }}"
                               data-id="#custom-btn"
                            >Pesquisar</a>
                        </div>

                    </div>

                </div>

                <div class="prod-actions">
                    <table class="table" id="shipping-plans">
                        <tbody>
                        <tr>
                            <td scope="row">SEDEX</td>
                            <td>R$ 300</td>
                            <td>7 dias úteis</td>
                        </tr>
                        <tr>
                            <td scope="row">SEDEX</td>
                            <td>R$ 300</td>
                            <td>7 dias úteis</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="prod-actions">
                    <div class="prod-rating-wrap">
                        <p class="prod-rating">
                            <i class="fa fa-star-o" title="5"></i><i class="fa fa-star-o" title="4"></i><i
                                class="fa fa-star-o" title="3"></i><i class="fa fa-star-o" title="2"></i><i
                                class="fa fa-star-o" title="1"></i>
                        </p>
                        <p><span class="prod-rating-count">89</span> avaliações</p>
                    </div>
                    <p class="prod-favorites">
                        <a href="#"></a>
                    </p>
                    <p class="prod-add">
                        <a href="#">Adicionar ao carrinho</a>
                    </p>

                </div>
            </div>
            <!-- Product Content - end -->

        </div>
        <!-- Product - end -->

        <!-- Product Tabs - start -->
        <div class="prod-tabs-wrap">
            <ul class="prod-tabs">
                <li data-prodtab-num="1" id="prod-desc" class="active">
                    <a data-prodtab="#prod-tab-1" href="#">Descrição</a>
                </li>
                <li data-prodtab-num="2" id="prod-props">
                    <a data-prodtab="#prod-tab-2" href="#">Detalhes</a>
                </li>
                <li data-prodtab-num="3" id="prod-reviews">
                    <a data-prodtab="#prod-tab-3" href="#">Avaliações <span>36</span></a>
                </li>
                <li class="prod-tabs-addreview">Adicionar uma avaliação</li>
            </ul>
            <div class="prod-tab-cont">
                <p data-prodtab-num="1" class="prod-tab-mob active" data-prodtab="#prod-tab-1">Descrição</p>
                <div class="prod-tab prod-tab-desc" id="prod-tab-1">
                    {!! $product->description !!}
                </div>
                <p data-prodtab-num="2" class="prod-tab-mob" data-prodtab="#prod-tab-2">Features</p>
                <div class="prod-tab" id="prod-tab-2">
                    <dl class="prod-tab-props">
                        @foreach($product->details as $detail)
                            <dt>{{ $detail->name }}</dt>
                            <dd>{{ $detail->description }}</dd>
                        @endforeach
                    </dl>
                </div>
                <p data-prodtab-num="3" class="prod-tab-mob" data-prodtab="#prod-tab-3">Avaliações</p>
                <div class="prod-tab prod-reviews" id="prod-tab-3">
                    <form action="#" class="prod-addreview-form" id="prod-addreview-form">
                        <p class="prod-tab-addreview">Adicionar sua avaliação</p>
                        <p class="prod-rating">
                            <i class="fa fa-star-o" title="5"></i><i class="fa fa-star-o" title="4"></i><i
                                class="fa fa-star-o" title="3"></i><i class="fa fa-star-o" title="2"></i><i
                                class="fa fa-star-o" title="1"></i>
                        </p>
                        <input type="text" name="name" placeholder="Name">
                        <input type="text" name="email" placeholder="E-mail">
                        <textarea name="message" placeholder="Mensagem"></textarea>
                        <input type="submit" value="Adicionar avaliação">
                    </form>
                    <div class="prod-review">
                        <h3>Douglas Harrison</h3>
                        <p class="prod-review-rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </p>
                        <p>Praesent libero dui, consequat nec placerat id, cursus at metus. <br>Donec semper velit eget
                            ex ultrices, eu lacinia nunc scelerisque. <br>Ut tincidunt magna sit amet felis dictum
                            efficitur.</p>
                    </div>
                    <div class="prod-review">
                        <h3>Douglas Harrison</h3>
                        <p class="prod-review-rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </p>
                        <p>Praesent libero dui, consequat nec placerat id, cursus at metus. <br>Donec semper velit eget
                            ex ultrices, eu lacinia nunc scelerisque. <br>Ut tincidunt magna sit amet felis dictum
                            efficitur.</p>
                    </div>
                    <div class="prod-review">
                        <h3>Douglas Harrison</h3>
                        <p class="prod-review-rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </p>
                        <p>Praesent libero dui, consequat nec placerat id, cursus at metus. <br>Donec semper velit eget
                            ex ultrices, eu lacinia nunc scelerisque. <br>Ut tincidunt magna sit amet felis dictum
                            efficitur.</p>
                    </div>
                    <div class="prod-review">
                        <h3>Douglas Harrison</h3>
                        <p class="prod-review-rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </p>
                        <p>Praesent libero dui, consequat nec placerat id, cursus at metus. <br>Donec semper velit eget
                            ex ultrices, eu lacinia nunc scelerisque. <br>Ut tincidunt magna sit amet felis dictum
                            efficitur.</p>
                    </div>
                    <p class="prod-review-more">
                        <a href="#">show more</a>
                    </p>
                </div>
                <p class="prod-tabs-addreview prod-tabs-addreview-mob">Add a review</p>
            </div>
        </div>
        <!-- Product Tabs - end -->

    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #check-zipcode {
            width: 100%;
        }

        .custom-button {
            border: 0;
            color: white;
            background: #ff3100;
            padding: 8px 20px;
            box-shadow: 0 0 2px #383838;
            margin-top: 5px;
            float: right;
        }
        body {
            background-color: #f4f5fb
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('js/search.js') }}"></script>
@endpush
