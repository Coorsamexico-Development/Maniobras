<?php

namespace App\Http\Controllers;

use App\Models\Maniorbra;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManiorbraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        return Inertia::render('Maniobras/Maniobras.Index', 
        []);
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
     * @param  \App\Models\Maniorbra  $maniorbra
     * @return \Illuminate\Http\Response
     */
    public function show(Maniorbra $maniorbra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maniorbra  $maniorbra
     * @return \Illuminate\Http\Response
     */
    public function edit(Maniorbra $maniorbra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maniorbra  $maniorbra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maniorbra $maniorbra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maniorbra  $maniorbra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maniorbra $maniorbra)
    {
        //
    }
}
