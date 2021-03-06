@extends('layouts.navbar')
@section('title', 'Storico')
@section('content')
    @auth
        <div class="row">
            <div class="col">
                <label class="label"><h1>Prodotti venduti </h1></label>
            </div>
            <div class="col cerca">
                <form method="GET" action="/ricerca/{{$storico}}">
                    <input type="text" name="ricerca" style="height: 35px" placeholder="Cerca">
                    <button type="submit" class="btn btn-success" style="height: 35px">cerca</button>
                </form>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 200px" >EAN</th>
                <th scope="col" style="width: 200px" >SKU</th>
                <th scope="col" style="width: 300px" >DESCRIZIONE</th>
                <th scope="col" style="width: 200px" >QUANTITA'</th>
                <th scope="col" style="width: 200px" >DATA</th>
              </tr>
            </thead>

            {{-- ciclo i dati della tabella storico per averne in output l'elenco --}}
            @foreach ($query as $q)
            <tr>
                <td>{{$q->ean}}</td>
                <td>{{$q->sku}}</td>
                <td>{{$q->descrizione}}</td>
                <td>{{$q->quantita}}</td>
                <td>{{$q->data}}</td>
            </tr>
        @endforeach

        </table>
    @else
    <div style="text-align: center">
        <h1>PRIMA DEVI FARE IL LOGIN</h1>
        <a href="/" class="text-sm text-gray-700 underline">Log in</a>
    </div>
    @endauth
@endsection
