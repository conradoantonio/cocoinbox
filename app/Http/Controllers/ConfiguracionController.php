<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Image;
use App\Faq;
use App\TipoPregunta;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfiguracionController extends Controller
{
    /**
     * Carga la vista para poder cargar un pdf con el aviso de privacidad y/o poder descargar uno existente.
     *
     * @return \Illuminate\Http\Response
     */
    public function preguntas_frecuentes(Request $request)
    {
        if (auth()->check()) {
            $preguntas = Faq::preguntas_detalles();
            $tipos = TipoPregunta::all();
            $title = 'Preguntas frecuentes';
            $menu = 'Configuraciones';
            if ($request->ajax()) {
                return view('configuracion.table', ['preguntas' => $preguntas]);
            }
            return view('configuracion.preguntas_frecuentes', ['preguntas' => $preguntas, 'tipos' => $tipos, 'title' => $title, 'menu' => $menu]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar_pregunta(Request $request)
    {
        $faq = New Faq;

        $faq->tipo_pregunta_id = $request->tipo_pregunta_id;
        $faq->pregunta = $request->pregunta;
        $faq->respuesta = $request->respuesta;

        $name = "img/preguntas/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('imagen_pregunta')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('imagen_pregunta')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/preguntas/'.time().'.'.$request->file('imagen_pregunta')->getClientOriginalExtension();
                $imagen_pregunta = Image::make($request->file('imagen_pregunta'))
                ->resize(460, 384)
                ->save($name);
                $faq->imagen = $name;
            }
        }

        $faq->save();

        return ['msg' => 'Pregunta guardada correctamente'];
    }

    /**
     * Edita una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function editar_pregunta(Request $request)
    {
        $faq = Faq::find($request->id);

        if ($faq) {
            $faq->tipo_pregunta_id = $request->tipo_pregunta_id;
            $faq->pregunta = $request->pregunta;
            $faq->respuesta = $request->respuesta;

            $name = "img/preguntas/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
            if ($request->file('imagen_pregunta')) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
                $extension_archivo = $request->file('imagen_pregunta')->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/preguntas/'.time().'.'.$request->file('imagen_pregunta')->getClientOriginalExtension();
                    $imagen_pregunta = Image::make($request->file('imagen_pregunta'))
                    ->resize(460, 384)
                    ->save($name);
                    $faq->imagen = $name;
                }
            }
            $faq->save();
            return ['msg' => 'Pregunta guardada correctamente'];
        }
        return ['msg' => 'Id de pregunta inválido'];
    }

    /**
     * Edita una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function eliminar_pregunta(Request $request)
    {
        Faq::where('id', $request->id)
        ->delete();
        return ['msg' => 'Pregunta eliminada'];
    }
}
