@extends('layouts.admin-master')

@section('title')
    Criação de categoria
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Nova categoria</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.categories-product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card-header">
                                            <h4>Informações da categoria</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="name">Nome da categoria*</label>
                                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o nome da categoria" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label" for="local">Selecione onde esta categoria será mostrada</label>
                                            <select name="local" id="local" class="form-control">
                                                @foreach(\App\Models\Admin\Product\CategoryProduct::CATEGORIES as $key => $category)
                                                    <option value="{{ $key }}">{{ ucfirst(strtolower($category)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-primary"><span>Adicionar</span></button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card-header">
                                            <h4>Imagem da categoria</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="col-form-label"></label>
                                            <input type="file" name="image" id="image" class="form-control">
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
    </script>
@endpush
