<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\Ean;
use Illuminate\Support\Facades\DB;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function magazzino()
    {
        $query = DB::select('SELECT logistics.id, codes.ean, codes.sku, codes.descrizione, logistics.quantita
                             FROM logistics, codes, locations
                             WHERE logistics.code_id = codes.id
                             AND logistics.location_id = locations.id
                             AND locations.nome LIKE "magazzino"');
        $query = (object)$query;
        // dd($query);
        return view('Magazzino', compact('query'));
    }

    public function negozio()
    {
        $query = DB::select('SELECT logistics.id, codes.ean, codes.sku, codes.descrizione, logistics.quantita
                             FROM logistics, codes, locations
                             WHERE logistics.code_id = codes.id
                             AND logistics.location_id = locations.id
                             AND locations.nome LIKE "negozio"');
        $query = (object)$query;
        // dd($query);
        return view('Negozio', compact('query'));
    }


    public function delete($id, $quantita)
    {
        return view('Elimina', compact('id', 'quantita'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $quantita)
    {
        $numero = $request->input('numero');
        $logistic = new Logistic;
        $logistic = $logistic->find($id);
        if($numero > $quantita)
        {
            echo 'La quantità che si vuole eliminare è maggiore di quella disponibile';
        }
        elseif($numero == $quantita)
        {
            $logistic->delete();
        }
        else
        {
            if($numero > 0)
            {
                $newQuantita = $quantita - $numero;
                $logistic->update([
                    'quantita'=> $newQuantita
                ]);
            }
            else{
                echo 'Smetti di fare il simpatico, grazie';
            }
        }
        return redirect('/magazzino');


    }
}