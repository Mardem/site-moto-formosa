<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">MF</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
        @if(Auth::user()->can('manage-users'))
            <li class="menu-header">Controle</li>
            <li class="{{ currentActiveMenu('admin/users*') }}"><a class="nav-link" href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span>Usuários</span></a></li>
            <li class="{{ currentActiveMenu('admin/control/clients*') }}"><a class="nav-link" href="{{ route('admin.clients.index') }}"><i class="fa fa-users"></i> <span>Clientes</span></a></li>
            <li class="menu-header">Controle de produtos</li>
            <li class="dropdown {{ currentActiveMenu('admin/control/product*') }}">
                <a href="#" class="nav-link has-dropdown"><i class="ti ti-shopping-cart"></i> <span>Produtos</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ currentActiveMenu('admin/control/product/categories-product*') }}"><a class="nav-link" href="{{ route('admin.categories-product.index') }}"><span>1. Categorias</span></a></li>
                    <li class="{{ currentActiveMenu('admin/control/product/products*') }}"><a class="nav-link" href="{{ route('admin.products.index') }}"><span>2. Produtos</span></a></li>
                </ul>
            </li>
        @endif
    </ul>
</aside>
