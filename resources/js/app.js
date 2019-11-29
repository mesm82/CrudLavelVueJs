new Vue({
    el: '#main',
    created: function() {
        this.getTareas();
    },
    data: {
        tareas: [],
        newTarea: '',
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0,
        },
        TareaLlena: { 'id': '', 'titulo': '' },
        errors: [],
        offset: 3,
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pageNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesAray = [];
            while (from <= to) {
                pagesAray.push(from);
                from++;
            }
            return pagesAray;
        }
    },
    methods: {
        borrar: function() {
            this.errors = [];
        },
        getTareas: function(page) {

            var urlTareas = 'tareas?page=' + page;
            axios.get(urlTareas).then(Response => {
                this.tareas = Response.data.tareas.data,
                    this.pagination = Response.data.pagination
            });
        },
        editTarea: function(tarea) {
            this.errors = [];
            this.TareaLlena.id = tarea.id;
            this.TareaLlena.titulo = tarea.titulo;
            $('#edit').modal('show');
        },
        updateTarea: function(id) {
            var urlTareas = 'tareas/' + id;
            axios.put(urlTareas, this.TareaLlena).then(Response => {
                this.getTareas();
                this.TareaLlena = { 'id': '', 'titulo': '' };
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Tarea actualizada satisfactoriamente');
            }).catch(error => {
                this.errors = error.response.data.errors.titulo;
            });
        },
        deleteTareas: function(tarea) {
            const confirmacion = confirm(`Desea eliminar la tarea ${tarea.id}`);
            if (confirmacion) {
                var urlTareas = 'tareas/' + tarea.id;
                axios.delete(urlTareas).then(Response => {
                    this.getTareas();
                    toastr.success('Tarea eliminada satisfactoriamente');
                });
            } else {
                alert("Operación Cancelada")
            }
        },
        createTarea: function() {

            var urlTareas = 'tareas';
            axios.post(urlTareas, {
                titulo: this.newTarea
            }).then(Response => {
                this.getTareas();
                this.newTarea = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Tarea guardada satisfactoriamente');
            }).catch(error => {
                //if (error.response.status == 422) {
                this.errors = error.response.data.errors.titulo;
                // }

            });
        },
        cambioPagina: function(page) {
            this.pagination.current_page = page;
            this.getTareas(page);
        }

    }
});