<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FeeUser;
use App\Models\Fee;
use App\Models\VehicleType;
use App\Models\FeeVehicle;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $feevehicles = DB::table('fee_users as fu')
            ->join('fees as f', 'f.id', 'fu.fee_id')
            ->join('fee_vehicles as fv', 'fv.fee_id', 'f.id')
            ->join('vehicle_types as v', 'v.id', 'fv.vehicle_id')
            ->where('fu.user_id', $user)
            ->where('fu.status', 1)
            ->where('fu.deleted_at', null)
            ->where('fv.price', '!=', 0)
            ->where('fv.status', 1)
            ->where('fv.deleted_at', null)
            ->where('v.status', 1)
            ->select('f.id as fee_id', 'fv.id as fee_vehicle_id', 'v.name as tipo', 'v.image', 'fv.price', 'v.id as vehicle_id')
            ->get();
        
        // return $feevehicles;

        // $fee = DB::table('fees as f')
        //     ->join('branchoffices as a', 'a.id', 'f.sucursal_de')
        //     ->join('branchoffices as b', 'b.id', 'f.sucursal_hasta')
        //     ->where('f.id', $feevehicles[0]->fee_id)
        //     ->select('f.id', 'f.detail', 'a.name as de', 'b.name as hasta','f.status')
        //     ->first();
        
        // return $fee;


        return view('tickets.tickets-generate', compact('feevehicles'));
    }

    public function generar_ticket($id)
    {
        // return $id;
        DB::beginTransaction();
        try {

            $feevehicles = FeeVehicle::find($id);
            


            $cant = DB::table('fees as f')
                ->join('fee_vehicles as fv', 'fv.fee_id', 'f.id')
                ->join('tickets as t', 't.fee_vehicle_id', 'fv.id')
                ->where('f.id', $feevehicles->fee_id)
                ->where('t.status', 1)
                // ->where('fv.status', 1)
                // ->where('fv.deleted_at', null)
                ->count();

            // return $cant;



            $ticket = Ticket::create([
                'nro_ticket' => $cant + 1,
                'user_id' => Auth::user()->id,
                'fee_vehicle_id' => $id,
                'status' => 1,
                'deleted_at' => null,
            ]);

            // $cant = Ticket::where('fee_vehicle_id', $id)->count();
            // return $cant +1;

            DB::commit();
            return view('tickets.ticket-print', compact('ticket'));
        } catch (\Throwable $th) {
            DB::rollback();
        }
        // return $cant+1;
    }
}
