<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class GestUserController extends Controller
{
    //
    public function view()
    {
        //select u.name, u.email, p.nom from users u  INNER JOIN profils p ON u.profil_id = p.id

        //$profils = \App\profil::all();
        $users = \App\User::with(['profil'])->get();
        //$users = \App\User::all();
        return view('usersView',['users' => $users]);
    }

    public function create()
    {
        $profils = \App\profil::all();
        return view('addUsersView',['profils' => $profils]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'bail|required|min:2|max:255',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:2|max:255'
        ]);
        //je crée le user
        //vérifier par une variable de session obtenue au login que le user a xxx comme accesUser
        //0: pas d'accès, 1: lecture, 2: modification, 3: ajout, 4: suppression
        // on vérifie donc ques les acces sont >=3
        $user = new \App\User();
        $user->name = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = \Hash::make($request->input('password'));
        $user->profil_id = $request->input('profil');
        $user->save();


        /* ou une autre manniere
        App\User::create(
            [
                'name' =>  $request->input('nom'),
                'email' => $request->input('email'),
                'profil_id' => $request->input('profil'),
                'password' => \Hash::make($request->input('password')),
            ]);*/
        return 'Le User est créé,' . $request->profil.'<BR> <a href="'.route('GestUsers.view').'"> back</a>';

    }


}
