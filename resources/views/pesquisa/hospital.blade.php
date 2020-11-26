@if ($hospitais != '[]')
    @foreach($hospitais as $hospital)
        <a href='#' onclick="setHospital('{{ $hospital }}');">{{ $hospital->nome }} - {{ $hospital->local }}</a><br/>
    @endforeach
@endif