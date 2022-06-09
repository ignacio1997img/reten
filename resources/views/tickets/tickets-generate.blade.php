@extends('voyager::master')

@section('page_title', 'Imprimir tickets')
<style>
    .imgRedonda {
        width:200px;
        height:200px;
        border-radius:150px;
    }
    small{font-size: 100px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }
    #subtitle{
        font-size: 20px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }
</style>
@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-8" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-ticket"></i> Imprimir ticketsss
                            </h1>
                        </div>
                        {{-- <div class="col-md-4" style="margin-top: 30px">
                            
                                @csrf
                                <div class="form-group col-md-6">
                                    <input type="number" name="start" min="1" step="1" value="1" class="form-control" placeholder="Inicio" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="number" name="finish" min="1" step="1" value="100" class="form-control" placeholder="Fin" required>
                                </div>
                                <div class="form-group col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Generar <i class="voyager-settings"></i></button>
                                </div>

                        </div> --}}
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
                        {{-- <table id="dataTable" class="table table-hover">
                            <tbody>
                                @foreach($feevehicles as $item)       
                                    @php
                                        $aux = \App\Models\FeeVehicle::where('id',$item->fee_vehicle_id)->first();                                
                                    @endphp                         
                                    <tr>
                                        <td>{{$item->fee_vehicle_id}}</td>    
                                        <td>{{$item->tipo}}</td>  
                                        <td>{{ $aux ? $aux->price: '0.00' }}</td>
                                        <td class="actions text-right dt-not-orderable sorting_disabled">                                   
                                            <a type="button" target="_blank" href="{{route('generar_ticket', $item->fee_vehicle_id, $item->fee_vehicle_id)}}"  tipoata-target="#modal_aprobar"  class="btn btn-success"><span class="hidden-xs hidden-sm">Imprimir</span></a>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                        
                        <div clas="row" style="text-align: center">
                            @foreach($feevehicles as $item)       
                                @php
                                    $aux = \App\Models\FeeVehicle::where('id',$item->fee_vehicle_id)->first();                                
                                @endphp   
                                <div class="col-md-2">                                    
                                    <h5 id="subtitle">{{$item->tipo}}</h5>
                                    <br>
                                    <a type="button" target="_blank" href="{{route('generar_ticket', $item->fee_vehicle_id, $item->fee_vehicle_id)}}">
                                        <img src="{{url('storage/'.$item->image)}}" class="imgRedonda">
                                    </a> 
                                    <br>
                                    <small>{{ $aux ? $aux->price: '0.00' }}</small>

                                </div>
                                        
                                        
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@stop

{{-- 
@section('content')
    <div class="page-content edit-add container-fluid">
        {!! Form::open(['route' => 'generar_ticket','class' => 'was-validated'])!!}
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-heading"><h6 class="panel-title"></h6></div>
                        <div class="panel-body">
                            @foreach($feevehicles as $item)
                                <input type="text" name="fee_vehicle_id[]" value="{{$item->fee_vehicle_id}}">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                       
                                    </div>
                                    @php
                                        // dd($feevehicles);
                                        $aux = \App\Models\FeeVehicle::where('id',$item->fee_vehicle_id)->first();                                
                                    @endphp
                                    <div class="form-group col-md-4">
                                        <label for="procedure_type_id">{{$item->tipo}}</label>
                                        <input type="number" value="{{ $aux ? $aux->price: '0.00' }}" disabled class="form-control">
                                    </div>
                                    <div class="form-group col-sm-1">     
                                        <label for="procedure_type_id"></label>
                                        <button type="submit" class="form-control btn btn-primary" style="text-align: left" ><i class="voyager-prin"></i></button>
                                    </div>
                                    <div class="form-group col-md-3">
                                       
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close()!!} 
    </div>
@stop --}}

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@stop

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

        });

    </script>
@stop
