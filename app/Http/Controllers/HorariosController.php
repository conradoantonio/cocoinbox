<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Horario;

class HorariosController extends Controller
{
    /**
     * Carga la tabla de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $menu = "Horarios";

        $horarios = new \stdClass();
        
        $horarios->domingo = Horario::where('dia', 0)->first();
        $horarios->lunes = Horario::where('dia', 1)->first();
        $horarios->martes = Horario::where('dia', 2)->first();
        $horarios->miercoles = Horario::where('dia', 3)->first();
        $horarios->jueves = Horario::where('dia', 4)->first();
        $horarios->viernes = Horario::where('dia', 5)->first();
        $horarios->sabado = Horario::where('dia', 6)->first();
        
        return view('horarios.horarios', ['horarios' => $horarios, 'menu' => $menu, 'title' => $title]);
    }

    /**
     * Edita los horarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $this->cambiar_horario($request->domingo_id, $request->domingo_inicio, $request->domingo_final, $request->domingo_abierto);
        $this->cambiar_horario($request->lunes_id, $request->lunes_inicio, $request->lunes_final, $request->lunes_abierto);
        $this->cambiar_horario($request->martes_id, $request->martes_inicio, $request->martes_final, $request->martes_abierto);
        $this->cambiar_horario($request->miercoles_id, $request->miercoles_inicio, $request->miercoles_final, $request->miercoles_abierto);
        $this->cambiar_horario($request->jueves_id, $request->jueves_inicio, $request->jueves_final, $request->jueves_abierto);
        $this->cambiar_horario($request->viernes_id, $request->viernes_inicio, $request->viernes_final, $request->viernes_abierto);
        $this->cambiar_horario($request->sabado_id, $request->sabado_inicio, $request->sabado_final, $request->sabado_abierto);

        return redirect()->to('horarios');
    }

    /**
     * Función que cambia el horario de un día.
     *
     * @return \Illuminate\Http\Response
     */
    public function cambiar_horario($id, $hora_inicio, $hora_fin, $abierto)
    {
        $horario = Horario::find($id);

        $horario->hora_inicio = $hora_inicio;
        $horario->hora_fin = $hora_fin;
        $horario->status = $abierto ? 1 : 0;
        $horario->save();

        return true;
    }
}
