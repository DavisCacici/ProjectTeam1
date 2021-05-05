@foreach($articles as $article)

{{ $article->descrizione}}<br />
{{ $article->brand->brand}}<br />
{{ $article->type->type}}

@endforeach
