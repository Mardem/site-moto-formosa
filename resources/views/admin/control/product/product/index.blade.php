@extends('layouts.admin-master')

@section('title')
    Administração &mdash; Produtos
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Administração &mdash; Produtos</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Produtos <span>({{ $products->total() }})</span></h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Adicionar <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-md">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Qtd. estoque</th>
                                    <th>Categoria</th>
                                    <th>Local</th>
                                    <th>Registrado em</th>
                                    <th></th>
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><span class="badge badge-light">{{ $product->name }}</span></td>
                                        <td><span class="badge badge-success">R$ {{ number_format($product->price, 2, ',', '.') }}</span></td>
                                        <td>{!! $product->status_amount !!}</td>
                                        <td><a href="{{ route('admin.categories-product.edit', $product->category->id) }}" target="_blank"><i class="ti ti-new-window"></i> {{ $product->category->name }}</a></td>
                                        <td>{{ $product->local_formatted }}</td>
                                        <td>{{ $product->created_at_formatted }}</td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-danger btn-xs" id="btn-{{ $product->id }}" onclick="deleteItem('btn-{{ $product->id }}')" data-form-id="form-{{ $product->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" id="form-{{ $product->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $products->links() }}
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
