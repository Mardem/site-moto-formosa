@extends('layouts.admin-master')

@section('title')
    Edição de produto &mdash; {{ $product->name }}
@endsection

@section('content')
    @include('components.notifications')

    <div id="ml-info"
         data-name="{{ $product->name }}"
         data-id="{{ $product->id }}"
         data-description="{{ strip_tags($product->description) }}"
         data-quantity="{{ $product->qtd }}"
         data-price="{{ $product->price }}"
         data-width="{{ $product->width }}"
         data-height="{{ $product->height }}"
         data-length="{{ $product->length }}"
         data-weight="{{ $product->weight }}"
         class="d-none"></div>
    <section class="section">
        <div class="section-header">
            <h1>Edição de produto &mdash; {{ $product->name }}</h1>
        </div>

        @if($product->ml_link == null)
            @if($product->images()->count() > 0)
                <h4>Antes de continuar insira esse produto no ML</h4>
                <div class="section-header">
                    <div class="col-sm-4">
                        <h1>Mercado Livre: </h1>
                        <button id="start-ml-session" class="btn btn-primary btn-sm ml-2" data-app="{{ config('mercadolivre.app_id') }}">Login</button>
                    </div>
                    <div class="col-sm-4">
                        <label for="category-ml">Selecione uma categoria</label>
                        <select id="category-ml" class="form-control"></select>
                    </div>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>Enviar produto para o Mercado Livre</strong> É necessário ao menos uma imagem para enviar o produto ao ML
                </div>
            @endif

            <div class="section-header d-none" id="div-ml">
                <div class="col-sm-4">
                    <a href="" id="edit-p-ml" target="_blank" class="btn btn-primary"> <i class="fa fa-link" style="font-size: 15px"></i> Editar produto no ML </a>
                    <a href="" id="view-p-ml" target="_blank" class="btn btn-primary"> <i class="fa fa-eye" style="font-size: 15px"></i> Ver produto no ML </a>
                </div>
            </div>
        @else
            <div class="section-header">
                <div class="col-sm-4">
                    <a href="{{ $product->ml_link_edit }}" target="_blank" class="btn btn-primary"> <i class="fa fa-link" style="font-size: 15px"></i> Editar produto no ML </a>
                    <a href="{{ $product->ml_link }}" target="_blank" class="btn btn-primary"> <i class="fa fa-eye" style="font-size: 15px"></i> Ver produto no ML </a>
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-header">
                                        <h4>Info. do produto</h4>
                                    </div>
                                    <br>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1. Info. do produto</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">2. Info. da categoria</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="profile" aria-selected="false">3. Frete</a>
                                        </li>
                                    </ul>

                                    <form action="{{ route('admin.products.update', $product->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                                <div class="form-group">
                                                    <label class="col-form-label text-md-right" for="name">Nome do produto*</label>
                                                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ $product->name }}" placeholder="Digite o nome do produto" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>

                                                    <br>
                                                    <label class="col-form-label text-md-right" for="keywords">Palavras chaves*</label>
                                                    <input type="text" name="keywords" id="keywords" data-role="tagsinput" rows="1" class="form-control" required placeholder="Coloque aqui todas as palavras chaves desse produto"
                                                           value="{{ $product->keywords }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('keywords') }}
                                                    </div>
                                                    <label class="col-form-label text-md-right" for="seo_description">Descrição básica*</label>
                                                    <textarea name="seo_description" id="seo_description" style="height: 100px;" class="form-control" required placeholder="Digite uma descrição para o SEO"
                                                              maxlength="165">{{ $product->seo_description }}</textarea>
                                                    <span id="chars">165</span> caracteres restantes
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('seo_description') }}
                                                    </div>
                                                    <br>
                                                    <label class="col-form-label text-md-right" for="price">Valor do produto* (R$ {{ number_format($product->price, 2, ',', '.') }})</label>
                                                    <input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }} numeric" type="text" name="price" placeholder="Valor do produto (deixe em branco para manter o antigo)"
                                                           data-prefix="R$ "
                                                           data-mask="{{ $product->price }}" data-thousands="." data-decimal=",">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('price') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="form-group">

                                                    <label class="col-form-label text-md-right" for="local">Onde o produto ficará?*</label>
                                                    <small>Selecione o local onde este produto ficará na loja</small>
                                                    <select name="local" id="local" class="form-control">
                                                        <optgroup label="Opção selecionada">
                                                            <option value="{{ $product->local }}">{{ $product->local_formatted }}</option>
                                                        </optgroup>
                                                        <optgroup label="Outras opções">
                                                            <option value="{{ array_search('DEFAULT', \App\Models\Admin\Product\Product::LOCAL) }}">Padrão</option>
                                                            <option value="{{ array_search('SPECIAL', \App\Models\Admin\Product\Product::LOCAL) }}">Especial</option>
                                                            <option value="{{ array_search('POPULAR', \App\Models\Admin\Product\Product::LOCAL) }}">Popular</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('local') }}
                                                    </div>

                                                    <label class="col-form-label text-md-right" for="category_product_id">Categoria do produto*</label>
                                                    <select name="category_product_id" id="category_product_id" class="form-control">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $product->category_product_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('description') }}
                                                    </div>

                                                    <label class="col-form-label text-md-right" for="qtd">Quantidade de produtos em estoque*</label>
                                                    <input type="number" min="0" class="form-control" name="qtd" id="qtd" value="{{ $product->qtd ?? 0 }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('qtd') }}
                                                    </div>

                                                    <label class="col-form-label text-md-right" for="description">Descrição completa*</label>
                                                    <textarea name="description" id="description" style="height: 100px;" class="editor form-control" required placeholder="Digite uma descrição para o SEO"
                                                              maxlength="165">{{ $product->description }}</textarea>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Frete --}}
                                            <div class="tab-pane fade show active" id="shipping" role="tabpanel" aria-labelledby="home-tab">

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="col-form-label text-md-right" for="width">Largura do produto <i>(cm)</i></label>
                                                        <input class="form-control {{ $errors->has('width') ? ' is-invalid' : '' }}" type="text" name="width" placeholder="Largura do produto" value="{{ $product->width }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label text-md-right" for="height">Altura do produto <i>(cm)</i></label>
                                                        <input class="form-control {{ $errors->has('height') ? ' is-invalid' : '' }}" type="text" name="height" placeholder="Altura do produto" value="{{ $product->height }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label text-md-right" for="length">Comprimento do produto <i>(cm)</i></label>
                                                        <input class="form-control {{ $errors->has('length') ? ' is-invalid' : '' }}" type="text" name="length" placeholder="Comprimento do produto" value="{{ $product->length }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label text-md-right" for="weight">Peso do produto <i>(g)</i></label>
                                                        <input class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}" type="text" name="weight" placeholder="Peso do produto" value="{{ $product->weight }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="col-sm-12 text-center">
                                                <button class="btn btn-primary"><span>Atualizar</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card-header">
                                        <h4>
                                            Detalhes do produto
                                        </h4>
                                    </div>
                                    <br>

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#desc-home" role="tab" aria-controls="desc-home" aria-selected="true">Descrições</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#desc-new" role="tab" aria-controls="profile" aria-selected="false">Novo detalhe</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="desc-home" role="tabpanel" aria-labelledby="home-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Conteúdo</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($details as $detail)
                                                    <tr>
                                                        <th scope="row">{{ $detail->id }}</th>
                                                        <td>{{ $detail->name }}</td>
                                                        <td>{{ $detail->description }}</td>
                                                        <td class="text-right">
                                                            <a href="#" class="btn btn-danger btn-xs" id="btn-{{ $detail->id }}" onclick="deleteItem('btn-{{ $detail->id }}')" data-form-id="form-{{ $detail->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <form action="{{ route('admin.details-product.destroy', $detail->id) }}" method="post" id="form-{{ $detail->id }}" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <a href="{{ route('admin.details-product.edit', $detail->id) }}" class="btn btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $details->links() }}
                                        </div>
                                        <div class="tab-pane fade" id="desc-new" role="tabpanel" aria-labelledby="desc-new">
                                            <div class="section-title" style="margin-top: 0">Criar um novo detalhe</div>
                                            <form action="{{ route('admin.details-product.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="form-group">
                                                    <label for="name_detail">Nome do detalhe</label>
                                                    <input type="text" id="name_detail" class="form-control" name="name" placeholder="Digite o nome do detalhe" value="{{ old('name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_detail">Descrição do detalhe</label>
                                                    <input type="text" id="description_detail" class="form-control" name="description" placeholder="Conteúdo do detalhe" value="{{ old('description') }}">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary">Criar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Imagens do produto</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            <a class="btn btn-primary" data-toggle="collapse" href="#newImage" role="button" aria-expanded="false" aria-controls="newImage">
                                Nova imagem
                            </a>
                        </p>
                        <div class="collapse" id="newImage">
                            <div class="col-sm-6">
                                <div class="card card-body">
                                    <form action="{{ route('admin.images-product.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <label for="image_path">Enviar nova imagem</label>
                                        <input type="file" name="image_path" id="image_path" class="form-control">

                                        <label for="principal" class="mt-2">Imagem principal?</label>
                                        <select name="principal" id="principal" class="form-control">
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                        <button class="btn btn-primary mt-3">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($images as $image)
                                <div class="col-sm-3">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top img-ml" src="{{ asset($image->path) }}" alt="Card image cap">
                                        <div class="card-body">
                                            @if($image->principal == 1)
                                                <h5 class="card-title text-center">
                                                    <i class="ti ti-star"></i> Imagem principal <i class="ti ti-star"></i>
                                                </h5>
                                            @endif
                                            <a href="#" class="btn btn-danger" id="btn-image-{{ $image->id }}" onclick="deleteItem('btn-image-{{ $image->id }}')" data-form-id="form-image-{{ $image->id }}"><i class="ti ti-trash"></i> Apagar</a>

                                            <form action="{{ route('admin.images-product.destroy', $image->id) }}" method="post" id="form-image-{{ $image->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <style>
        .bootstrap-tagsinput {
            width: 100% !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://static.mlstatic.com/org-img/sdk/mercadolibre-1.0.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
    <script src="{{ asset('js/ml.js') }}"></script>
    <script src="{{ asset('js/load-categories-ml.js') }}"></script>
    <script>
        $(function () {
            $('.numeric').maskMoney();
            $('.editor').summernote({
                placeholder: 'Escreva sua descrição aqui',
                tabsize: 2,
                height: 100
            });
            $('#keywords').tagsinput({
                tagClass: 'big'
            });
        });
    </script>
@endpush
