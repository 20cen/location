<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return \view("paiement.index", \compact("locations"));
    }

    public function historique()
    {
        // $paiements = Paiement::all();
        // return \view("paiement.historique", \compact("paiements"));
    }

    public static function montant($id)
    {
        $mt = DB::table('paiements')
        ->where('locations_id', '=', $id)
        ->sum('montant');     
        return $mt;
        // return \view("stock.index", \compact("stocks"));    
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
        $loc = Location::find($request->locations_id);
        if ($loc != NULL) {
            $request->validate([
                'montant' => ['required'],
                'locations_id' => ['required', 'integer'],
                'users_id' => ['required', 'integer']
            ]);
    
            $paiement = new Paiement();
            $paiement->montant = $request->montant;
            $paiement->locations_id = $request->locations_id;
            $paiement->users_id = $request->users_id;
            $paiement->save();
            toastr()->success("Paiement effectué");
            return redirect()->route("paiement.index");
        }

        \toastr()->warning("Aucune location pour cet ID");
        return redirect()->route("paiement.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement == NULL) {
            \toastr()->warning("Aucun paiement trouvé");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement == NULL) {
            \toastr()->warning("Aucun paiement trouvé");
        }
        return \view("paiement.edit", \compact('paiement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => ['required', 'double'],
            'locations_id' => ['required', 'integer'],
            'users_id' => ['required']
        ]);

        $paiement = Paiement::find($id);
        if ($paiement == NULL) {
            \toastr()->warning("Aucun paiement trouvé");
        }

        $paiement->montant = $request->montant;
        $paiement->locations_id = $request->locations_id;
        $paiement->users_id = $request->users_id;
        $paiement->save();
        toastr()->success("Paiement modifié");
        return redirect()->route("paiement.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paiement $paiement)
    {
        $paiement = Paiement::find($id);
        if ($paiement == NULL) {
            \toastr()->warning("Aucun paiement trouvé");
        }

        $paiement->delete();
        \toastr()->success('Paiement supprimée');
        return \redirect()->route('paiement.index');
    }
}
