@extends('layouts.admin-master')

@section('title')
    Edição de categoria ({{ $category->name }})
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header"> <h1>Edição de categoria &mdash; {{ $category->name }}</h1>

        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Categoria </h4>
                        </div>

                        <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome da categoria</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" value="{{ $category->name }}" name="name" placeholder="Digite o nome da categoria">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
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
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
@endpush
