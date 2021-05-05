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
        // Questa query riempie la tabella nella pagina "Magazzino"
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
        // Questa query riempie la tabella nella pagina "Negozio"
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

    // Quando questa funzione viene richimata dal bottone elimina e passati i parametri ID e Quantita vengono applicati 3 casi
    public function destroy(Request $request, $id, $quantita)
    {
        $numero = $request->input('numero');
        $logistic = new Logistic;
        $logistic = $logistic->find($id);
        // 1° caso vengono eliminati più quantita di quelle esistenti e viene restutito un errore in echo
        if($numero > $quantita)
        {
            echo 'La quantità che si vuole eliminare è maggiore di quella disponibile';
        }
        // 2° caso vengono eliminati tutte le quantita quindi la riga in questione viene eliminata dal DB
        elseif($numero == $quantita)
        {
            $logistic->delete();
        }
        //3° caso viene aggiornato il campo quantita sottraendo il numero passato dalla scermata Elimina (da cui sono stati passati i parametri)
        else
        {
            if($numero > 0)
            {
                $newQuantita = $quantita - $numero;
                $logistic->update([
                    'quantita'=> $newQuantita
                ]);
            }
            // Qui viene gestito il caso in cui venga messo in input un numero negativo con un simpatico messaggio
            // (si potrebbe risolvere obbligando a passare nella pagine un tipo certo di dato? )
            else{
                echo 'Smetti di fare il simpatico, grazie';
            }
        }
        if($logistic->location_id == 1)
        {
            return redirect('/magazzino');
        }
        else{
            return redirect('/negozio');
        }



    }
}
