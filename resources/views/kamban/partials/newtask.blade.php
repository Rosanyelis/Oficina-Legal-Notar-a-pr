        <div class="modal fade" id="TaskModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <form action="{{ route('kamban.storeitem') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Crear Tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="hidden" id="workspace_id" name="workspace_id" value="{{ $data->id }}" />
                            <input type="hidden" id="modal_board_id" name="board_id" value="" />

                            <div class="form-floating form-floating-outline mb-5 col-md-12">
                                <input type="text" id="title"
                                    class="form-control"
                                    name="title"
                                    placeholder="Ingrese Titulo de Tarea"
                                    required/>
                                <label for="title">Titulo</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5 col-md-12">
                                <textarea id="description" name="description"
                                class="form-control h-px-100"
                                placeholder="Ingrese Descripción de Tarea"
                                rows="3"
                                required></textarea>
                                <label for="description">Descripción</label>
                            </div>

                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <input type="date" id="start-date"
                                name="start_date"
                                class="form-control"
                                placeholder="Ingrese Fecha de Inicio" />
                                <label for="start-date">Fecha de Inicio</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <input type="date" id="due-date"
                                name="due_date"
                                class="form-control"
                                placeholder="Ingrese Fecha Final" />
                                <label for="due-date">Fecha Final</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <select class="select2 select2-label form-select" id="label"
                                     name="priority" required>
                                    <option data-color="bg-label-info" value="Sin Definir">Sin Definir</option>
                                    <option data-color="bg-label-danger" value="Alta">Alta</option>
                                    <option data-color="bg-label-warning" value="Media">Media</option>
                                    <option data-color="bg-label-primary" value="Baja">Baja</option>
                                </select>
                                <label for="label"> Prioridad</label>
                            </div>
                            <div class="w-100"></div>
                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <select class="form-select" id="billable_task" name="billable_task" required>
                                    <option>Seleccione</option>
                                    <option value="Si">Si</option>
                                    <option value="No" selected>No</option>
                                </select>
                                <label for="billable_task"> ¿Es una tarea facturable?</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <input type="text" id="time_billable_task"
                                name="time_billable_task"
                                class="form-control"
                                placeholder="Ingrese Duración de Tarea" />
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
                                <select class="form-select" id="event_calendar" name="event_calendar" required>
                                    <option>Seleccione</option>
                                    <option value="Si">Si</option>
                                    <option value="No" selected>No</option>
                                </select>
                                <label for="event_calendar"> ¿agendar evento en google calendar?</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <input type="time" id="start-time"
                                name="start_time"
                                class="form-control"
                                placeholder="Ingrese Fecha de Inicio" />
                                <label for="start-time">Hora de Inicio de Evento</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5 col-md-4">
                                <input type="time" id="due-time"
                                name="due_time"
                                class="form-control"
                                placeholder="Ingrese Fecha Final" />
                                <label for="due-time">Hora Final de Evento</label>
                            </div>
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="attachments">Archivos</label>
                                <div>
                                    <input type="file" name="attachments[]" class="form-control" id="attachments" multiple />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
