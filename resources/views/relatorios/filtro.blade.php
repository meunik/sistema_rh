<form id="filtro" class="m-b-15">
    <div class="form-body">
        <h3 class="box-title">Filtro</h3>
        <hr>
        <div class="panel panel-default block2">
            <div class="panel-heading">
                Hospitais <span>[Todos <input id="hospitais_todos" type="checkbox" kl_vkbd_parsed="true">]</span>
                <div class="panel-action">
                    <a href="#" data-perform="panel-collapse"><span>Exibir</span></a>
                </div>
            </div>
            <div id="hospitais"class="panel-wrapper collapse" aria-expanded="true">
                <div class="panel-body">
                    @foreach($hospitais as $hospital)
                        <div class="col-12 col-md-3">
                            <div class="checkbox checkbox-primary">
                                <input id="hospitais{{$hospital->id}}" type="checkbox" value="{{$hospital->id}}" kl_vkbd_parsed="true">
                                <label for="hospitais{{$hospital->id}}">{{$hospital->nome}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
        <div class="row">
            <div id="tipo_filtro" class="col-12 col-md-1" style="min-width: 220px">
                <div class="form-group">
                    <label class="control-label">Tipo</label>
                    <select id="tipo" name="tipo" class="form-control" style="min-width: 200px" autocomplete="off">
                        <option value="TD">Todos</option>
                        <option value="ES">Trabalho no Escritório</option>
                        <option value="CL">Clínica</option>
                        <option value="SH">Serviços Hospitalares</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-1" style="min-width: 180px">
                <div class="form-group">
                    <label class="control-label">Data Inicial</label>
                    <input type="date" id="data_inicial" class="form-control" style="min-width: 170px" placeholder="dia/mês/ano" kl_vkbd_parsed="true">
                </div>
            </div>
            <div class="col-12 col-md-1" style="min-width: 180px">
                <div class="form-group">
                    <label class="control-label">Data Final</label>
                    <input type="date" id="data_final" class="form-control" style="min-width: 170px" placeholder="dia/mês/ano" kl_vkbd_parsed="true">
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button id="filtrar" type="button" class="btn btn-info">Filtrar</button>
    </div>
</form>