@extends('layouts.app')
@section('title', 'Tareas Facturables')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
    <!-- Product List Widget -->
    <div class="card mb-6 ">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div
                            class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                            <div>
                                <p class="mb-1">Total de Tareas</p>
                                <h4 id="total" class="mb-1">0</h4>
                            </div>
                            <div class="avatar me-sm-6">
                                <span class="avatar-initial rounded text-heading">
                                    <i class="ri-wallet-3-fill ri-26px"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Product List Table -->
    <div class="card">
        <div class="card-header">
            <!-- <h5 class="card-title mb-4">Filtros</h5> -->
            <div class="d-flex justify-content-start align-items-center row  g-2">
                <h5 class="col-md-1 card-title my-auto">Filtros:</h5>
                <div class="col-md-2">
                    <input type="date" id="filterdateStart" name="start" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <input type="date" id="filterdateEnd" name="end" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <select id="filterStatus" class="form-select form-select-sm text-capitalize">
                        <option value="">¿Facturable?</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filterPriority" class="form-select form-select-sm text-capitalize">
                        <option value="">Prioridad</option>
                        <option value="Sin Definir">Sin Definir</option>
                        <option value="Alta">Alta</option>
                        <option value="Media">Media</option>
                        <option value="Baja">Baja</option>
                    </select>
                </div>
                <div class="col-md-2 ">
                    <button class="btn btn-danger btn-sm" id="reset_filter">
                        <i class="ri-filter-off-fill"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-facturable table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>¿Facturable?</th>
                        <th>Tiempo Facturable</th>
                        <th>Actividad</th>
                        <th>Prioridad</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/report-facturable.js') }}"></script>
@endsection
