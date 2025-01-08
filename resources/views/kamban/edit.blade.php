@extends('layouts.app')
@section('title', 'Gestiones de Tableros Kamban - Editar')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Editar Espacio de Trabajo</h5>

                        <a href="{{ route('gestiones.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" action="{{ route('gestiones.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="workspace_id" name="workspace_id" value="{{ $data->id }}" />
                            <div class="row">
                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="title"
                                            name="title"
                                            class="form-control @if($errors->has('title')) is-invalid @endif"
                                            placeholder="Ingrese nombre de espacio de trabajo de cliente"
                                            value="{{ old('title', $data->title) }}"
                                        />
                                        <label for="code">Nombre de Espacio de Trabajo</label>
                                        @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="client_id"
                                            name="client_id"
                                            class="form-select"
                                            placeholder="Selecione un cliente">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($clients as $item)
                                            <option value="{{ $item->id }}" @if (old('client_id', $data->client_id) == $item->id) selected @endif >{{ $item->firstname }} {{ $item->second_name }} {{ $item->lastname }} {{ $item->second_surname }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Cliente</label>
                                        @if($errors->has('client_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('client_id') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-12">
                                    <div class="form-floating form-floating-outline mb-5 col-md-12">
                                        <textarea id="description" name="description"
                                        class="form-control h-px-100"
                                        placeholder="Ingrese Descripción de Espacio de Trabajo"
                                            rows="3">{{ old('description', $data->description) }}</textarea>
                                        <label for="description">Descripción (Opcional)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
                                        <i class="ri-save-2-line me-1"></i>
                                        Actualizar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
