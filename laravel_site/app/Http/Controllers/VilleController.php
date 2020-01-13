<?php

namespace App\Http\Controllers;

use App\ville;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Redirect,Response;
use Session;

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
        //je lis le tri à utiliser dans la session, si il n'y en a pas je le crée sur 'ville'

        if(Session::has('SortVille')){
            $MySort=Session::get('SortVille');
            if(Session::has('SortOrderVille')){
            $MyOrder=Session::get('SortOrderVille');//desc ou asc
            }
            else
            {
                $MyOrder='asc';
                Session::put('SortOrderVille',$MyOrder);
            }
        }
        else{
            $MySort='ville';
            $MyOrder='asc';
            Session::put('SortVille',$MySort);
            Session::put('SortOrderVille',$MyOrder);
        }

        $sortBy=$request->sortBy;
        if($sortBy&&($sortBy=='id'||$sortBy=='ville'||$sortBy=='CP')){
            //je stocke en variable de session le tri à utiliser
            //Session::put('SortOrderVille',$order);
            if($MySort==$sortBy)
            {
                //je change le 'asc en desc ou l'inverse
                if($MyOrder=='asc'){
                    $MyOrder='desc';
                }
                else{
                    $MyOrder='asc';
                }
            }
            else{
                $MyOrder='asc';
            }
            $MySort=$sortBy;
            Session::put('SortVille',$MySort);
            Session::put('SortOrderVille',$MyOrder);
        }

        //return $MyOrderType;
        //->orderBy('name', 'desc') ou  ->orderBy('name', 'asc')
        $villes = ville::orderby($MySort,$MyOrder)->paginate(5);
        if ($request->ajax()) {
            return view('ville.load', ['villes' => $villes])->render();
        }

        return view('ville.index', compact('villes'));
        //return view('ville.index',  ['villes' => $villes]);

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
				return view('ville.create');
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

            $ville = new ville;
            $ville->ville = $request->ville;
            $ville->CP = $request->CP;
            $ville->save();


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
				$where = array('id' => $id);
        $ville  = ville::where($where)->first();

        return Response::json($ville);
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
				return view('ville.edit',['ville' => $ville])->render();
        //return Response::json($ville);
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
				return Response::json($ville);
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
