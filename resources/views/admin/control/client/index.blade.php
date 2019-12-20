@extends('layouts.admin-master')

@section('title')
    Administração de clientes
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Administração de clientes</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Clientes <span>({{ $clients->total() }})</span></h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Adicionar <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-md">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Registrado em</th>
                                    <th></th>
                                </tr>
                                @foreach($clients as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td><span class="badge badge-light">{{ $category->name }}</span></td>
                                        <td>{{ $category->created_at_formatted }}</td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-danger btn-xs" id="btn-{{ $category->id }}" onclick="deleteItem('btn-{{ $category->id }}')" data-form-id="form-{{ $category->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('admin.clients.destroy', $category->id) }}" method="post" id="form-{{ $category->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ route('admin.clients.edit', $category->id) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $clients->links() }}
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
