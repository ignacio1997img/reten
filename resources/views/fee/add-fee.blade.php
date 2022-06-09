@extends('voyager::master')

@section('page_title', 'Agregar Tarifa')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i>
        Agregar Tarifa
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        {!! Form::open(['route' => 'store_update_fee','class' => 'was-validated'])!!}
            <div class="row">
                <input type="hidden" name="id" value="{{$id}}">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-heading"><h6 class="panel-title">{{$fee->de}} - {{$fee->hasta}}</h6></div>
                        <div class="panel-body">
                            @foreach($vehicle as $item)
                                <div class="row">
                                    <div class="form-group col-md-4">
                                       
                                    </div>
                                    @php
                                        $aux = \app\models\FeeVehicle::where('fee_id',$id)->where('vehicle_id',$item->id)->first();
                                        // dd($aux);
                                
                                    @endphp
                                    <div class="form-group col-md-4">
                                        <label for="procedure_type_id">{{$item->name}}</label>
                                        <input type="hidden" name="vehicle_id[]" value="{{$item->id}}">
                                        <input type="number" value="{{ $aux ? $aux->price: '0.00' }}" name="price[]" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                       
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        {!! Form::close()!!} 
    </div>
@stop

@section('css')
    <style>

    </style>
@endsection

@section('javascript')
    <script>
     
     
    </script>
@stop
