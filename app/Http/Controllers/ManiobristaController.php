<?php

namespace App\Http\Controllers;

use App\Models\Maniobrista;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManiobristaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $maniobristas = Maniobrista::select("maniobristas.*");

        if( request('search'))
        {
            $busqueda = request('search');
            $maniobristas = $maniobristas->where(
                'maniobristas.name','LIKE','%'.$busqueda.'%'   
            );
        }

        return Inertia::render('Maniobristas/Maniobristas.Index', 
        [
            "maniobristas" => fn() => $maniobristas->get(),
            'filters' => request()->all(['search'])
        ]);
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
     * @param  \App\Models\Maniobrista  $maniobrista
     * @return \Illuminate\Http\Response
     */
    public function show(Maniobrista $maniobrista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maniobrista  $maniobrista
     * @return \Illuminate\Http\Response
     */
    public function edit(Maniobrista $maniobrista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maniobrista  $maniobrista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maniobrista $maniobrista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maniobrista  $maniobrista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maniobrista $maniobrista)
    {
        //
    }
}
