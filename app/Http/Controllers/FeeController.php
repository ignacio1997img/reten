<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branchoffice;
use App\Models\Fee;
use Illuminate\Support\Facades\DB;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use App\Models\VehicleType;
use App\Models\FeeVehicle;
use App\Models\User;
use App\Models\FeeUser;

class FeeController extends Controller
{
    protected function index()
    {

        // $fee = Fee::where('status', 1)->where('deleted_at', null)->get();
        $fee = DB::table('fees as f')
            ->join('branchoffices as a', 'a.id', 'f.sucursal_de')
            ->join('branchoffices as b', 'b.id', 'f.sucursal_hasta')
            ->where('f.status', 1)
            ->where('f.deleted_at', null)
            ->select('f.id', 'f.detail', 'a.name as de', 'b.name as hasta','f.status')
            ->get();

        // return $fee;

        $branchoffices = Branchoffice::all();
        return view('fee.browse', compact('branchoffices', 'fee'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // return $request;
            Fee::create($request->all());

            DB::commit();

            return redirect()->route('fee.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('fee.index')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function view_fee($id)
    {
        $fee = DB::table('fees as f')
            ->join('branchoffices as a', 'a.id', 'f.sucursal_de')
            ->join('branchoffices as b', 'b.id', 'f.sucursal_hasta')
            ->where('f.id', $id)
            ->select('f.id', 'f.detail', 'a.name as de', 'b.name as hasta','f.status')
            ->first();
        $vehicle = vehicleType::where('status', 1)->where('deleted_at', null)->get();
        $id=$id;
        $data = FeeVehicle::where('fee_id', $id)->where('deleted_at', null)->where('status', 1)->get();
        // return $data;
        return view('fee.add-fee', compact('vehicle','id','fee'));
    }

    public function store_update(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $i = 0;
            while($i < count($request->vehicle_id))
            {
                // return 1;
                $ok =  feeVehicle::where('fee_id', $request->id)->where('vehicle_id', $request->vehicle_id[$i])->first();
                if($ok)
                {
                    FeeVehicle::where('id', $ok->id)->update(['price' => $request->price[$i]]);
                }
                else
                {
                    // return 22;
                    feeVehicle::create(['price' => $request->price[$i], 'vehicle_id' => $request->vehicle_id[$i], 'fee_id' => $request->id]);
                }
                $i++;
            }
            DB::commit();
            return redirect()->route('fee.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('fee.index')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function view_people($id)
    {
        
        // $user = User::where('status', 1)->where('deleted_at', null)->get();
        $user = User::all();
        $data = FeeUser::with(['User'])
            ->where('fee_id', $id)->where('deleted_at', null)->get();
        // return $data;
        return view('fee.add-people', compact('user','id', 'data'));
    }

    public function add_people(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            FeeUser::create(['user_id' => $request->user_id, 'fee_id' => $request->fee_id]);;
            DB::commit();
            return redirect()->route('view_add_people',$request->fee_id)->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('view_add_people', $request->fee_id)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function inactivar_people(Request $request)
    {
        DB::beginTransaction();
        try {
            FeeUser::where('id', $request->id)->update(['status' => 0]);
            DB::commit();
            return redirect()->route('view_add_people', $request->fee_id)->with(['message' => 'Registro Desactivado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('view_add_people', $request->fee_id)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function activar_people(Request $request)
    {
        DB::beginTransaction();
        try {
            FeeUser::where('id', $request->id)->update(['status' => 1]);
            DB::commit();
            return redirect()->route('view_add_people', $request->fee_id)->with(['message' => 'Registro Activado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('view_add_people', $request->fee_id)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }




}
