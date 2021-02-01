@if ($datas != '[]')
    @foreach($datas as $data)
        <tr id="datalist{{$data->id}}">
            <td class="text-center">{{$data->cod}}</td>
            <td class="text-center">{{$data->data_inicial}}</td>
            <td class="text-center">{{$data->data_final}}</td>
            <td class="text-center">{{$data->covid}}</td>
            <td class="text-center">{{$data->cids_id}}</td>
            <td class="text-center">{{$data->motivo}}</td>
            <td class="text-center">
                @if($data->data_inicial && ($data->cod == 'AT' || $data->cod == 'CO' || $data->cod == 'FE'|| $data->cod == 'GR'|| $data->cod == 'INSS'))
                    <div class="text-left form-group row m-0">
                        <div id="retornou{{$data->id}}">
                            <input type="checkbox" {{$data->retornou ? "checked" : ""}} class="js-switch" data-color="#ffca4a" onchange="handleUpdate({{$data->id}},this.checked)">
                        </div>
                    </div>
                @endif
            </td>
            @if(Auth::user()->is_admin != null)
            <td>
                <button class="btn btn-sm btn-danger btn-outline font-16" type="button" onclick="handleDelete({{$data->id}})"><i class="fa fa-trash"></i></button>
            </td>
            @endif
        </tr>
    @endforeach
@endif
