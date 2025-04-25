<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return \view('client.index', \compact('clients'));
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
            'nom' => ['required', 'string', 'unique:clients'],
            'adresse' => ['required', 'string'],
            'telephone' => ['required', 'string', 'unique:clients']
        ]);

        $client = new Client();
        $client->nom = $request->nom;
        $client->adresse = $request->adresse;
        $client->telephone = $request->telephone;
        $client->save();
        \toastr()->success('Client ajouté');
        return \redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        if ($client == NULL) {
           \toastr()->warning('Aucun client trouvé');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if ($client == NULL) {
            \toastr()->warning("Aucun client trouvé");
        }

        return \view('client.edit', \compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string'],
            'adresse' => ['required', 'string'],
            'telephone' => ['required', 'string']
        ]);

        $client = Client::find($id);
        if ($client == NULL) {
            \toastr()->warning("Aucun client trouvé");
        }

        $client->nom = $request->nom;
        $client->adresse = $request->adresse;
        $client->telephone = $request->telephone;
        $client->save();
        \toastr()->success('Client modifié');
        return \redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\$id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if ($client == NULL) {
            \toastr()->warning("Aucun client trouvé");
        }

        $client->delete();
        \toastr()->success("Client supprimé avec succès");
        return \redirect()->back();
    }
}
