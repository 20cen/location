<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiels = Materiel::all();
        return \view("materiel.index", \compact("materiels"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view("materiel.create");
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
            'nom' => ['required', 'string'],
            'details' => ['required', 'string'],
            'categories_id' => ['required', 'integer']
        ]);

        $materiel = new Materiel();
        $materiel->nom = $request->nom;
        $materiel->details = $request->details;
        $materiel->categories_id = $request->categories_id;
        $materiel->save();
        \toastr()->success("Materiel ajouté");
        return \redirect()->route("materiel.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\$id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materiel = Materiel::find($id);
        if ($materiel == NULL) {
           \toastr()->warning("Aucun matériel trouvé");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\$id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materiel = Materiel::find($id);
        if ($materiel == NULL) {
            \toastr()->warning("Aucun matériel trouvé");
        }

        return \view("materiel.edit", \compact('materiel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string'],
            'details' => ['required', 'string'],
            'categories_id' => ['required', 'integer']
        ]);

        $materiel = Materiel::find($id);
        if ($materiel == NULL) {
            \toastr()->warning("Aucun matériel trouvé");
        }

        $materiel->nom = $request->nom;
        $materiel->details = $request->details;
        $materiel->categories_id = $request->categories_id;
        $materiel->save();
        \toastr()->success("Materiel modifié");
        return \redirect()->route("materiel.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiel $materiel)
    {
        $materiel = Materiel::find($id);
        if ($materiel == NULL) {
            \toastr()->warning("Aucun matériel trouvé");
        }
        $materiel->delete();
        \toastr()->success("Matériel supprimé");
        return \redirect()->route("materiel.index");
    }
}
