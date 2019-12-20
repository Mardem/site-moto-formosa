@extends('layouts.user-master')

@section('title')
    Criação de endereços
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Novo endereço</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('address.store') }}" method="post">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6 offset-md-3">
                                        <div class="card-header text-center">
                                            <h4>Informações para entrega</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cep">CEP:</label>
                                            <input class="form-control" type="text" name="zipcode" value="" size="10">
                                        </div>
                                        <div class="form-group">
                                            <label for="street">Rua:</label>
                                            <input class="form-control" type="text" name="street" value="" size="90">
                                        </div>
                                        <div class="form-group">
                                            <label for="neighborhood">Bairro:</label>
                                            <input class="form-control" type="text" name="neighborhood" value="" size="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Cidade:</label>
                                            <input class="form-control" type="text" name="city" value="" size="40">
                                        </div>
                                        <div class="form-group">
                                            <label for="uf">UF:</label>
                                            <input class="form-control" type="text" name="uf" value="" size="2">
                                        </div>
                                        <div class="form-group">
                                            <label for="uf">Número:</label>
                                            <input class="form-control" type="text" name="number" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="uf">Complemento (opcional)</label>
                                            <input class="form-control" type="text" name="complement" value="">
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-primary"><span>Adicionar</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
    <script>
        Inputmask({"mask": ["999.999.999-99", "99.999.999/9999-99"]}).mask('#cpf_cnpj');
        Inputmask({"mask": ["(99) 9999-9999", "(99) 9 9999-9999"]}).mask('#phone');

        (function() {
            $('input[name="zipcode"]').blur(function(e) {
                let cep = $('input[name="zipcode"]').val() || '';

                if (!cep) {
                    return
                }

                let url = 'http://viacep.com.br/ws/' + cep + '/json';
                $.getJSON(url, function(data) {
                    if ("error" in data) {
                        return
                    }
                    $('input[name="street"]').val(data.logradouro)
                    $('input[name="neighborhood"]').val(data.bairro)
                    $('input[name="city"]').val(data.localidade)
                    $('input[name="uf"]').val(data.uf)
                })
            })
        })()
    </script>
@endpush
