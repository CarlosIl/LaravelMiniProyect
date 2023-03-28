<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Lineas_turno;
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
            'descripcion'         =>  'required|unique:turnos'
        ]);

        $turno_choose = new Turno();
        if($request->id){
            $turno_choose->id = $request->id;
        }
        $turno_choose->descripcion = $request->descripcion;
        $turno_choose->save();

        $dias = [];
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
        $mostrar_horario = false;

        return view('turno/dia/index', compact('turno_choose', 'diaNuevo','mostrar_horario'));
    }

    public function buscarHorario(Turno $turno_choose)
    {
        $horarios = Horario::all();
        return view('turno.horario.buscar', compact('turno_choose','horarios'));
    }

    public function seleccionarHorario(Turno $turno_choose, Horario $horario_choose)
    {
        $diaStd = DB::select('SELECT MAX(dia) as diaMax FROM lineas_turnos WHERE id_turno = ?',[$turno_choose->id]);
        $diaNuevo = intval($diaStd[0]->diaMax)+1;
        $mostrar_horario = true;
        // $horario_choose = Horario::find($horario_id);
        // $horario_descripcion = $horario_choose -> descripcion;
        return view('turno/dia/index', compact('turno_choose', 'horario_choose', 'diaNuevo','mostrar_horario'));
    }

    public function guardarDia(Request $request, Turno $turno_choose)
    {
        $request->validate([
            'dia'         =>  'required',
            'id_turno'         =>  'required',
            'id_horario'         =>  'required'
        ]);

        $linea_turno = new Lineas_turno();

        $linea_turno->dia = $request->dia;
        $linea_turno->id_turno = $request->id_turno;
        $linea_turno->id_horario = $request->id_horario;

        $linea_turno->save();

        $diasStd = DB::select('SELECT dia, horarios.id as id_horario, horarios.descripcion FROM lineas_turnos JOIN horarios ON lineas_turnos.id_horario = horarios.id WHERE id_turno = ?',[$turno_choose->id]);
        $dias = json_decode(json_encode($diasStd), true);
        $mostrar_dias = true;
        
        return view('turno.index', compact('dias','turno_choose','mostrar_dias'));
    }

    public function editarTurno(Turno $turno_choose)
    {
        return view('turno/editar', compact('turno_choose'));
    }

    public function actualizarTurno(Request $request)
    {
        $request->validate([
            'descripcion'         =>  'required|unique:turnos'
        ]);

        $turno_choose = Turno::find($request->id);
        $turno_choose->descripcion = $request->descripcion;
        $turno_choose->save();

        $diasStd = DB::select('SELECT dia, horarios.id as id_horario, horarios.descripcion FROM lineas_turnos JOIN horarios ON lineas_turnos.id_horario = horarios.id WHERE id_turno = ?',[$turno_choose->id]);
        $dias = json_decode(json_encode($diasStd), true);
        $mostrar_dias = true;
        
        return view('turno.index', compact('dias','turno_choose','mostrar_dias'));
    }

    public function eliminarTurno(Turno $turno_choose)
    {
        $sql = DB::select('SELECT count(*) as total FROM lineas_turnos WHERE id_turno = ?',[$turno_choose->id]);
        $conexiones = intval($sql[0]->total);

        $mostrar_dias = false;

        if ($conexiones == 0) {

            $turno_choose->delete();
    
            return redirect()->route('turno.index', compact('mostrar_dias'))->with('success', 'El turno ha sido eliminado');
        }else{

            return redirect()->route('turno.index', compact('mostrar_dias'))->with('error', "ERROR: Existen $conexiones dias creados en este turno");
        }
    }
}
