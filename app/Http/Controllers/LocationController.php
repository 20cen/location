<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PerteController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StockactuelController;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all()
        ->where('etat', '=', 'actif');
        return \view("location.index", \compact("locations"));
    }

    public static function paiement()
    {
        $locations = Location::all();
        // return \view("paiement.index", \compact("locations"));
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

    public function historique()
    {
        $locations = Location::all()
        ->where('etat', '=', 'inactif');
        return \view("historique.index", \compact("locations"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cl = Client::find($request->clients_id);
        if ($cl != NULL) {
            $request->validate([
                'nombre' => ['required', 'integer'],
                'materiels_id' => ['required', 'integer'],
                'clients_id' => ['required', 'integer'],
                'dateprise' => ['required'],
                'heureprise' => ['required']
            ]);

            //Vérification de la quantité
            $stock = StockactuelController::nombre($request->materiels_id);
            $perte = PerteController::nombre($request->materiels_id);
            $louer = LocationController::nombre($request->materiels_id);

            $totalrestant = (int)($stock - ($perte + $louer));
            $nombre = (int)$request->nombre;

            if ($totalrestant >= $nombre) {
                $location = new Location();
                $location->nombre = $request->nombre;
                $location->materiels_id = $request->materiels_id;
                $location->clients_id = $request->clients_id;
                $location->created_at = $request->dateprise." ".$request->heureprise;
                $location->save();
                \toastr()->success("Location ajoutée");
                return \redirect()->route("location.index");
            } else {
                \toastr()->warning("Quantité insuffisante, reste: ".$totalrestant);
            }
        }
        \toastr()->warning("ID client non trouvé");
        return \redirect()->route("location.index");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\$id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        if ($location == NULL) {
            \toastr()->warning("Aucune location trouvée");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        if ($location == NULL) {
            \toastr()->warning("Aucune location trouvée");
        }
        
        return \view("location.edit", \compact("location"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'integer'],
            'materiels_id' => ['required', 'integer'],
            'clients_id' => ['required', 'integer']
        ]);

        $location = Location::find($id);
        if ($location == NULL) {
            \toastr()->warning("Aucune location trouvée");
        }

        $location->nombre = $request->nombre;
        $location->materiels_id = $request->materiels_id;
        $location->clients_id = $request->clients_id;
        $location->save();
        \toastr()->success("Location modifiée");
        return \redirect()->back();
    }

    public function changestate(Request $request)
    {
        $location = Location::find($request->id);
        if ($location == NULL) {
            \toastr()->warning("Aucune location trouvée");
        }else{
            $request->validate([
                'dateremise' => ['required'],
                'heureremise' => ['required']
            ]);

            $location->etat = 'inactif';
            $location->updated_at = $request->dateremise." ".$request->heureremise;
            $location->save();
            \toastr()->success("Remise effectuée");            
        }
        return \redirect()->route('location.index');

        
    }

    public function activate(Request $request)
    {
        $location = Location::find($request->id);
        if ($location == NULL) {
            \toastr()->warning("Aucune location trouvée");
        }else{
            $location->etat = 'actif';
            $location->save();
            \toastr()->success("Remise effectuée");            
        }
        return \redirect()->route('historique.index');

        
    }

    public static function nombre($id)
    {
        $loc = DB::table('locations')
        ->where('materiels_id', '=', $id)
        ->where('etat', '=', 'actif')
        ->sum('nombre');     
        return $loc;
        // return \view("stock.index", \compact("stocks"));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\$id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        if ($location == NULL) {
            \toastr()->warning("Aucune location trouvée");
        }
        $location->delete();
        \toastr()->success("Location supprimée");
        return \redirect()->route('location.index');
    }
}
