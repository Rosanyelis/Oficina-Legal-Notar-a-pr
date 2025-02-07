<div class="modal fade" id="ViewTaskModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <form action="{{ route('kamban.updateitem') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <input type="hidden" id="update_board_id" name="board_id" value="" />
                                    <div class="form-floating form-floating-outline mb-5 col-md-12">
                                        <input type="text" id="title_update"
                                            class="form-control"
                                            name="title"
                                            placeholder="Ingrese Titulo de Tarea"
                                            readonly />
                                        <label for="title_update">Titulo</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-12">
                                        <textarea id="description_update" name="description"
                                        class="form-control h-px-100"
                                        placeholder="Ingrese Descripción de Tarea"
                                            rows="3"
                                            readonly></textarea>
                                        <label for="description_update">Descripción</label>
                                    </div>

                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <input type="date" id="start_date_update"
                                        name="start_date"
                                        class="form-control"
                                        placeholder="Ingrese Fecha de Inicio"
                                        readonly/>
                                        <label for="start_date_update">Fecha de Inicio</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <input type="date" id="due_date_update"
                                        name="due_date"
                                        class="form-control"
                                        placeholder="Ingrese Fecha Final"
                                        readonly/>
                                        <label for="due_date_update">Fecha Final</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <select class="select2 select2-label form-select" readonly id="label_update" name="priority">
                                            <option data-color="bg-label-info" value="Sin Definir">Sin Definir</option>
                                            <option data-color="bg-label-danger" value="Alta">Alta</option>
                                            <option data-color="bg-label-warning" value="Media">Media</option>
                                            <option data-color="bg-label-primary" value="Baja">Baja</option>
                                        </select>
                                        <label for="label_update"> Prioridad</label>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <select class="form-select" id="billable_task_update" readonly name="billable_task">
                                            <option>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No" selected>No</option>
                                        </select>
                                        <label for="billable_task"> ¿Es una tarea facturable?</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <input type="text" id="time_billable_task_update"
                                        name="time_billable_task"
                                        class="form-control"
                                        placeholder="Ingrese Duración de Tarea"
                                        readonly />
                                        <label for="time_billable_task">Duración de Tarea</label>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <p class="text-muted">
                                        Al señalar que si quieres agendar el evento en
                                        google calendar debes ingresar la fecha y hora de inicio
                                        y final del evento
                                        </p>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <select class="form-select" readonly id="event_calendar_update" name="event_calendar">
                                            <option>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                        <label for="event_calendar_update"> ¿agendar evento en google calendar?</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <input type="time" id="start_time_update"
                                        name="start_time"
                                        class="form-control"
                                        placeholder="Ingrese Fecha de Inicio"
                                        readonly/>
                                        <label for="start_time_update">Hora de Inicio de Evento</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5 col-md-4">
                                        <input type="time" id="due_time_update"
                                        name="due_time"
                                        class="form-control"
                                        placeholder="Ingrese Fecha Final"
                                        readonly />
                                        <label for="due_time_update">Hora Final de Evento</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Archivos Subidos</h5>
                                        <ul id="archivos_subidos" class="list-unstyled mt-2">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>
