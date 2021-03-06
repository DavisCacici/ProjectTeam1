<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\Code;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storico()
    {
        // Questa query riempie la tabella nella pagina "ProdottiVenduti"

        $query = Logistic::join('codes', 'logistics.code_id', '=','codes.id')
                 ->join('locations', 'logistics.location_id', '=', 'locations.id')
                 ->select('logistics.id', 'codes.ean', 'codes.sku', 'codes.descrizione', 'logistics.quantita', 'locations.nome', 'logistics.data')
                 ->where('locations.nome', 'LIKE', 'storico')->orderby('data', 'desc')->get();


        $query = (object)$query;
        // dd($query);
        $storico = 'Storico';
        return view('ProdottiVenduti', compact('query', 'storico'));
    }

    public function magazzino()
    {
        // Questa query riempie la tabella nella pagina "Magazzino"
        $query = Logistic::join('codes', 'logistics.code_id', '=','codes.id')
                ->join('locations', 'logistics.location_id', '=', 'locations.id')
                ->select('logistics.id', 'codes.ean', 'codes.sku', 'codes.descrizione', 'logistics.quantita', 'locations.nome')
                ->where('locations.nome', 'LIKE', 'magazzino')->get();
        $query = (object)$query;
        // dd($query);
        $magazzino = 'Magazzino';
        return view('Magazzino', compact('query', 'magazzino'));
    }

    public function negozio()
    {
        // Questa query riempie la tabella nella pagina "Negozio"
        $query = Logistic::join('codes', 'logistics.code_id', '=','codes.id')
                ->join('locations', 'logistics.location_id', '=', 'locations.id')
                ->select('logistics.id', 'codes.ean', 'codes.sku', 'codes.descrizione', 'logistics.quantita', 'locations.nome')
                ->where('locations.nome', 'LIKE', 'negozio')->get();
        $query = (object)$query;
        $negozio = 'Negozio';
        // dd($query);
        return view('Negozio', compact('query', 'negozio'));
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
        // 1?? caso vengono eliminati pi?? quantita di quelle esistenti e viene restutito un errore in echo
        if($numero > $quantita)
        {
            return '<h1>La quantit?? che si vuole eliminare ?? maggiore di quella disponibile</h1>';
        }
        // 2?? caso vengono eliminati tutte le quantita quindi la riga in questione viene eliminata dal DB
        elseif($numero == $quantita)
        {
            $logistic->delete();
            if($logistic->location_id == 1)
            {
                return redirect('/magazzino');
            }
            else{
                return redirect('/negozio');
            }
        }
        //3?? caso viene aggiornato il campo quantita sottraendo il numero passato dalla scermata Elimina (da cui sono stati passati i parametri)
        else
        {
            if($numero > 0)
            {
                $newQuantita = $quantita - $numero;
                $logistic->update([
                    'quantita'=> $newQuantita
                ]);

                if($logistic->location_id == 1)
                {
                    return redirect('/magazzino');
                }
                else{
                    return redirect('/negozio');
                }
            }
            // Qui viene gestito il caso in cui venga messo in input un numero negativo con un simpatico messaggio
            // (si potrebbe risolvere obbligando a passare nella pagine un tipo certo di dato? )
            else{
                return '<h1>Smetti di fare il simpatico, grazie</h1>';
            }
        }


    }





    /**
     * Quando si preme il bottone sposta situato nella pagina /magazzino
     * si richiama la view sposta dove verr?? passata insieme ad esso
     * l'id e la quantit?? presente in quella row che vengo ricevuti
     * grazie alla pressione del bottone
     */
    public function move($id, $quantita)
    {
        return view('sposta', compact('id', 'quantita'));
    }

    /**
     * Nella Pagina omonima 'sposta' verranno mandati al seguente metodo
     * sempre l'id del prodotto insieme alla quantita ma in pi?? rispetto
     * a prima la request del form che sar?? la quantit?? che dovr?? essere
     * spostata
     */
    public function sposta(Request $request, $id, $quantita)
    {
        $numero = $request->input('numero');
        $logistic = new Logistic;
        $logistic = $logistic->find($id);
        $query = Logistic::where('location_id', 2)->get();
        $query = (object)$query;
        // 1?? caso vengono eliminati pi?? quantita di quelle esistenti e viene restutito un errore in echo
        if($numero > $quantita)
        {
            return '<h1>La quantit?? che si vuole eliminare ?? maggiore di quella disponibile</h1>';
        }
        // 2?? caso vengono eliminati tutte le quantita quindi la riga in questione viene eliminata dal DB
        elseif($numero == $quantita)
        {
            $flag = true;

            foreach($query as $q)
            {
                if($q->code_id == $logistic->code_id)
                {
                   Logistic::where('location_id', 2)->where('code_id', $logistic->code_id)->increment('quantita', $numero);
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

            return redirect('/negozio');
        }
        //3?? caso viene aggiornato il campo quantita sottraendo il numero passato dalla scermata Elimina (da cui sono stati passati i parametri)
        else
        {
            if($numero > 0)
            {
                $flag = true;

                foreach($query as $q)
                {
                    if($q->code_id == $logistic->code_id)
                    {
                        Logistic::where('location_id', 2)->where('code_id', $logistic->code_id)->increment('quantita', $numero);

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
                return redirect('/negozio');
            }
            // Qui viene gestito il caso in cui venga messo in input un numero negativo con un simpatico messaggio
            // (si potrebbe risolvere obbligando a passare nella pagine un tipo certo di dato? )
            else{
                return '<h1>Smetti di fare il simpatico, grazie</h1>';
            }
        }

    }





    /**
     * Il seguente metodo ritorna la view AggiungiArticoli e gli
     * vengono passati i dati della tabella codes in particolare
     * quelli delle colonne id e codice ean che successivamente
     * verranno utilizzate per creare una select per la scelta multipla
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = DB::table('codes')->pluck('ean', 'id');
        return view('AggiungiArticoli', compact('code'));
    }

    /**
     * Creare o incrementare i prodotti nel Magazzino
     * il metodo store in parole povere prende le richieste inviate dal nostro form
     * e se esistesse un elemento all'interno lo si incrementa altrimenti lo si crea
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $request->input('code');
        $quantita = $request->input('quantita');


        $ean =  Code::select('id')->where('ean', $code)->get();
        $ean = $ean[0];

        $query = Logistic::join('codes', 'logistics.code_id', '=','codes.id')
                ->select('logistics.*', 'codes.ean')
                ->where('logistics.location_id', 1)
                ->where('codes.ean', $code)
                ->get();

        if(count($query) > 0)
        {
            Logistic::where('location_id', 1)
                ->where('code_id', $ean->id)
                ->increment('quantita', $quantita);
        }
        else{
            $new = new logistic;
            $new->create([
                'code_id'=>$ean->id,
                'location_id'=>1,
                'quantita'=>$quantita
            ]);
        }
        return redirect('/magazzino');
    }


    /**
     * Il metodo newcode svolge la funzione di creare un nuovo record nella tabella Code
    */
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
     * Il seguente metodo aiuta a ricercare un determinato elemento
     * filtrando tutte le liste ritornardo il risultato di una query
     */
    public function ricerca(Request $request, $location)
    {
        $ricerca = $request->input('ricerca');

        $query = DB::select('SELECT logistics.id, codes.ean, codes.sku, codes.descrizione, logistics.quantita, locations.nome, logistics.data
                             FROM logistics, codes, locations
                             WHERE logistics.code_id = codes.id
                             AND logistics.location_id = locations.id
                             AND locations.nome LIKE ?
                             AND (codes.ean LIKE ?
                             OR codes.sku LIKE ?
                             OR codes.descrizione LIKE ?
                             OR logistics.quantita LIKE ?
                             OR logistics.data LIKE ?)', [$location, $ricerca, $ricerca, $ricerca, $ricerca, $ricerca]);

        $query = (object)$query;
        // dd($query);
        return view('Ricerca', compact('query', 'location'));
    }

    public function sell($id, $quantita)
    {
        return view('vendi', compact('id', 'quantita'));
    }


    // Quando questa funzione viene richimata dal bottone venduto e passati i parametri ID e Quantita vengono applicati 3 casi
    public function vendi(Request $request, $id, $quantita)
    {
        $d=strtotime("today");
        // dd(date('Y-m-d', $d));
        $date = date('Y-m-d', $d);
        $numero = $request->input('numero');
        $logistic = new Logistic;
        $logistic = $logistic->find($id);
        $query = Logistic::where('location_id', 3)->where('data', $date)->get();
        $query = (object)$query;

        // 1?? caso si cerca di spostare in vendute pi?? quantita di quelle esistenti e viene restutito un errore in echo
        if($numero > $quantita)
        {
            return '<h1>La quantit?? che si vuole eliminare ?? maggiore di quella disponibile</h1>';
        }
        // 2?? caso si cerca di spostare in vendute tutte le quantita quindi la riga in questione viene eliminata dal DB
        elseif($numero == $quantita)
        {
            $flag = true;
            foreach($query as $q)
            {
                if($q->code_id == $logistic->code_id)
                {
                    Logistic::where('location_id', 3)->where('code_id', $logistic->code_id)->where('data', $date)->increment('quantita', $numero);
                    $logistic->delete();
                    $flag = false;
                }
            }

            if($flag)
            {
                $log = new Logistic;
                $log::create([
                    'code_id'=> $logistic->code_id,
                    'location_id'=>3,
                    'quantita'=> $numero,
                    'data'=>date('Y-m-d', $d)
                ]);
                $logistic->delete();
            }
            return redirect('/storico');
        }
        //3?? caso viene aggiornato il campo quantita sottraendo il numero passato dalla scermata Elimina (da cui sono stati passati i parametri)
        else
        {
            if($numero > 0)
            {
                $flag = true;
                foreach($query as $q)
                {
                    if($q->code_id == $logistic->code_id)
                    {
                        Logistic::where('location_id', 3)->where('code_id', $logistic->code_id)->where('data', $date)->increment('quantita', $numero);
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
                        'location_id'=>3,
                        'quantita'=> $numero,
                        'data'=>date('Y-m-d', $d)
                    ]);
                    $newQuantita = $quantita - $numero;
                    $logistic->update([
                        'quantita'=>$newQuantita
                    ]);

                }
                return redirect('/storico');
            }
            // Qui viene gestito il caso in cui venga messo in input un numero negativo con un simpatico messaggio
            // (si potrebbe risolvere obbligando a passare nella pagine un tipo certo di dato? )
            else{
                return '<h1>Smetti di fare il simpatico, grazie</h1>';
            }
        }

    }




}
