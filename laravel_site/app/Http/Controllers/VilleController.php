<?php

namespace App\Http\Controllers;

use App\ville;
use Illuminate\Http\Request;
use Redirect,Response;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $villes = ville::paginate(5);

        if ($request->ajax()) {
            return view('ville.load', ['villes' => $villes])->render();
        }

        return view('ville.index', compact('villes'));

        /*$data['villes'] = ville::orderBy('id','desc')->paginate(20);

        return view('ajax-crud',$data);*/

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
        $villeId = $request->ville_id;
        if($villeId>0)
        {
            /*$ville   =   ville::updateOrCreate(['id' => $villeId],
            ['ville' => $request->ville, 'CP' => $request->CP]);*/
            $ville = ville::find($villeId);
            if($ville)
            {
                $ville->ville = $request->ville;
                $ville->CP = $request->CP;
                $ville->save();
            }

        }
        else
        {
            $ville = new ville;
            $ville->ville = $request->ville;
            $ville->CP = $request->CP;
            $ville->save();
        }


        return Response::json($ville);
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
        $where = array('id' => $id);
        $ville  = ville::where($where)->first();

        return Response::json($ville);
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
        $ville = ville::find($id);
        if($ville)
        {
            $ville->ville = $request->ville;
            $ville->CP = $request->CP;
            $ville->save();
        }
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
        $ville = ville::where('id',$id)->delete();

        return Response::json($ville);
    }
}
