@extends('layouts.admin-master')

@section('title')
    Edição de categoria &mdash; {{ $category->name }}
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Editar &mdash; {{ $category->name }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.categories-product.update', $category->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6 offset-sm-3">
                                        <div class="card-header">
                                            <h4>Informações da categoria</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="name">Nome da categoria*</label>
                                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ $category->name }}" placeholder="Digite o nome da categoria" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn-primary"><span>Atualizar</span></button>
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
