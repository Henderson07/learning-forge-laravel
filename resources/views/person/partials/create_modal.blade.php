<div class="modal" tabindex="-1" id="create-modal">
    <div class="modal-dialog">
        {{-- {{ Form::open(['url' => action('PersonController@store'), 'method' => 'POST', 'id' => 'person_create_form']) }} --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar nova pessoa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" required id="name" name="name" class="form-control"
                        placeholder="Nome pessoa...">
                </div>
                <div class="form-group">
                    <label for="document">CPF:</label>
                    <input type="text" required id="document" name="document" class="form-control"
                        placeholder="Documento...">
                </div>
                <div class="form-group">
                    <label for="type">Tipo:</label>
                    <select class="form-control" name="type" id="type" required>
                        <option value="0">Física</option>
                        <option value="1">Jurídica</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="subbmit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
