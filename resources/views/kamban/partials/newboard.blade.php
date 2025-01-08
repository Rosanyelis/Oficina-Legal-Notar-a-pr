        <div class="modal fade " id="BoardModal" tabindex="-1" aria-modal="true" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('kamban.storeboard', $data->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalCenterTitle">Nuevo Tablero</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-mb-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="title"
                                        class="form-control"
                                        name="title"
                                        placeholder="Ingrese Nombre de Tablero" />
                                    <label for="title">Nombre de Tablero</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
