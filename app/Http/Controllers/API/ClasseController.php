<?php

namespace App\Http\Controllers\API;

use App\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listes_classes = Classes::all();
        return response()->json([
            'status_code'=>200,
            'listes_classes'=>$listes_classes
        ]);
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
        $code = (!empty($request->code)) ? $request->code : Str::random('4');
        $insert = new Classes();
        $insert->code = $code;
        $insert->libelle = $request->libelle;

        $saved = (bool) $insert->save();
        if ($saved) {
            return response()->json([
                'status_code' => 200,
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Echec'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        //
        $liste_classes = Classes::find($code);
        return response()->json([
            'status_code' => 200,
            'liste_classes' => $liste_classes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        //
        $update = Classes::find($code);
        $update->code = $request->code;
        $update->libelle = $request->libelle;
        $saved = (bool) $update->save();
        if ($saved) {
            return response()->json([
                'status_code' => 200,
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Echec'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $cl = Classes::find($code);
        $delete = (bool) $cl->delete();

        if ($delete) {
            return response()->json([
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status_code' => 400
            ]);
        }
    }
}
