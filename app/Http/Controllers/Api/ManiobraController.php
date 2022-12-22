<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusManiobra;
use App\Http\Controllers\Controller;
use App\Models\Maniobra;
use Illuminate\Http\Request;

class ManiobraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maniobras = Maniobra::select(
            'maniobras.id',
            'maniobras.name',
            'maniobras.descripcion',
            'maniobras.salario',
            'maniobras.status_maniobra_id',
            'clientes.name AS cliente'
        )
            ->join('clientes', 'maniobras.cliente_id', 'clientes.id')
            ->where('maniobras.status_maniobra_id', '=', StatusManiobra::PENDIENTE->value);
        if ($request->has('search')) {
            $search =  strtr(request('search'), array("'" => "\\'", "%" => "\\%"));
            $maniobras->where('maniobras.name', 'like', '%' . $search . '%');
        }
        if ($request->has('field')) {
            $maniobras->orderBy(
                $request->field,
                $request->direction
            );
        } else {
            $maniobras->orderBy('maniobras.created_at', 'desc');
        }

        $perPage = $request->per_page === null ? 30 : (int) $request->per_page;

        $maniobras = $maniobras
            ->simplePaginate($perPage)
            ->withQueryString() // agrega el request a las urls
            ->withPath('/maniobras');
        return response()->json($maniobras);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
