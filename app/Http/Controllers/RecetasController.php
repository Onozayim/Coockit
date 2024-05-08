<?php

namespace App\Http\Controllers;

use App\Comentarios;
use App\Favoritos;
use App\Ingredientes;
use App\Plan;
use App\RecetaPicture;
use App\Recetas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Traits\Utils;

class RecetasController extends Controller
{
    use Utils;

    private $now;

    public function __construct()
    {
        $this->now = Carbon::now();
    }

    public function index(Request $request)
    {
        $recetas = Recetas::with('user.profile_picture', 'rating')->paginate(5);
        // return $this->returnDataJson($recetas);

        return view('recetas.index', compact('recetas'));
    }

    public function search(Request $request) 
    {
        //return dd($request->search);
        $search = $request->input('search');

        if($search){
            $recetas = Recetas::with('user.profile_picture', 'rating')
                            ->where('title', 'like', "%$search%")
                            ->paginate(5);
        }
        else{
            $recetas = Recetas::with('user.profile_picture', 'rating')->paginate(5);
        }
        
        return view('recetas.search', compact('recetas'));
    }


    public function saveReceta(Request $request)
    {
        try {
            //Valida los datos que se mando por el js
            $validator = Validator::make($request->only('title', 'body', 'calories', 'ingredients_array', 'images'), [
                'title' => 'required|max:50',
                'body' => 'required|max:100',
                'calories' => 'required|numeric|min:0',
                'ingredients_array' => 'array|required',
                'images.*' => 'image|max:5120'
            ], [
                'title.*' => 'La receta debe de llevar título',
                'body.*' => 'La receta debe tener cuerpo',
                'calories.*' => 'La receta debe tener al menos una caloria',
                'ingredients_array.*' => 'La receta debe llevar ingredientes',
                'images.*.image' => 'La Imagen :position no es valida',
                'images.*.max' => 'La Imagen :position debe ser menor a 5mb',
            ]);

            

            //si tiene algun fallo, regresa el mensaje de error
            if ($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            $receta = Recetas::create([
                'title' => $request->title,
                'body' => $request->body,
                'calories' => $request->calories,
                'user_id' => Auth::id()
            ]);

            $ingredients = array();

            foreach ($request->ingredients_array as $ingredient) {
                //Checa todos los ingredientes, si hay uno que no cumple con los requisitos, regresa el mensaje de error y borra la receta
                $ingredient = json_decode($ingredient);
                if (
                    !$ingredient->ingredient ||
                    !$ingredient->quantity ||
                    !$ingredient->measurement
                ) {
                    $receta->delete();
                    return $this->returnErrorMessage('Todos los ingredientes deben de estar completos');
                }

                if ($ingredient->quantity <= 0) {
                    $receta->delete();
                    return $this->returnErrorMessage('No puede haber un 0 o numero negativo en los ingredientes');
                }

                $ingredients[] = [
                    'ingredient' => $ingredient->ingredient,
                    'quantity' => $ingredient->quantity,
                    'measurement' => $ingredient->measurement,
                    'receta_id' => $receta->id,
                    'created_at' => $this->now,
                    'updated_at' => $this->now
                ];
            }

            Ingredientes::insert($ingredients);

            if ($request->images) {
                Log::debug("INSERT IMAGES");
                foreach ($request->file('images') as $index => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = time() . "{$index}.{$extension}";
                    $path = '/storage/' . $image->storeAs("/images/receta_{$receta->id}", $filename, 'public');

                    RecetaPicture::create([
                        'path' => $path,
                        'extension' => $extension,
                        'size' => $image->getSize(),
                        'receta_id' => $receta->id
                    ]);
                }
            }

            return $this->returnSuccesJson();
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }

    public function saveRecetaInMeal(Request $request)
    {
        try {
            $user_id = Auth::id();

            $validator = Validator::make($request->all(), [
                'day' => 'required|numeric|min:0|max:7',
                'meal' => 'required|numeric|min:0|max:3',
                'receta_id' => 'required|numeric|min:0|exists:recetas,id'
            ], [
                'day.*' => 'Día no valido',
                'meal.*' => 'Comida no valida',
                'receta_id.*' => 'Id de la receta no valida',
            ]);

            if ($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            $plan = Plan::where([
                'user_id' => $user_id,
                'day' => $request->day,
                'meal' => $request->meal
            ])->first();

            if (!$plan)
                $plan = new Plan();

            $plan->user_id = $user_id;
            $plan->receta_id = $request->receta_id;
            $plan->day = $request->day;
            $plan->meal = $request->meal;
            $plan->updated_at = $this->now;

            $plan->save();

            return $this->returnSuccesJson();
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }
    public function detail(Request $request, $id)
    {
        $receta = Recetas::with('ingredientes', 'user', 'comentarios.user', 'images')->find($id);

        // return $this->returnDataJson($receta);

        if (!$receta)
            return $this->returnErrorView('No se encontro la receta solicitada');

        $receta->body = nl2br(htmlentities($receta->body, ENT_QUOTES, 'UTF-8'));

        $isFavorite = false;
        $hasComment = false;

        if (Auth::check()) {
            $isFavorite = Favoritos::checkIfUserHasFavorite($id);
            $hasComment = Comentarios::checkIfUserHasComment($id);
        }

        return view('recetas.detail', compact('receta', 'isFavorite', 'hasComment'));
    }

    public function saveFavorite(Request $request)
    {
        try {
            $user_id = Auth::id();

            $validator = Validator::make($request->all(), [
                'receta_id' => [
                    'required',
                    'numeric',
                    'min:0',
                    'exists:recetas,id',
                    Rule::unique('favoritos')->where(function ($query) use ($request, $user_id) {
                        return $query->where('user_id', $user_id)->where('receta_id', $request->receta_id);
                    })
                ]
            ], [
                'receta_id.required' => 'Id de la receta no válido',
                'receta_id.numeric' => 'Id de la receta no válido',
                'receta_id.min' => 'Id de la receta no válido',
                'receta_id.exists' => 'Id de la receta no válido',
                'receta_id.unique' => 'Receta ya guardada en favoritos'
            ]);

            if ($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            Favoritos::create([
                'receta_id' => $request->receta_id,
                'user_id' => $user_id
            ]);

            return $this->returnSuccesJson();
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }

    public function verifyReceta(Request $request)
    {
        try {
            //Valida el id solicitado
            $validator = Validator::make($request->all(), [
                'receta_id' => 'required|numeric|min:0|exists:recetas,id',
            ], [
                'receta_id.*' => 'Id de la recea no válido'
            ]);

            if ($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            Recetas::where('id', $request->receta_id)->update(['status' => 'Aprobada']);

            return $this->returnSuccesJson();
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }

    public function dennyReceta(Request $request)
    {
        try {
            //Valida el id solicitado
            $validator = Validator::make($request->all(), [
                'receta_id' => 'required|numeric|min:0|exists:recetas,id',
            ], [
                'receta_id.*' => 'Id de la recea no válido'
            ]);

            if ($validator->fails())
                return $this->returnValidationErrors($validator->errors());

            Recetas::where('id', $request->receta_id)->update(['status' => 'Rechazada']);

            return $this->returnSuccesJson();
        } catch (Exception $ex) {
            return $this->returnErrorMessageWithException($ex);
        }
    }
}
