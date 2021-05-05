Cerca articoli

<form action="{{ route('articoli.risultati') }}" method="post">
@csrf
<input type="text" name="keyword" value="" />
<input type="text" name="marchio" value="" />
<input type="submit" value=" Cerca " />

</form>
