@extends('layouts.user-master')

@section('title')
    Minha área
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Área do cliente</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Clientes </h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Adicionar <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">

                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
