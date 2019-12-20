

<!-- Footer - start -->
<footer class="footer">
    <div class="copyright">
        <p class="cont">Todos os direitos reservados &copy; {{ env('APP_NAME') }}</p>
    </div>
</footer>
<!-- Footer - end -->
<script src="//cdn.rawgit.com/lil-js/uuid/0.1.0/uuid.js"></script>
<script src="{{ asset('commerce/js/jquery-1.12.3.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
<script src="{{ asset('commerce/js/fancybox/fancybox.js') }}"></script>
<script src="{{ asset('commerce/js/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
<script src="{{ asset('commerce/js/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('commerce/js/masonry.pkgd.min.js') }}"></script>

<script src="{{ asset('commerce/js/jquery.fractionslider.min.js') }}"></script>
<script src="{{ asset('commerce/js/ion.rangeSlider.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="{{ asset('commerce/js/main.js') }}"></script>
<script src="{{ asset('commerce/js/helpers/cartFunctions.js') }}"></script>
<script src="{{ asset('commerce/js/cart.js') }}" type="module"></script>

@stack('js')
<script>
    "use strict";
    // Range Slider
    $(document).ready(function () {
        var $range_cost = $("#range_cost");
        $range_cost.ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 20000,
            from: 200,
            to: 14000,
            prefix: "R$",
        });
        $range_cost.on("change", function () {
            var $this = $(this),
                value = $this.prop("value").split(";");

            $('#range_cost_ttl').html("$" + value[0] + " - $" + value[1]);
        });
        var $range_year = $("#range_year");
        $range_year.ionRangeSlider({
            type: "double",
            grid: true,
            min: 1990,
            max: 2016,
            from: 2013,
            to: 2016,
        });
        $range_year.on("change", function () {
            var $this = $(this),
                value = $this.prop("value").split(";");

            $('#range_year_ttl').html(value[0] + " - " + value[1]);
        });
    });

</script>

</body>

</html>
