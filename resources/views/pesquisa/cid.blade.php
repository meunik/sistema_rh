@if ($nomes != '[]')
    @foreach($nomes as $nome)
        <a href='#' onclick="setHCid('{{$nome}}','{{$colegas_id}}');">{{ $nome->nome }}</a><br/>
    @endforeach
@endif