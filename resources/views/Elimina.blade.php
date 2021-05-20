@extends('layouts.navbar')
@section('title', 'Elimina')
@section('content')
        <main>
            <!-- in questa sezione passando l'id e la quantità dalla riga della tabella magazzino si possono inserire
                la quantità di un certo prodotto (che abbiamo richiamato con l'ID) che si vuole eliminare e passare questo dato al controller (LogisticsController) -->

        <div class="container2">
            <h3>Questa manovra eliminera la quantità da lei indicata</h3>
            <form method="POST" action="/elimina/{{$id}}/{{$quantita}}">
                @csrf
                @method('DELETE')
                <p>Quantità disponibile {{$quantita}}</p>
                <input type="text" name="numero"/>
                <button type="submit" class="btn btn-danger">elimina</button>
            </form>
        </div>

        </main>
@endsection
