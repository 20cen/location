<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\Stockactuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockactuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stockactuel::all()->unique('materiels_id');
        return \view("stock.index", \compact("stocks"));
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

    public static function nombre($id)
    {
        $stocka = DB::table('stockactuels')
        ->where('materiels_id', '=', $id)
        ->sum('nombre');     
        return $stocka;
        // return \view("stock.index", \compact("stocks"));    
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
            'materiels_id' => ['required', 'integer']
        ]);

        $stock = new Stockactuel();
        $stock->nombre = $request->nombre;
        $stock->materiels_id = $request->materiels_id;
        $stock->save();
        \toastr()->success("Stock ajouté");
        return \redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stockactuel  $stockactuel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stockactuel::find($id);
        if ($stock == NULL) {
            \toastr()->warning("Aucun stock trouvé");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stockactuel  $stockactuel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stockactuel::find($id);
        if ($stock == NULL) {
            \toastr()->warning("Aucun stock trouvé");
        }
        return \view("stock.edit", \compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stockactuel  $stockactuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'integer'],
            'materiels_id' => ['required', 'integer']
        ]);

        $stock = Stockactuel::find($id);
        if ($stock == NULL) {
            \toastr()->warning("Aucun stock trouvé");
        }

        $stock->nombre = $request->nombre;
        $stock->materiels_id = $request->materiels_id;
        $stock->save();
        \toastr()->success("Stock modifié");
        return \redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stockactuel  $stockactuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stockactuel $stockactuel)
    {
        $stock = Stockactuel::find($id);
        if ($stock == NULL) {
            \toastr()->warning("Aucun stock trouvé");
        }
        $stock->delete();
        \toastr()->success("Stock supprimé");
        return \redirect()->route('stock.index');
    }
}
