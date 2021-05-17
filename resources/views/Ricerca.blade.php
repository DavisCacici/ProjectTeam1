@extends('layouts.navbar')
@section('title', 'HomePage')
@section('content')
        <div class="container" >
            <br>

            <h1>{{$location}}</h1>

            <br>

            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" style="width: 200px" >EAN</th>
                    <th scope="col" style="width: 200px">SKU</th>
                    <th scope="col" style="width: 300px">DESCRIZIONE</th>
                    <th scope="col" style="width: 200x">QUANTITA</th>
                    <th scope="col" style="width: 200x">&nbsp</th>
                </tr>
                </thead>

                @foreach ($query as $q)
                    <tr>
                        <td>{{$q->ean}}</td>
                        <td>{{$q->sku}}</td>
                        <td>{{$q->descrizione}}</td>
                        <td>{{$q->quantita}}</td>
                        <td class="botton td">
                            <form method="GET" action="/elimina/{{$q->id}}/{{$q->quantita}}">
                                @csrf
                                <button type="submit" class="btn btn-danger">elimina</button>
                            </form>
                            @if($location == 'magazzino')
                                <form method="GET" action="/sposta/{{$q->id}}/{{$q->quantita}}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">sposta&nbsp</button>
                                </form>
                            @endif
                            @if($location == 'negozio')
                                <form method="GET" action="/vendi/{{$q->id}}/{{$q->quantita}}">
                                    @csrf
                                    <button type="submit"  class="btn btn-primary">venduto</button>
                                </form>
                            @endif
                        </td>
                    </tr>

                @endforeach
            </table>
        </div>

@endsection
