<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    //sirve para que solo los usuarios autenticados puedan acceder a esta ruta (se puede añadir exepciones)

    public function __construct(){
        $this->middleware(["auth"]);
    }

    public function index(){
       return view("perfil.index");
    }

    public function store(Request $request){

        $request->request->add(["username" => Str::slug($request->username)]);

        $this->validate($request,[
            // "username" => "required|unique:users,username|min:3|max:20|not_in:editar-perfil";
           //otra forma pero con corchetes

          "username" => ["required","unique:users,username," .auth()->user()->id,"min:3","max:20","not_in:editar-perfil"],
        ]);

        if($request->imagen){

        $imagen = $request->file("imagen");

        $nombreImagen = Str::uuid().".".$imagen->extension();

        $imagenServidor = Image::make($imagen);

        $imagenServidor->fit(1000,1000);

        $imagenPath = public_path("perfiles") . "/" . $nombreImagen;

        $imagenServidor->save($imagenPath);
        }

        //guardar cambios

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //redireccionamos

        return redirect()->route("posts.index", $usuario->username);

    }
}
