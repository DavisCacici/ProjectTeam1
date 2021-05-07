<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\Code;
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






    public function move($id, $quantita)
    {
        return view('sposta', compact('id', 'quantita'));
    }


    public function sposta(Request $request, $id, $quantita)
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
            $query = DB::select('SELECT *
                                     FROM logistics
                                     WHERE logistics.location_id = 2');
            $flag = true;
            $query = (object)$query;
            foreach($query as $q)
            {
                if($q->code_id == $logistic->code_id)
                {
                    DB::table('logistics')->where('location_id', 2)->where('code_id', $logistic->code_id)->increment('quantita', $numero);
                    $logistic->delete();
                }
            }

            if($flag)
            {
                $log = new Logistic;
                $log::create([
                    'code_id'=> $logistic->code_id,
                    'location_id'=>2,
                    'quantita'=> $numero
                ]);
                $logistic->delete();
            }


        }
        //3° caso viene aggiornato il campo quantita sottraendo il numero passato dalla scermata Elimina (da cui sono stati passati i parametri)
        else
        {
            if($numero > 0)
            {
                $query = DB::select('SELECT *
                                     FROM logistics
                                     WHERE logistics.location_id = 2');

                $flag = true;
                $query = (object)$query;
                foreach($query as $q)
                {
                    if($q->code_id == $logistic->code_id)
                    {
                        DB::table('logistics')->where('location_id', 2)->where('code_id', $logistic->code_id)->increment('quantita', $numero);

                        $newQuantita = $quantita - $numero;
                        $logistic->update([
                            'quantita'=>$newQuantita
                        ]);
                        $flag = false;
                        break;
                    }

                }
                if($flag)
                {
                    $log = new Logistic;
                    $log::create([
                        'code_id'=> $logistic->code_id,
                        'location_id'=>2,
                        'quantita'=> $numero
                    ]);
                    $newQuantita = $quantita - $numero;
                    $logistic->update([
                        'quantita'=>$newQuantita
                    ]);
                }

            }
            // Qui viene gestito il caso in cui venga messo in input un numero negativo con un simpatico messaggio
            // (si potrebbe risolvere obbligando a passare nella pagine un tipo certo di dato? )
            else{
                echo 'Smetti di fare il simpatico, grazie';
            }
        }
        return redirect('/negozio');

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = DB::table('codes')->pluck('ean', 'id');
        return view('AggiungiArticoli', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $request->input('code_id');
        $quantita = $request->input('quantita');
        $query = DB::select('SELECT * FROM logistics
                             WHERE location_id = 1
                             AND code_id = ?', [$code]);
        if($query)
        {
            DB::table('logistics')->where('location_id', 1)->where('code_id', $code)->increment('quantita', $quantita);
        }
        else{
            $logistic = new Logistic;
            $logistic->create([
                'code_id'=> $code,
                'location_id'=> 1,
                'quantita' => $quantita
            ]);
        }
        return redirect('/magazzino');
    }

    public function newcode(Request $request)
    {
        $code = new Code;
        $code->create([
            'ean'=>$request->input('ean'),
            'sku'=>$request->input('sku'),
            'descrizione'=>$request->input('descrizione')
        ]);

        return redirect('/newarticoli');

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


}
