<a href='#' onclick="setNome('Não Cadastrado');" class="text-danger font-bold font-18 m-b-20 m-t-20 b-b-1">Cadastrar Colega</a><br/>
@if ($nomes != '[]')
    @foreach($nomes as $nome)
        <a href='#' onclick="setNome('{{ $nome }}');">{{ $nome->nome }} - {{ $nome->hospital->filial }}</a><br/>
    @endforeach
@endif