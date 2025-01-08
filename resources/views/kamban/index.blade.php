@extends('layouts.app')
@section('title', 'Gestiones de Tableros Kamban (Trello)')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
    <div class="card">
        <div class="card-header header-elements border-bottom">
            <h5 class="mb-0 me-2">Gestiones de Tableros Kamban (Trello)</h5>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('gestiones.create') }}" class="btn btn-sm btn-primary"
                >Nuevo Espacio de Trabajo</a>
            </div>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="datatables-kamban table table-sm">
                <thead>
                    <tr>
                        <th>Espacios de Trabajo</th>
                        <th style="width: 10px"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $gestion)
                    <tr>
                        <td>
                            @if ($gestion->client_id == null)
                            <a href="{{ route('gestiones.show', $gestion->id) }}">
                                Tablero de Administración
                            </a>
                            @else
                            <a href="{{ route('gestiones.show', $gestion->id) }}">
                                {{ $gestion->title }}
                            </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('gestiones.edit', $gestion->id) }}" class="btn btn-sm btn-icon btn-text-secondary
                                rounded-pill"
                                data-bs-toggle="tooltip" title="Editar Materias">
                                <i class="ri-edit-2-line ri-20px"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
                                rounded-pill text-danger"
                                data-bs-toggle="tooltip" title="Eliminar Materias"
                                onclick="deleteRecord({{ $gestion->id }})">
                                <i class="ri-delete-bin-7-line ri-20px"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/gestiones.js') }}"></script>
@endsection
