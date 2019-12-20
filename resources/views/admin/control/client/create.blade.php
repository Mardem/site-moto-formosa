@extends('layouts.admin-master')

@section('title')
    Criação de cliente
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Novo cliente</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.clients.store') }}" method="post">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card-header">
                                            <h4>Dados pessoais do cliente</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="name">Nome completo do cliente*</label>
                                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o nome do cliente" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="birthday">Data de nascimento*</label>
                                            <input class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}" type="date" id="birthday" name="birthday" placeholder="Data de nascimento" value="{{ old('birthday') }}" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('birthday') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="cpf_cnpj">CPF/CNPJ*</label>
                                            <input class="form-control {{ $errors->has('cpf_cnpj') ? ' is-invalid' : '' }}" type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite o CPF ou CNPJ" value="{{ old('cpf_cnpj') }}" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('cpf_cnpj') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="phone">Número de telefone*</label>
                                            <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="text" id="phone" name="phone" placeholder="Digite o número de telefone" value="{{ old('phone') }}" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="sex">Sexo*</label>
                                            <select name="sex" id="sex" class="form-control" required>
                                                <option value="M">Masculino</option>
                                                <option value="F">Feminino</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('sex') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card-header">
                                            <h4>Acesso a loja</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="email">Endereço de e-mail</label>
                                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" id="name" name="email" placeholder="Digite o endereço de e-mail" value="{{ old('email') }}" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="password">Senha</label>
                                            <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="Digite a senha" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right" for="password_confirmation">Confirmação da senha</label>
                                            <input class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" id="password_confirmation" name="password_confirmation" placeholder="Digite a senha novamente" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
    <script>
        Inputmask({"mask": ["999.999.999-99", "99.999.999/9999-99"]}).mask('#cpf_cnpj');
        Inputmask({"mask": ["(99) 9999-9999", "(99) 9 9999-9999"]}).mask('#phone');
    </script>
@endpush
