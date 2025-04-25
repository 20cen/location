<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return \view("user.index", \compact("users"));
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
            "nom"=>["required","string"],
            "prenom"=>["required","string"],
            "sexe"=>["required","string"],
            "telephone"=>["required","string","unique:users"],
            "email"=>["required","email","unique:users"],
            "password"=>["required","string"]
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;        
        $user->sexe = $request->sexe;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        toastr()->success("Utilisateur ajouté");
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user == NULL) {
            \toastr()->warning("Utilisateur inconnu");
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
        $user = User::find($id);
        if ($user == NULL) {
            \toastr()->warning("Utilisateur inconnu");
        }

        return \view("user.edit", \compact("user"));
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
        $user = User::find($id);
        if ($user == NULL) {
            \toastr()->warning("Utilisateur inconnu");
        }

        $request->validate([
            "nom"=>["required","string"],
            "prenom"=>["required","string"],
            "sexe"=>["required","string"],
            "telephone"=>["required","string"],
            "email"=>["required","email"]
        ]);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;        
        $user->sexe = $request->sexe;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->save();
        toastr()->success("Utilisateur modifié");
        return redirect()->route('user.index');
    }

    public function profil($id)
    {
        $user = User::find($id);
        if ($user == NULL) {
            \toastr()->warning("Utilisateur inconnu");
        }
        return \view("user.profil", \compact("user"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user == NULL) {
            \toastr()->warning("Utilisateur inconnu");
        }
        $user->delete();
        toastr()->success("Utilisateur supprimé");
        return redirect()->route('user.index');
    }
}
