<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Turno;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mostrar_dias = false;
        return view('turno.index', compact('mostrar_dias'));
    }

    public function crearTurno(Request $request){

        $request->validate([
            'id'         =>  'nullable|unique:turnos',
            'descripcion'         =>  'required'
        ]);

        $turno_choose = new Turno();
        if($request->id){
            $turno_choose->id = $request->id;
        }
        $turno_choose->descripcion = $request->descripcion;
        $turno_choose->save();

        $mostrar_dias = true;
        return view('turno.index', compact('mostrar_dias','turno_choose','dias'));
    }

    public function buscarTurno(){
        $turnos = Turno::all();
        return view('turno.buscar', compact('turnos'));
    }

    public function seleccionarTurno(Turno $turno_choose)
    {
        $diasStd = DB::select('SELECT dia, horarios.id as id_horario, horarios.descripcion FROM lineas_turnos JOIN horarios ON lineas_turnos.id_horario = horarios.id WHERE id_turno = ?',[$turno_choose->id]);
        $dias = json_decode(json_encode($diasStd), true);
        $mostrar_dias = true;

        // $data = array(
        //     'turno_choose' => $turno_choose,
        //     'dias' => $dias,
        // );

        return view('turno.index', compact('dias','turno_choose','mostrar_dias'));
    }

    public function crearDia(Turno $turno_choose)
    {
        $diaStd = DB::select('SELECT MAX(dia) as diaMax FROM lineas_turnos WHERE id_turno = ?',[$turno_choose->id]);
        $diaNuevo = intval($diaStd[0]->diaMax)+1;

        return view('turno/dia/index', compact('turno_choose', 'diaNuevo'));
    }

    public function buscarHorario()
    {
        $horarios = Horario::all();
        return view('turno.horario.buscar', compact('horarios'));
    }
}
