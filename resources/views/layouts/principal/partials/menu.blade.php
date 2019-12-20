@inject('categoriesMenu', 'App\Models\Admin\Product\CategoryProduct')

<!-- Navmenu Mobile Toggle Button -->
<a href="#" class="header-menutoggle" id="header-menutoggle">Menu</a>

<div class="header-info">

{{--    <!-- Personal Menu -->--}}
{{--    <div class="header-personal">--}}
{{--        <a href="#" class="header-gopersonal"></a>--}}
{{--        @guest--}}
{{--            <ul>--}}
{{--                <li><a href="{{ route('login') }}">Fazer login</a></li>--}}
{{--                <li><a href="{{ route('register') }}">Criar uma conta</a></li>--}}
{{--            </ul>--}}
{{--        @else--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="message.html">Notificações <span>12</span></a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">Endereços <span>6</span></a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">Configurações</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">Sair</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        @endguest--}}
{{--    </div>--}}

{{--    <!-- Small Cart -->--}}
{{--    <a href="{{ route('cart') }}" class="header-cart">--}}
{{--        <div class="header-cart-inner">--}}
{{--            <p class="header-cart-count">--}}
{{--                <img src="{{ asset('commerce/img/cart.png') }}" alt="">--}}
{{--                <span id="quantity-cart"></span>--}}
{{--            </p>--}}
{{--            <p class="header-cart-summ" id="cart-value">R$ 0,00</p>--}}
{{--        </div>--}}
{{--    </a>--}}

    <!-- Search Form -->
    <a href="#" class="header-searchbtn" id="header-searchbtn"></a>
    <form action="{{ route('catalog.index') }}" class="header-search" id="header-search">
        <input type="text" name="q" placeholder="Busque o que você precisa aqui">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>

</div>

<!-- Logotype -->
<p class="header-logo">
    <a href="{{ route('home-site') }}"><img src="{{ asset('commerce/img/moto-formosa-white.png') }}" alt=""></a>
</p>

<!-- Navmenu - start -->
<nav id="top-menu">
    <ul>
        <li class="active">
            <a href="{{ route('home-site') }}">Home</a>
        </li>
        <li class="has-child">
            <a href="#">Categorias</a>
            <i class="fa fa-angle-down"></i>
            <ul>
                @foreach($categoriesMenu->all() as $category)
                    <li><a href="{{ route('search.byCategory', ['category-name' => $category->name, 'category' => $category->id]) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="has-child">
            <a href="https://www.motoformosa.com.br/sobre">Sobre</a>
        </li>
        <li class="has-child">
            <a href="https://www.motoformosa.com.br/blog">Blog</a>
        </li>
        <li class="has-child">
            <a href="https://www.motoformosa.com.br/contato">Contato</a>
        </li>
    </ul>
</nav>
<!-- Navmenu - end -->
