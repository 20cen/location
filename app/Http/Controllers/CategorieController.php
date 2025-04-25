<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        return \view("categorie.index", \compact("categories"));
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
            'nom' => ['required', 'string', 'unique:categories']
        ]);

        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->save();
        toastr()->success("Catégorie ajouté");
        return redirect()->route("categorie.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::find($id);
        if ($categorie == NULL) {
            \toastr()->warning("Aucune catégorie trouvée");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        if ($categorie == NULL) {
            \toastr()->warning("Aucune catégorie trouvée");
        }

        return \view("categorie.edit", \compact('categorie'));
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
        $request->validate([
            'nom' => ['required', 'string', 'unique:categories']
        ]);

        $categorie = Categorie::find($id);
        if ($categorie == NULL) {
            \toastr()->warning("Aucune catégorie trouvée");
        }
        $categorie->nom = $request->nom;
        $categorie->save();
        \toastr()->success("Catégorie modifiée");
        return redirect()->route("categorie.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if ($categorie == NULL) {
            \toastr()->warning("Aucune catégorie trouvée");
        }

        $categorie->delete();
        \toastr()->success("Catégorie supprimée");
        return \redirect()->back();
    }
}
