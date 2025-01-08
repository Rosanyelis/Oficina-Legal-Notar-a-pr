@extends('layouts.app')
@section('title', 'Gestiones de Tableros Kamban (Trello)')
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
    <input type="hidden" name="id" value="{{ $data->id }} " id="workspace_id">
    <div class="app-kanban">
        <!-- Add new board -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-6 ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $data->title }}</h5>

                        <div class="d-flex align-items-center">
                            <button type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#BoardModal"
                                class="btn btn-sm btn-primary"
                            > Nuevo Tablero</button>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('gestiones.index') }}" class="btn btn-sm btn-secondary"
                            ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <form class="kanban-add-new-board">
                <label class="kanban-add-board-btn" for="kanban-add-board-input">
                    <i class="ri-add-line"></i>
                    <span class="align-middle">Nuevo Tablero</span>
                </label>
                <input
                    type="text"
                    class="form-control w-px-250 kanban-add-board-input mb-4 d-none"
                    placeholder="Añadir Nombre de Tablero"
                    id="kanban-add-board-input"
                    required />
                <div class="mb-4 kanban-add-board-input d-none">
                    <button class="btn btn-primary btn-sm me-3">Agregar Tablero</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm kanban-add-board-cancel-btn">
                        Cancelar
                    </button>
                </div>
            </form>
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

        <!-- Modal crear tarea -->
        @include('kamban.partials.newtask')
        <!--/ Modal crear tarea-->
        <!-- Modal Ver / Actualizar tarea -->
        @include('kamban.partials.edittask')
        <!--/ Modal Ver / Actualizar tarea -->
        <!-- Modal crear tablero-->
        @include('kamban.partials.newboard')
        <!--/ Modal crear tablero-->
        <!-- Modal Editar nombre de tablero -->
        @include('kamban.partials.renameboard')
        <!--/ Modal nombre de tablero-->


        <form id="form_delete_board" action="{{ route('kamban.deleteboard') }}" method="POST">
            @csrf
            <input type="hidden" id="boardcolumn" name="board" value="" />
            <input type="hidden" id="workspace_id" name="workspace_id" value="{{ $data->id }}" />
        </form>
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
<script src="{{ asset('pagesjs/kamban.js?v=2') }}"></script>
@endsection
