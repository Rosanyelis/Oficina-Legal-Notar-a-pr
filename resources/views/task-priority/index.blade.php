@extends('layouts.app')
@section('title', 'Tareas por Prioridad')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="app-kanban">
        <!-- Add new board -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-6 ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tareas por Prioridad</h5>

                        <div class="d-flex align-items-center">
                            <!-- <button type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#BoardModal"
                                class="btn btn-sm btn-primary"
                            > Nuevo Tablero</button>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('gestiones.index') }}" class="btn btn-sm btn-secondary"
                            ><i class="ri-arrow-left-line me-1"></i> Regresar</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

            </div>
        </div>
        <!-- Kanban Wrapper -->
        <div class="kanban-wrapper"></div>

        <!-- Edit Task/Task & Activities -->
        <div class="offcanvas offcanvas-end kanban-update-item-sidebar">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-2">

            </div>
        </div>

        <!-- Modal Ver / Actualizar tarea -->
        @include('task-priority.show-task')
        <!--/ Modal Ver / Actualizar tarea -->
    </div>

</div>
@endsection

@section('scripts')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('pagesjs/taskpriority.js?v=2.2') }}"></script>
@endsection
