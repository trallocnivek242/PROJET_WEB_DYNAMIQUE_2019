<?php

namespace App\Http\Controllers;

use App\user;
use App\profil;
use Illuminate\Http\Request;
use Redirect,Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //$users = user::paginate(5);
        //je charge la liste de tous les profil pour remplir la combo du add
        $profils = profil::all();
        //je charge les users avec leur profil lisible
        $users = user::with(['profil'])->paginate(5);

        if ($request->ajax()) {
            return view('user.load', ['users' => $users])->render();
        }

        return view('user.index', compact('users','profils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userId = $request->user_id;
        if($userId>0)
        {
            $user = user::find($userId);
            if($user)
            {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->profil_id = $request->profil;
                $user->save();
            }

        }
        else
        {
            $user = new user;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $user->profil_id = $request->profil;
            $user->save();
        }
        $profil = profil::where('id','=',$request->profil)->first();

        //return Response::json($user);
        //je renvoie le user créé ou mis à jour et son profil
        return Response::json(array('user'=>$user,'profil'=>$profil));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user  = user::where('id','=',$id)->first();
        //$user = user::with(['profil'])->where('id','=',$id)->first();

        return Response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = user::where('id',$id)->delete();

        return Response::json($user);
    }
}
