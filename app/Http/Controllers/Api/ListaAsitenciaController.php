<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListaAsitencia;
use App\Models\TurnoFecha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListaAsitenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TurnoFecha $turnoFecha, Request $request)
    {
        $maniobritas = $turnoFecha->listaAsitencias()
            ->select(
                'lista_asitencias.id',
                'lista_asitencias.maniobrista_id',
                'lista_asitencias.asistencia',
                'lista_asitencias.imagen_url',
                'maniobristas.name',
                'maniobristas.ap_paterno',
                'maniobristas.ap_materno'
            )
            ->join('maniobristas', 'lista_asitencias.maniobrista_id', '=', 'maniobristas.id')
            ->where('lista_asitencias.active', '=', 1);
        if ($request->has('search')) {
            $search = '%' . str($request->inut('search'))->replace('%', '\%') . '%';
            $maniobritas->where(function ($query) use ($search) {
                $query->where('maniobritas.name', 'like', $search)
                    ->orWhere('maniobritas.ap_paterno', 'like', $search);
            });
        }

        return response()->json([
            'data' => $maniobritas->get()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListaAsitencia $listaAsitencia)
    {

        $request->validate([
            'asistencia' => ['required', 'boolean'],
            'imagen' => ['required', 'mimes:png,jpg,jpeg']
        ]);

        $file = $request->file('imagen');
        $extension = $file->extension();
        $disk =  Storage::disk('public');

        $maniobrista = $listaAsitencia->maniobrista;
        $maniobristaSlug =  str($maniobrista->name . ' ' . $maniobrista->ap_paterno . ' ' . $maniobrista->ap_materno)->slug();

        $path =  $disk->putFileAs('asistencias/' . $listaAsitencia->turno_fecha_id, $file, $maniobristaSlug . '.' . $extension);

        $listaAsitencia->update([
            'asistencia' => $request->input('asistencia'),
            'imagen_url' => asset('storage/' . $path)
        ]);
    }
}
