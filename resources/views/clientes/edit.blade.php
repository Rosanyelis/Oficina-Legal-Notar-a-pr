@extends('layouts.app')
@section('title', 'Materias - Editar')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Editar Materia</h5>

                        <a href="{{ route('materias.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form class="needs-validation" action="{{ route('clientes.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="firstname"
                                            class="form-control @if ($errors->has('firstname')) is-invalid @endif"
                                            id="firstname"
                                            value="{{ old('firstname', $data->firstname) }}"
                                            placeholder="Ingrese primer nombre"
                                        />
                                        <label for="code">Primer Nombre</label>
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="second_name"
                                            class="form-control @if ($errors->has('second_name')) is-invalid @endif"
                                            id="second_name"
                                            value="{{ old('second_name', $data->second_name) }}"
                                            placeholder="Ingrese segundo nombre"
                                        />
                                        <label for="code">Segundo Nombre</label>
                                        @if($errors->has('second_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="lastname"
                                            class="form-control @if ($errors->has('lastname')) is-invalid @endif"
                                            id="lastname"
                                            value="{{ old('lastname', $data->lastname) }}"
                                            placeholder="Ingrese Primer Apellido"
                                        />
                                        <label for="code">Primer Apellido</label>
                                        @if($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="second_surname"
                                            class="form-control @if ($errors->has('second_surname')) is-invalid @endif"
                                            id="second_surname"
                                            value="{{ old('second_surname', $data->second_surname) }}"
                                            placeholder="Ingrese Segundo Apellido"
                                        />
                                        <label for="code">Segundo Apellido</label>
                                        @if($errors->has('second_surname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_surname') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="date"
                                            name="birthdate"
                                            class="form-control @if ($errors->has('birthdate')) is-invalid @endif"
                                            id="birthdate"
                                            value="{{ old('birthdate', $data->birthdate) }}"
                                            placeholder="Ingrese Fecha de Nacimiento"
                                        />
                                        <label for="code">Fecha de Nacimiento</label>
                                        @if($errors->has('birthdate'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('birthdate') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                            id="email"
                                            value="{{ old('email', $data->email) }}"
                                            placeholder="Ingrese Correo"
                                        />
                                        <label for="code">Correo</label>
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="phone"
                                            class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                            id="phone"
                                            value="{{ old('phone', $data->phone) }}"
                                            placeholder="Ingrese Teléfono"
                                        />
                                        <label for="code">Teléfono</label>
                                        @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="urbanization"
                                            class="form-control @if ($errors->has('urbanization')) is-invalid @endif"
                                            id="urbanization"
                                            value="{{ old('urbanization', $data->urbanization) }}"
                                            placeholder="Ingrese Urbanización"
                                        />
                                        <label for="code">Urbanización</label>
                                        @if($errors->has('urbanization'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('urbanization') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="number"
                                            name="number"
                                            class="form-control @if ($errors->has('number')) is-invalid @endif"
                                            id="number"
                                            value="{{ old('number', $data->number) }}"
                                            placeholder="Ingrese Número"
                                        />
                                        <label for="code">Número</label>
                                        @if($errors->has('number'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('number') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="street"
                                            class="form-control @if ($errors->has('street')) is-invalid @endif"
                                            id="street"
                                            value="{{ old('street', $data->street) }}"
                                            placeholder="Ingrese Calle"
                                        />
                                        <label for="code">Calle</label>
                                        @if($errors->has('street'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('street') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="village"
                                            class="form-control @if ($errors->has('village')) is-invalid @endif"
                                            id="village"
                                            value="{{ old('village', $data->village) }}"
                                            placeholder="Ingrese Pueblo"
                                        />
                                        <label for="code">Pueblo</label>
                                        @if($errors->has('village'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('village') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="country"
                                            class="form-control @if ($errors->has('country')) is-invalid @endif"
                                            id="country"
                                            value="{{ old('country', $data->country) }}"
                                            placeholder="Ingrese País"
                                        />
                                        <label for="code">País</label>
                                        @if($errors->has('country'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('country') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            name="zipcode"
                                            class="form-control @if ($errors->has('zipcode')) is-invalid @endif"
                                            id="zipcode"
                                            value="{{ old('zipcode', $data->zipcode) }}"
                                            placeholder="Ingrese Codigo Postal"
                                        />
                                        <label for="code">Codigo Postal</label>
                                        @if($errors->has('zipcode'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('zipcode') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="medio_contactos_id"
                                            name="medio_contactos_id"
                                            class="form-select"
                                            placeholder="Selecione una categoria">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($medios as $item)
                                            <option value="{{ $item->id }}" @if (old('medio_contactos_id', $data->medio_contactos_id) == $item->id) selected @endif >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Medio de Contacto</label>
                                        @if($errors->has('medio_contactos_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('medio_contactos_id') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="materia_id"
                                            name="materia_id"
                                            class="form-select"
                                            placeholder="Selecione una materia">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($materias as $item)
                                            <option value="{{ $item->id }}" @if (old('materia_id', $data->materia_id) == $item->id) selected @endif >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Materia</label>
                                        @if($errors->has('materia_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('materia_id') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="juzgado_id"
                                            name="juzgado_id"
                                            class="form-select"
                                            placeholder="Selecione un juzgado">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($juzgados as $item)
                                            <option value="{{ $item->id }}" @if (old('juzgado_id', $data->juzgado_id) == $item->id) selected @endif >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Juzgados</label>
                                        @if($errors->has('juzgado_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('juzgado_id') }}
                                        </div>
                                        @endif
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
