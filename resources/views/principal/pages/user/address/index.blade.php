@extends('layouts.user-master')

@section('title')
    Meus endereços
@endsection

@section('content')
    @include('components.notifications')
    <section class="section">
        <div class="section-header">
            <h1>Meus endereços</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Endereços </h4>
                            <div class="card-header-action">
                                <a href="{{ route('address.create') }}" class="btn btn-primary">Adicionar <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-md">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Endereço</th>
                                    <th></th>
                                </tr>
                                @foreach($addresses as $address)
                                    <tr>
                                        <td>{{ $address->id }}</td>
                                        <td><span class="badge badge-light">
                                                {{ $address->street }}, {{ $address->neighborhood }} nº {{ $address->number }} &mdash; {{ $address->city }}/{{ $address->uf }}
                                            </span></td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-danger btn-xs" id="btn-{{ $address->id }}" onclick="deleteItem('btn-{{ $address->id }}')" data-form-id="form-{{ $address->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('address.destroy', $address->id) }}" method="post" id="form-{{ $address->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ route('address.edit', $address->id) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
