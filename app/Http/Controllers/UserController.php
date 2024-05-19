<?php

namespace App\Http\Controllers;

use App\Favoritos;
use App\ProfilePicture;
use App\Recetas;
use App\Traits\Utils;
use App\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

class UserController extends Controller
{
    use Utils;

    public function store(Request $request)
    {
        $pass = $request->password;
        $errors = array();

        //PRIMERO VALIDA QUE TODOS LOS CAMPOS FUERON INGRESADOS
        //SI QUIEREN EDITAR LOS MENSAJES QUE MUESTRAN CHEQUEN EL ARCVHIVO /RESOURCES/LANG/ES/validation.php
        //https://dev.to/rodolfovmartins/validation-error-messages-in-laravel-customizing-and-localizing-feedback-1d4k#:~:text=By%20default%2C%20Laravel%20includes%20English,the%20Validator%3A%3Amake%20method.
        //SI QUIEREN AGREGAR MAS VALIDACIONES ME AVISAN
        $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        //Verifica si el correo tiene el formato correcto
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Correo no valido';

        //Verifica que las dos contraseñas coincidan
        if ($pass != $request->password_confirmation)
            $errors['passwordsNotMatch'] = 'Las contraseñas no coinciden';

        //Verifica las contraseñas
        if (strlen($pass) < 8)
            $errors['password'][] = "La contraseña debe tener minimo 8 caracteres";
        if (!preg_match("/\d/", $pass))
            $errors['password'][] = "La contraseña debe contener al menos un numero";
        if (!preg_match("/[A-Z]/", $pass))
            $errors['password'][] = "La contraseña debe contener al menos una mayuscula";
        if (!preg_match("/[a-z]/", $pass))
            $errors['password'][] = "La contraseña debe contener al menos una minuscula";
        if (preg_match("/\s/", $pass))
            $errors['password'][] = "La contraseña no debe contener espacios";

        if ($errors)
            return Redirect::back()->withErrors($errors)->withInput();

        //CREA EL USUAIRO
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->username,
            'rol' => 'normal'
        ]);

        Auth::login($user);

        $request->session()->regenerate();
        $request->session()->put('profile_picture', "");
        return redirect('/');
    }
    
    public function store_admin(Request $request)
    {
        $pass = $request->password;
        $errors = array();

        //PRIMERO VALIDA QUE TODOS LOS CAMPOS FUERON INGRESADOS
        //SI QUIEREN EDITAR LOS MENSAJES QUE MUESTRAN CHEQUEN EL ARCVHIVO /RESOURCES/LANG/ES/validation.php
        //https://dev.to/rodolfovmartins/validation-error-messages-in-laravel-customizing-and-localizing-feedback-1d4k#:~:text=By%20default%2C%20Laravel%20includes%20English,the%20Validator%3A%3Amake%20method.
        //SI QUIEREN AGREGAR MAS VALIDACIONES ME AVISAN
        $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        //Verifica si el correo tiene el formato correcto
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Correo no valido';

        //Verifica que las dos contraseñas coincidan
        if ($pass != $request->password_confirmation)
            $errors['passwordsNotMatch'] = 'Las contraseñas no coinciden';

        //Verifica las contraseñas
        if (strlen($pass) < 8)
            $errors['password'][] = "La contraseña debe tener minimo 8 caracteres";
        if (!preg_match("/\d/", $pass))
            $errors['password'][] = "La contraseña debe contener al menos un numero";
        if (!preg_match("/[A-Z]/", $pass))
            $errors['password'][] = "La contraseña debe contener al menos una mayuscula";
        if (!preg_match("/[a-z]/", $pass))
            $errors['password'][] = "La contraseña debe contener al menos una minuscula";
        if (preg_match("/\s/", $pass))
            $errors['password'][] = "La contraseña no debe contener espacios";

        if ($errors)
            return Redirect::back()->withErrors($errors)->withInput();

        //CREA EL USUAIRO
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->username,
            'rol' => 'administrador'
        ]);

        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $profile_picture = User::with('profile_picture')->find(Auth::id())->profile_picture->path ?? "";
            $request->session()->put('profile_picture', $profile_picture);

            return redirect('');
        }

        return Redirect::back()->withErrors(['fail' => 'Las credenciales no coinciden'])->withInput();
    }

    public function index(Request $request)
    {
        // dd(Auth::user()->with('profile_picture')->first()->profile_picture->path);
        $user = User::with('profile_picture')->find(Auth::id());
        $favoritos = Favoritos::with('receta.user')->where('user_id', Auth::id())->get();
        // return $this->returnDataJson($favoritos);
        return view('user.index', compact('user', 'favoritos'));
    }

    public function save_profile_picture(Request $request)
    {
        $user_id = Auth::id();
        $image = $request->file('image');

        //El segundo arreglo es el mensaje de error que se va a mostrar
        $request->validate([
            'image' => 'required|image|max:5024'
        ], [
            'image.required' => 'No se encontró ninguna imagen',
            'image.image' => 'Imagen no valida',
            'image.max' => 'La imagen no puede ser mayor a 5mb',
        ]);

        $extension = $image->getClientOriginalExtension();
        $filename = time() . ".{$extension}";
        //Remueve la antigua foto de perfil, para sobreescribirla
        Storage::disk('public')->deleteDirectory("images/" . $user_id);
        //GUARDA LA IMAGEN EN STORAGE/APP/PUBLIC/IMAGES
        $path = '/storage/' . $image->storeAs("/images/{$user_id}", $filename, 'public');

        ProfilePicture::where('user_id', $user_id)->delete();

        ProfilePicture::create([
            'path' => $path,
            'extension' => $extension,
            'size' => $image->getSize(),
            'user_id' => $user_id
        ]);

        $request->session()->put('profile_picture', $path);

        return Redirect::back()->with('success', 'Imagen guardada!');
    }
}

