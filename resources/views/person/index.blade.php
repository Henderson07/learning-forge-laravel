@extends('layouts.app')
@section('title', 'Listagem de pessoas')

@section('content')
    <div class="page-wrapper col-sm-12">
        <table class="table table-responsive table-outline">
            <caption>
            <tr>
                <td class="d-flex">
                    <span class="text-muted">Listagem de pessoas</span>
                    <a data-toggle="modal" data-target="#create-modal" class="form-control btn btn-primary ms-auto">
                        Adicionar
                    </a>
                </td>
            </tr>
            </caption>
            <thead></thead>
            <tbody>
                <tr>
                    <td>
                        Sem itens na tabela
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="form-group-sb">
        </div>
    </div>

    {{-- Modal section --}}
    @include('person.partials.create_modal')
    {{-- /Modal section --}}
@endsection
@section('javascript')
    <script src="{{ asset('js/person.js') }}"></script>
@endsection
