@extends('layouts.navbar')
@section('title', 'HomePage')
@section('content')
        <main>
            <!-- in questa sezione passando l'id e la quantità dalla riga della tabella magazzino si possono inserire
                la quantità di un certo prodotto (che abbiamo richiamato con l'ID) che si vuole eliminare e passare questo dato al controller (LogisticsController) -->
                <div class="container">
                    <h3>Questo manovra sposterà la quantità da lei indicata al negozio</h3>
                    <form method="POST" action="/sposta/{{$id}}/{{$quantita}}">
                        @csrf
                        <p>Quantità disponibile {{$quantita}}</p>
                        <input type="text" name="numero"/>
                        <button type="submit" class="btn btn-primary">Sposta</button>
                    </form>
                </div>
        </main>
@endsection
