@extends('layouts.principal.main')

@section('content')
    <div class="b-crumbs-wrap">
        <div class="cont b-crumbs">
            <ul>
                <li>
                    <a href="{{ route('home-site') }}">Moto Formosa</a>
                </li>
                <li>
                    <a href="{{ route('catalog.index') }}">Catálogo</a>
                </li>
                @if(request()->has('q'))
                    <li>
                        <span>{{ request('q') }}</span>
                    </li>
                @else
                @endif
            </ul>
            <div class="b-crumbs-menu">
                <a id="b-crumbs-menu" href="#"></a>
                <ul class="b-crumbs-menulist">
                    <li><a href="{{ route('home-site') }}">Voltar</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cont maincont">

        <h1><span>{{ request()->has('q') != null ? request('q') : '' }}</span></h1>
        <p class="section-count">4535 ITENS ENCONTRADOS</p>
        <span class="maincont-line1 maincont-line12"></span>
        <span class="maincont-line2 maincont-line22"></span>

        <!-- Catalog Sections -->
        <ul class="cont-sections">
            <li class="active">
                <a href="#">Tudo</a>
            </li>
            <li>
                <a href="#">Suspensions</a>
            </li>
            <li>
                <a href="#">Breaks</a>
            </li>
            <li>
                <a href="#">Instruments</a>
            </li>
            <li>
                <a href="#">Filters</a>
            </li>
            <li>
                <a href="#">Boots</a>
            </li>
        </ul>

        <!-- Catalog Filter - start -->
        <div class="section-top">
            <a href="#" class="section-menu-btn" id="section-menu-btn" style="width: 175px;">Catálogo</a>
            <div class="section-sort">
                <p>Ordenar</p>
                <div class="dropdown-wrap">
                    <p class="dropdown-title section-sort-ttl">Price: highest first</p>
                    <ul class="dropdown-list" style="">
                        <li class="active">
                            <a href="#">Price: highest first</a>
                        </li>
                        <li>
                            <a href="#">Price: lowest first</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section-menu-wrap" id="section-menu-wrap" style="display: none;">
                <div class="section-menu">
                    <p class="section-menu-ttl">Main Parts</p>
                    <ul class="section-menu-list">
                        <li><a href="#">Engines</a></li>
                        <li><a href="#">Brakes &amp; Clutch</a></li>
                        <li><a href="#">Handlebars &amp; Grips</a></li>
                        <li><a href="#">Chains &amp; Sprockets</a></li>
                        <li><a href="#">Electrical</a></li>
                        <li><a href="#">Filters</a></li>
                        <li><a href="#">Levers</a></li>
                        <li><a href="#">Tires</a></li>
                    </ul>
                </div>
                <div class="section-menu">
                    <p class="section-menu-ttl">Clothing</p>
                    <ul class="section-menu-list">
                        <li><a href="#">Gloves</a></li>
                        <li><a href="#">Goggles</a></li>
                        <li><a href="#">Helmets</a></li>
                        <li><a href="#">Jackets</a></li>
                        <li><a href="#">Pants</a></li>
                        <li><a href="#">Casual Wear</a></li>
                        <li><a href="#">Protective Gear</a></li>
                    </ul>
                </div>
                <div class="section-menu">
                    <p class="section-menu-ttl">Brands</p>
                    <ul class="section-menu-list">
                        <li><a href="#">EdgeDesign</a></li>
                        <li><a href="#">Storm</a></li>
                        <li><a href="#">BestWorks</a></li>
                        <li><a href="#">HarleyStore</a></li>
                        <li><a href="#">GoodTires</a></li>
                        <li><a href="#">EngineMasters</a></li>
                        <li><a href="#">EnMonsters</a></li>
                    </ul>
                </div>
                <div class="section-menu">
                    <p class="section-menu-ttl">Accessories</p>
                    <ul class="section-menu-list">
                        <li><a href="#">Battery Chargers</a></li>
                        <li><a href="#">Electrical</a></li>
                        <li><a href="#">Tools</a></li>
                        <li><a href="#">Tie Downs</a></li>
                    </ul>
                </div>
                <div class="section-menu">
                    <p class="section-menu-ttl">Maintenance</p>
                    <ul class="section-menu-list">
                        <li><a href="#">Repair Instruments</a></li>
                        <li><a href="#">Brakes &amp; Clutch Parts</a></li>
                        <li><a href="#">Cleaners &amp; Chemicals</a></li>
                        <li><a href="#">Spark Plugs</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Catalog Filter - end -->

        <!-- Catalog Items - start -->
        <div class="section-list">
            @foreach($products as $product)
                <div class="sectls">
                    <a href="{{ route('catalog.show', $product->slug) }}" class="sectls-img">
                        <img src="{{ asset($product->images()->where('principal', '=', 1)->first()->path ?? 'commerce/img/moto-formosa.png') }}" alt="">
                    </a>
                    <div class="sectls-cont">
                        <div class="sectls-ttl-wrap">
                            <p><a href="#">{{ $product->category->name }}</a></p>
                            <h3><a href="{{ route('catalog.show', $product->slug) }}">{{ $product->name }}</a></h3>
                        </div>
                        <div class="sectls-price-wrap">
                            <p>Preço</p>
                            <p class="sectls-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                        <div class="sectls-qnt-wrap">
                            <p>Quantidade</p>
                            <p class="qnt-wrap sectls-qnt">
                                <a href="#" class="qnt-minus sectls-minus">-</a>
                                <input type="text" value="1">
                                <a href="#" class="qnt-plus sectls-plus">+</a>
                            </p>
                        </div>
                    </div>
                    <div class="sectls-info">
                        <div class="sectls-rating-wrap text-center">
                            <p class="sectls-rating">
                                <i class="fa fa-star-o" title="5"></i><i class="fa fa-star-o" title="4"></i><i class="fa fa-star-o" title="3"></i><i class="fa fa-star-o" title="2"></i><i class="fa fa-star-o" title="1"></i>
                            </p>

                        </div>
                        <p class="sectls-id">#{{ $product->id }}</p>
                        <p class="sectls-add">
                            <a href="#">Adicionar</a>
                        </p>
                        <p class="sectls-favorites">
                            <a href="#"></a>
                        </p>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}
        </div>
        <!-- Catalog Items - end -->

        <!-- Pagination -->

    </div>
    <div class="getspec-wrap">
        <div class="cont getspec">
            <div class="getspec-cont">
                <h3>Winter is coming</h3>
                <p>New snowmobile parts</p>
                <form action="#">
                    <input type="text" placeholder="Email address">
                    <input type="submit" value="Get a special deals">
                </form>
            </div>
            <a href="#" class="getspec-img">
                <img src="{{ asset('commerce/img/getspec.jpg') }}" alt="">
            </a>
        </div>
    </div>
@endsection
