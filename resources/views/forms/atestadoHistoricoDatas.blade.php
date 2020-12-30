@if ($datas != '[]')
    @foreach($datas as $data)
        <tr id="datalist{{$data->id}}">
            <td class="text-center">{{$data->id}}</td>
            <td class="text-center">{{$data->nome}}</td>
            <td class="text-center">{{$data->data_inicial}}</td>
            <td class="text-center">{{$data->dias_atestado}}</td>
            <td class="text-center">{{$data->cid_categoria}}</td>
        </tr>
    @endforeach
@endif
