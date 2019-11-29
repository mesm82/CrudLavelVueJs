@extends('welcome')

@section('content')
   
<div id="main" class="row">
    <div class="col-xs-12">
        <h1 class="pge-header">CRUD Laravel y VueJs</h1>
        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#create" v-on:click.prevent="borrar()">
            Nueva Tarea
        </a>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th colspan="2">&nbsp;</th>
                </tr>
            </thead>
            
            <tbody>
                <tr v-for="tarea in tareas">
                <td width="10px">@{{ tarea.id }}</td>
                <td>@{{ tarea.titulo }}</td>
                <td width="10px"> <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editTarea(tarea)"> Editar</a></td>
                <td width="10px"><a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteTareas(tarea)"> Eliminar</a></td>
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" v-on:click.prevent="cambioPagina(pagination.current_page - 1)">
                        <span> Atras</span>
                    </a>
                </li>
                <li class="page-item" v-for="page in pageNumber" v-bind:class="[page==isActived ? 'active':'']">
                    <a class="page-link" href="#" v-on:click.prevent="cambioPagina(page)">
                        @{{ page }}
                    </a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" v-on:click.prevent="cambioPagina(pagination.current_page + 1)">
                        <span> Siguiente</span>
                    </a>
                </li>
            </ul>

        </nav>
        @include('create')
        @include('edit')
    </div>
    <div class="col-sm-5">
        <pre>
            @{{ $data }}
        </pre>

    </div>
</div>

@endsection