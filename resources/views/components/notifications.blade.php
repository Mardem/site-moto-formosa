@if(Session::has('error'))
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
              integrity="sha256-f6fW47QDm1m01HIep+UjpCpNwLVkBYKd+fhpb4VQ+gE=" crossorigin="anonymous"/>
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
        <script>
            iziToast.show({
                title: 'Ops',
                message: "{{ Session::get('error') }}",
                theme: 'dark',
                backgroundColor: '#f72a07',
                color: '#fff',
                icon: 'ti-close',
                position: 'bottomCenter',
            });
        </script>
    @endpush
@endif

@if(Session::has('success'))
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"/>
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
        <script>
            iziToast.show({
                title: 'OK',
                message: "{{ Session::get('success') }}",
                theme: 'dark',
                backgroundColor: '#15aa60',
                color: '#fff',
                icon: 'ti-check',
                position: 'topCenter'
            });
        </script>
    @endpush
@endif
