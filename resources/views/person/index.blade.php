@extends('layouts.app')
@section('title', 'Listagem de pessoas')

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Pessoas</h1>

        <!-- Botão Criar -->
        <div class="mb-3 text-end">
            <a data-toggle="modal" data-target="#create-modal" class="btn btn-primary ms-auto">
                Adicionar
            </a>
        </div>

        <!-- Tabela com dados mockados -->
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th class="text-center" style="width: 200px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>João da Silva</td>
                    <td>123.456.789-00</td>
                    <td class="text-center">
                        <a data-toggle="modal" data-target="#edit-modal" class="btn btn-warning ms-auto">
                            Editar
                        </a>
                        <a data-toggle="modal" data-target="#delete-confirm-modal" class="btn btn-danger ms-auto">
                            Apagar
                        </a>
                        {{-- <button class="btn btn-danger btn-sm">Apagar</button> --}}
                    </td>
                </tr>
                <tr>
                    <td>Empresa Exemplo LTDA</td>
                    <td>12.345.678/0001-99</td>
                    <td class="text-center">
                        <a data-toggle="modal" data-target="#edit-modal" class="btn btn-warning ms-auto">
                            Editar
                        </a>
                        <a data-toggle="modal" data-target="#delete-confirm-modal" class="btn btn-danger ms-auto">
                            Apagar
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Maria Oliveira</td>
                    <td>987.654.321-00</td>
                    <td class="text-center">
                        <a data-toggle="modal" data-target="#edit-modal" class="btn btn-warning ms-auto">
                            Editar
                        </a>
                        <a data-toggle="modal" data-target="#delete-confirm-modal" class="btn btn-danger ms-auto">
                            Apagar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- Modal section --}}
    @include('person.partials.create_modal')
    @include('person.partials.edit_modal')
    @include('person.partials.delete_modal')
    {{-- /Modal section --}}

    <!-- Bootstrap JS (opcional, para funcionalidades como alertas ou modais) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
