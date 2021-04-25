<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marca;
use App\Models\articolo;
use App\Models\magazzino;
use App\Models\tipologia;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class ArticoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AggiungiArticoli');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lean = $request -> input ('lean');
        $sku = $request -> input ('sku');
        $tipologia =  $request -> input ('tipologia');
        $marca = $request -> input ('marca');
        $descrizione = $request -> input ('descrizione');

        $tip = new tipologia;
        $flag = true;
        $tipologia_id = 1;
        foreach($tip as $t)
        {
            if($t[1] == $tipologia)
            {
                $tipologia_id = $t->id;
                echo $tipologia_id;
                $flag = false;
                break;
            }
        }
        if($flag)
        {
            $tip->create([
                'nome'=>$tipologia
            ]);
            foreach($tip as $t)
            {
                if($t[1] == $tipologia)
                {
                    $tipologia_id = $t->id;
                    echo $tipologia_id;
                    break;
                }
            }
        }


        $mar = new marca;
        $flag2 = true;
        $id_marca = 1;
        foreach($mar as $m)
        {
            if($marca == $m[1])
            {
                $id_marca = $m->id;
                echo $id_marca;
                $flag2 = false;
                break;
            }
        }
        if($flag2)
        {
            $mar->create([
                'nome'=>$marca
            ]);
            foreach($mar as $m)
            {
                if($marca == $m[1])
                {
                    $id_marca = $m->id;
                    echo $id_marca;
                    break;
                }
            }
        }


        $art = new articolo;
        $art->create([
            'lean'=>$lean,
            'sku'=>$sku,
            'tipologia_id'=>$tipologia_id,
            'marca_id'=>$id_marca,
            'descrizione'=>$descrizione
        ]);
        $magazzino = new magazzino;
        foreach($art as $a)
        {
            if($a[1] == $lean)
            {
                $magazzino->create([
                    'articolo_id'=>$a->id
                ]);
                break;
            }
        }
        return redirect('/magazzino');
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
    public function destroy($id)
    {
        //
    }
}
