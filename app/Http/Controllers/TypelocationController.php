<?php

namespace App\Http\Controllers;

use App\Models\Typelocation;
use Illuminate\Http\Request;

class TypelocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Typelocation::all();
        return \view("type.index", \compact("types"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Typelocation  $typelocation
     * @return \Illuminate\Http\Response
     */
    public function show(Typelocation $typelocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Typelocation  $typelocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Typelocation $typelocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Typelocation  $typelocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Typelocation $typelocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Typelocation  $typelocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Typelocation $typelocation)
    {
        //
    }
}
