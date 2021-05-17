@extends('layouts.navbar')
@section('title', 'HomePage')
@section('content')
        <div class="row">
            <div class="col">
                <label class="label"><h1>Prodotti venduti </h1></label>
            </div>
            <div class="col cerca">
                <form method="GET" action="/ricerca/{{$storico}}">
                    <input type="text" name="ricerca" style="height: 35px">
                    <button type="submit" class="btn btn-success" style="height: 35px">cerca</button>
                </form>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                {{-- <th scope="col" style="width: 80px">ID</th> --}}
                <th scope="col" style="width: 200px" >EAN</th>
                <th scope="col" style="width: 200px" >SKU</th>
                <th scope="col" style="width: 300px" >DESCRIZIONE</th>
                <th scope="col" style="width: 200px" >QUANTITA'</th>
                <th scope="col" class="td">&nbsp</th>
              </tr>
            </thead>

            {{-- ciclo i dati della tabella storico per averne in output l'elenco --}}
            @foreach ($query as $q)
            <tr>
                {{-- <td>{{$q->id}}</td> --}}
                <td>{{$q->ean}}</td>
                <td>{{$q->sku}}</td>
                <td>{{$q->descrizione}}</td>
                <td>{{$q->quantita}}</td>
            </tr>
        @endforeach

        </table>
@endsection
