@include('layouts.principal.partials.header')
<!-- Header - start -->
<div class="header">
    @include('layouts.principal.partials.menu')
</div>
<!-- Header - end -->

<!-- Main Content - start -->
<main>
    @yield('content')
</main>
<!-- Main Content - end -->
@include('layouts.principal.partials.footer')
