@extends('layouts.admin-master')

@section('title')
    Edição de detalhe &mdash; {{ $detail->name }}
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Edição de detalhe &mdash; {{ $detail->name }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-header">
                                        <h4>Info. do detalhe</h4>
                                    </div>
                                    <br>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1. Info. do detalhe</a>
                                        </li>
                                    </ul>

                                    <form action="{{ route('admin.details-product.update', $detail->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                                <div class="form-group">
                                                    <label class="col-form-label text-md-right" for="name">Nome do detalhe*</label>
                                                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ $detail->name }}" placeholder="Digite o nome do detalhe" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label text-md-right" for="description">Conteúdo do detalhe*</label>
                                                    <input class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" type="text" id="description" name="description" value="{{ $detail->description }}" placeholder="Conteúdo do detalhe" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('description') }}
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
                                    <a href="{{ route('admin.products.edit', $detail->product->id) }}" class="btn btn-primary float-right"><i class="ti ti-angle-double-left"></i> Voltar para o produto</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endpush
@push('js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
