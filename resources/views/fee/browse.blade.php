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
                                <i class="voyager-dollar"></i> Tarifario
                                
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
                                            <th>Ruta.</th>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($fee as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>    
                                            <td>{{ $item->de }} - {{ $item->hasta }}</td>
                                            <td>{{ $item->detail }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <label class="label label-success">Activo</label>
                                                @else
                                                    <label class="label label-danger">Inactivo</label>
                                                @endif
                                            </td>
                                            <td class="actions text-right dt-not-orderable sorting_disabled">                                   
                                                <a type="button" href="{{route('view_add_fee', $item->id)}}"  data-target="#modal_aprobar"  class="btn btn-success"><i class="voyager-plus"></i> <i class="voyager-dollar"></i> <i class="voyager-truck"></i> <span class="hidden-xs hidden-sm">Agregar Tarifa</span></a>
                                                <a type="button" href="{{route('view_add_people', $item->id)}}"  data-target="#modal_aprobar"  class="btn btn-dark"><i class="voyager-people"></i> <span class="hidden-xs hidden-sm">Personal</span></a>
                                            </td>
                                            
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" role="dialog" id="modalRegistrar">
            <div class="modal-dialog modal-xl">
                <div class="modal-content modal-success">                
                    <!-- Modal Header -->
                    <div class="modal-header modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-plus"></i> Registrar Ruta</h4>
                    </div>
                    {!! Form::open(['route' => 'fee.store','class' => 'was-validated'])!!}
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Inicio:</b></span>
                                    </div>
                                    <select name="sucursal_de" id="sucursal_de" class="form-control select2" required>
                                        <option value="">Seleccione un tipo..</option>
                                        @foreach($branchoffices as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Fin:</b></span>
                                    </div>
                                    <select name="sucursal_hasta" id="sucursal_hasta" class="form-control select2" required>
                                        <option value="">Seleccione un tipo..</option>
                                        @foreach($branchoffices as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            
                            
                            <div class="row">    
                                    
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Detalle:</b></span>
                                    </div>
                                    <textarea id="detail" class="form-control" name="detail" cols="77" rows="3"></textarea>
                                </div>                
                            </div>

                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer justify-content-between">
                            <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                            </button>
                            <button type="submit" class="btn btn-success btn-sm" title="Registrar..">
                                Registrar
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






            

        </script>
    @stop
