@extends('layouts.admin-master')

@section('title')
    Criação de produto
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Novo produto</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.products.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1. Info. do produto</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">2. Info. da categoria</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label text-md-right" for="name">Nome do produto*</label>
                                                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o nome do produto" required>
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                            <label class="col-form-label text-md-right" for="seo_description">Descrição básica*</label>
                                                            <textarea name="seo_description" id="seo_description" style="height: 100px;" class="form-control" required placeholder="Digite uma descrição para o SEO" maxlength="165">{{ old('seo_description') }}</textarea>
                                                            <span id="chars">165</span> caracteres restantes
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('seo_description') }}
                                                            </div>
                                                            <br>
                                                            <label class="col-form-label text-md-right" for="keywords">Palavras chaves*</label>
                                                            <textarea name="keywords" id="keywords" data-role="tagsinput"  rows="1" class="form-control" required placeholder="Coloque aqui todas as palavras chaves desse produto" maxlength="165">{{ old('keywords') }}</textarea>
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('keywords') }}
                                                            </div>
                                                            <br>
                                                            <label class="col-form-label text-md-right" for="price">Valor do produto*</label>
                                                            <input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }} numeric" type="text" name="price" placeholder="Valor do produto (deixe em branco para manter o antigo)" data-prefix="R$ "
                                                                   data-thousands="." data-decimal=",">
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('price') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <p class="mb-0">Insira o tamanho do produto com a caixa.</p>
                                                        <div class="form-group">
                                                            <label class="col-form-label text-md-right" for="width">Largura do produto <i>(cm)</i></label>
                                                            <input class="form-control {{ $errors->has('width') ? ' is-invalid' : '' }}" type="text" name="width" placeholder="Largura do produto"  data-prefix="" data-thousands="." data-decimal=".">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label text-md-right" for="height">Altura do produto <i>(cm)</i></label>
                                                            <input class="form-control {{ $errors->has('height') ? ' is-invalid' : '' }}" type="text" name="height" placeholder="Altura do produto"  data-prefix="" data-thousands="." data-decimal=".">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label text-md-right" for="length">Comprimento do produto <i>(cm)</i></label>
                                                            <input class="form-control {{ $errors->has('length') ? ' is-invalid' : '' }}" type="text" name="length" placeholder="Comprimento do produto"  data-prefix="" data-thousands="." data-decimal=".">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label text-md-right" for="weight">Peso do produto <i>(g)</i></label>
                                                            <input class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}" type="text" name="weight" placeholder="Peso do produto"  data-prefix="" data-thousands="." data-decimal=".">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="form-group">

                                                    <label class="col-form-label text-md-right" for="local">Onde o produto ficará?*</label>
                                                    <small>Selecione o local onde este produto ficará na loja</small>
                                                    <select name="local" id="local" class="form-control">
                                                        <option value="{{ array_search('DEFAULT', \App\Models\Admin\Product\Product::LOCAL) }}">Padrão</option>
                                                        <option value="{{ array_search('SPECIAL', \App\Models\Admin\Product\Product::LOCAL) }}">Especial</option>
                                                        <option value="{{ array_search('POPULAR', \App\Models\Admin\Product\Product::LOCAL) }}">Popular</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('local') }}
                                                    </div>

                                                    <label class="col-form-label text-md-right" for="category_product_id">Categoria do produto*</label>
                                                    <select name="category_product_id" id="category_product_id" class="form-control">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('description') }}
                                                    </div>

                                                    <label class="col-form-label text-md-right" for="qtd">Quantidade de produtos em estoque*</label>
                                                    <input type="number" min="0" class="form-control" name="qtd" id="qtd" value="{{ old('qtd') ?? 0 }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('qtd') }}
                                                    </div>

                                                    <label class="col-form-label text-md-right" for="description">Descrição completa*</label>
                                                    <textarea name="description" id="description" style="height: 100px;" class="editor form-control" required placeholder="Digite uma descrição para o SEO" maxlength="165">{{ old('description') }}</textarea>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn-primary"><span>Adicionar</span></button>
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
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <style>
        .bootstrap-tagsinput {
            width: 100% !important;
        }
        .bootstrap-tagsinput .tag {
            color: #fff !important;
        }
    </style>
@endpush
@push('js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('js/product/create.js') }}"></script>
@endpush
