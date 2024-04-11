<?php

namespace App\Http\Controllers;

use App\Comentarios;
use App\Traits\Utils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComentariosController extends Controller
{
    //
    use Utils;

    public function saveComentario(Request $request)
    {
        try {
            $user_id = Auth::id();

            //Valida los datos que vienen del request
            $validator = Validator::make($request->all(), [
                'comment' => [
                    'required',
                    'max:255'
                ],
                'grade' => [
                    'required',
                    'numeric',
                    'max:5',
                    'min:0'
                ],
                'receta_id' => [
                    'required',
                    'numeric',
                    'min:0',
                    'exists:recetas,id',
                    Rule::unique('comentarios')->where(function ($query) use($request, $user_id) {
                        $query->where('receta_id', $request->receta_id)->where('user_id', $user_id);
                    })
                ]
            ], [
                'comment.required' => 'La calificación tiene que tener comentario',
                'comment.max' => 'El comentarios no puede tener mas de 255 caracteres',
                'grade.*' => 'Calificación no valida',
                'receta_id.*' => 'Id de la receta no valido'
            ]);          

            if($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            //Guarda el comentario
            Comentarios::create([
                'comment' => $request->comment,
                'grade' => $request->grade,
                'receta_id' => $request->receta_id,
                'user_id' => $user_id
            ]);

            return $this->returnSuccesJson();
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }

    public function loadComments(Request $request)
    {
        try {
            //Valida los datos del request
            $validator = Validator::make($request->all(), [
                'receta_id' => 'required|numeric|min:0',
                'page' => 'required|numeric|min:0'
            ], [
                'receta_id.*' => 'Id de la recena no valido',
                'page.*' => 'Página no valida',
            ]);

            if($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            /* 
            paginate, devuelve x (el numero que esta entre parentesis), registros de la base de datos
            para que esto funcione se debe traer una variable 'page', que en este caso, esta en el request
            */
            $comentarios = Comentarios::with('user')->paginate(5);
            return $this->returnDataJson($comentarios, 'comentarios');
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }
}
