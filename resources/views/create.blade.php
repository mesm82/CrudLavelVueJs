<form method="post" v-on:submit.prevent="createTarea()">
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4>Nueva Tarea</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="tarea">Crear Título</label>
                <input type="text" name="titulo" class="form-control" v-on:keyup.prevent="borrar()" v-model="newTarea">
                <span v-for="error in errors" class="text-danger">@{{ error }}</span>
            </div>
            <div class="modal-footer">
               <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </div>

    </div>

</div>
</form>