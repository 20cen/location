<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarifs = Tarif::all();
        return \view("tarif.index", \compact("tarifs"));
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
        $request->validate([
            'materiels_id' => ['required', 'integer', 'unique:tarifs'],
            'typelocations_id' => ['required', 'integer'],
            'montant' => ['required']
        ]);

        $tarif = new Tarif();
        $tarif->materiels_id = $request->materiels_id;
        $tarif->typelocations_id = $request->typelocations_id;
        $tarif->montant = $request->montant;
        $tarif->save();
        toastr()->success("Tarif ajouté");
        return redirect()->route("tarif.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarif = Tarif::find($id);
        if ($tarif == NULL) {
            \toastr()->warning("Aucun tarif trouvé");
        }
    }

    public static function findbymaterielid($id)
    {
        $tarf = DB::table('tarifs')
        ->where('materiels_id', '=', $id)->sum("montant"); 
        // if ($tarf == NULL) {
        //     return 0;
        // }    
        return $tarf;
    }

    public static function findtypetarif($id)
    {
        $type = Tarif::where('materiels_id', $id)->first();
        if ($type != NULL) {
            return $type->typelocations_id;
        }
        return NULL;
        \toastr()->warning("Tarif du matériel monquant");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarif = Tarif::find($id);
        if ($tarif == NULL) {
            \toastr()->warning("Aucun tarif trouvé");
        }

        return \view("tarif.edit", \compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'materiels_id' => ['required', 'integer'],
            'typelocations_id' => ['required', 'integer'],
            'montant' => ['required']
        ]);

        $tarif = Tarif::find($id);
        if ($tarif == NULL) {
            \toastr()->warning("Aucun tarif trouvé");
        }

        $tarif->materiels_id = $request->materiels_id;
        $tarif->typelocations_id = $request->typelocations_id;
        $tarif->montant = $request->montant;
        $tarif->save();
        toastr()->success("Tarif modifié");
        return redirect()->route("tarif.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarif $tarif)
    {
        //
    }
}
