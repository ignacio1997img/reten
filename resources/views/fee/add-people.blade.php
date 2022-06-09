@extends('voyager::master')

@section('page_title', 'Viendo Cheques')



    @section('page_header')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body" style="padding: 0px">
                            <div class="col-md-8" style="padding: 0px">
                                <h1 class="page-title">
                                <i class="voyager-people"></i> Personal
                                
                                </h1>
                            </div>                            
                                <div class="col-md-4 text-right" style="margin-top: 30px">
                                    <a type="button" data-toggle="modal" data-target="#modalRegistrar" class="btn btn-success">
                                        <i class="voyager-plus"></i> <span>Crear</span>
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('content')
        <div class="page-content browse container-fluid">
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id&deg;</th>
                                            <th>Personal.</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>    
                                            <td>{{ $item->User->name }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <label class="label label-success">Activo</label>
                                                @else
                                                    <label class="label label-danger">Inactivo</label>
                                                @endif
                                            </td>
                                            <td class="actions text-right dt-not-orderable sorting_disabled">
                                                @if($item->status == 1)
                                                    <a type="button" data-toggle="modal" data-target="#modal_baja" data-id="{{$item->id}}"   class="btn btn-danger"><i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Desabilitar</span></a>
                                                @else
                                                    <a type="button" data-toggle="modal" data-target="#modal_habilitar" data-id="{{$item->id}}"   class="btn btn-primary"><i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Activar</span></a>
                                                @endif  
                                            </td>                                            
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No hay registros.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-danger fade" tabindex="-1" id="modal_baja" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['route' => 'inactivar_people_fee', 'method' => 'POST']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-people"></i> Desabilitar Persona</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="fee_id" value="{{$id}}">
                        <div class="text-center" style="text-transform:uppercase">
                            <i class="voyager-warning" style="color: red; font-size: 5em;"></i>
                            <br>
                            <p><b>Desea dasabilitar la persona...!</b></p>
                        </div>
                    </div>                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-dark" value="Sí, Desabilitar">
                    </div>
                    {!! Form::close()!!} 
                </div>
            </div>
        </div>

        <div class="modal modal-success fade" tabindex="-1" id="modal_habilitar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['route' => 'activar_people_fee', 'method' => 'POST']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-people"></i> Habilitar Persona</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="fee_id" value="{{$id}}">
                        <div class="text-center" style="text-transform:uppercase">
                            <i class="voyager-check" style="color: rgb(0, 150, 12); font-size: 5em;"></i>
                            <br>
                            <p><b>Desea habilitar la persona...!</b></p>
                        </div>
                    </div>                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" value="Sí, Habilitar">
                    </div>
                    {!! Form::close()!!} 
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="modalRegistrar">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-success">                
                    <!-- Modal Header -->
                    <div class="modal-header modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-plus"></i> Registrar Personal</h4>
                    </div>
                    {!! Form::open(['route' => 'store_people_fee','class' => 'was-validated'])!!}
                        <!-- Modal body -->
                        <input type="hidden" name="fee_id" value="{{$id}}">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Persona:</b></span>
                                    </div>
                                    <select name="user_id" id="user_id" class="form-control select2" required>
                                        <option value="">Seleccione un tipo..</option>
                                        @foreach($user as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer justify-content-between">
                            <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                            </button>
                            <button type="submit" class="btn btn-success btn-sm" title="Registrar..">
                                Agregar
                            </button>
                        </div>
                    {!! Form::close()!!} 
                    
                </div>
            </div>
        </div>
     
    @stop

    @section('css')
        <style>
            .select2{
                width: 100% !important;
            }
        </style>
    @stop

    @section('javascript')
        <script src="{{ url('js/main.js') }}"></script>
        <script>
            $(document).ready(() => {
                $('#dataTable').DataTable({
                    language: {
                            // "order": [[ 0, "desc" ]],
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                            sSearch: "Buscar:",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior"
                            },
                            oAria: {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            buttons: {
                                copy: "Copiar",
                                colvis: "Visibilidad"
                            }
                        },
                        order: [[ 0, 'desc' ]],
                });


            });

            $('#modal_baja').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });

            $('#modal_habilitar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });






            

        </script>
    @stop
