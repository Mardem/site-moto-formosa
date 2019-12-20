@extends('layouts.principal.main')

@section('content')
    <!-- Special Deals Items -->
    <div class="specials-wrap">
        <div class="cont specials">
            <h2>Ofertas especiais</h2>
            <p class="specials-count">itens</p>
            <div class="specials-list">
                <div class="special special-pseudo">
                    <a href="#" class="special-link"></a>
                </div>
                @foreach($specialProducts as $key => $special)
                    <div class="special {{ $key == 0 ? 'special-first' : '' }}">
                        <a href="{{ route('catalog.show', $special->slug) }}" class="special-link">
                            <p class="special-img">
                                <img src="{{ asset($special->images()->where('principal', '=', 1)->first()->path ?? 'commerce/img/moto-formosa.png') }}" alt="{{ $special->name }}">
                            </p>
                            <h3><span>{{ $special->name }}</span></h3>
                        </a>
                        <p class="special-info">
                            <a href="{{ route('catalog.index', ['category' => $special->category->id]) }}" class="special-categ">{{ $special->category->name }}</a>
                            <span class="special-price">R$ {{ number_format($special->price, 2, ',', '.') }}</span>
                                @if($special->promocional_price != null)
                                <del>300</del>
                                @endif
                            <a href="#" class="special-add">+ Carrinho</a>
                        </p>
                    </div>
                @endforeach
            </div>
            <span class="special-line1"></span>
            <span class="special-line2"></span>
        </div>
    </div>



    <!-- Get a Special Deals -->
    <div class="getspec-wrap">
        <div class="cont getspec">
            <div class="getspec-cont">
                <h3>Melhores promoções</h3>
                <p>É só para os exclusivos</p>
                <form action="#" class="form-validate">
                    <input data-required="text" data-required-email="email" type="text" placeholder="Seu e-mail" name="email">
                    <input type="submit" value="Quero ser exclusivo">
                </form>
            </div>
            <a href="#" class="getspec-img">
                <img src="{{ asset('images/home/banner-1.jpg') }}" alt="">
            </a>
        </div>
    </div>



    <!-- Popular Items -->
    <div class="populars-wrap">
        <div class="cont populars">
            <h2>Popular</h2>
            <p class="populars-count">itens</p>
            <div class="populars-list">
                @foreach($popularProducts as $popular)
                    <div class="popular">
                        <a href="{{ route('catalog.show', $popular->slug) }}" class="popular-link">
                            <p class="popular-img">
                                <img src="{{ asset($popular->images()->first()->path ?? 'commerce/img/moto-formosa.png') }}" alt="">
                            </p>
                            <h3><span>{{ $popular->name }}</span></h3>
                        </a>
                        <p class="popular-info">
                            <a href="{{ route('catalog.index', ['category' => $special->category->id]) }}" class="popular-categ">{{ $popular->category->name }}</a>
                            <span class="popular-price">R$ {{ number_format($popular->price, 2, ',', '.') }}</span>
                            <a href="#" class="popular-add">+ Adicionar</a>
                        </p>
                    </div>
                @endforeach
            </div>
            <span class="popular-line1"></span>
            <span class="popular-line2"></span>
        </div>
    </div>

    <!-- Frontpage Article -->
    <div class="botarticle-wrap">
        <div class="cont botarticle">
            <div class="botarticle-cont">
                <h3>Tudo o que você precisa</h3>
                <p>Encontre aqui</p>
                <a href="#" class="botarticle-more">Procurar</a>
            </div>
            <a href="#" class="botarticle-img">
                <img src="{{ asset('images/home/banner-2.jpg') }}" alt="">
            </a>
        </div>
    </div>


@endsection
