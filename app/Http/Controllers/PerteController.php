<?php

namespace App\Http\Controllers;

use App\Models\Perte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertes = Perte::all();
        return \view("perte.index", \compact("pertes"));
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
            'nombre' => ['required', 'integer'],
            'details' => ['required', 'string'],
            'materiels_id' => ['required', 'integer']
        ]);

        $perte = new Perte();
        $perte->nombre = $request->nombre;
        $perte->details = $request->details;
        $perte->materiels_id = $request->materiels_id;
        $perte->save();
        \toastr()->success('Perte renseignée');
        return \redirect()->route('perte.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perte  $perte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perte = Perte::find($id);
        if ($perte == NULL) {
            \toastr()->warning("Aucune perte trouvée");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perte  $perte
     * @return \Illuminate\Http\Response
     */
    public function edit(Perte $perte)
    {
        $perte = Perte::find($id);
        if ($perte == NULL) {
            \toastr()->warning("Aucune perte trouvée");
        }

        return \view("perte.edit", \compact("perte"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perte  $perte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'integer'],
            'details' => ['required', 'string'],
            'materiels_id' => ['required', 'integer']
        ]);

        $perte = Perte::find($id);
        if ($perte == NULL) {
            \toastr()->warning("Aucune perte trouvée");
        }
        $perte->nombre = $request->nombre;
        $perte->details = $request->details;
        $perte->materiels_id = $request->materiels_id;
        $perte->save();
        \toastr()->success('Perte modifiée');
        return \redirect()->back();
    }

    public static function nombre($id)
    {
        $pert = DB::table('pertes')
        ->where('materiels_id', '=', $id)
        ->sum('nombre');     
        return $pert;
        // return \view("stock.index", \compact("stocks"));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perte  $perte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perte = Perte::find($id);
        if ($perte == NULL) {
            \toastr()->warning("Aucune perte trouvée");
        }

        $perte->delete();
        \toastr()->success('Perte supprimée');
        return \redirect()->route('perte.index');
    }
}
