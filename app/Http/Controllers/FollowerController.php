<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    //el metodo se llama store porque se va a guardar en la base de datos
    public function store(User $user, Request $request){


        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user, Request $request){


        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
