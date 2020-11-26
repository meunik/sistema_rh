<form id="filtro" class="m-b-15">
    <div class="form-body">
        <h3 class="box-title">Filtro</h3>
        <hr>
        {{-- <div class="row m-l-15 m-b-15">
            <p>Clínicas</p>
            @foreach($clinicas as $clinica)
                <div class="col-12 col-md-2">
                    <div class="checkbox checkbox-primary">
                        <input id="clinica{{$clinica->id}}" type="checkbox" value="{{$clinica->id}}" kl_vkbd_parsed="true">
                        <label for="clinica{{$clinica->id}}">{{$clinica->nome}}</label>
                    </div>
                </div>
            @endforeach
        </div> --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Tipo</label>
                    <div class="radio-list">
                        <label class="radio-inline p-0">
                            <div class="radio radio-info">
                                <input type="radio" name="tipo" id="diario" value="diario" kl_vkbd_parsed="true">
                                <label for="diario">Diário</label>
                            </div>
                        </label>
                        <label class="radio-inline">
                            <div class="radio radio-info">
                                <input type="radio" name="tipo" id="mensal" value="mensal" kl_vkbd_parsed="true">
                                <label for="mensal">Mensal</label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div style="display: none;" id="tipo_diario">
                <div class="col-12 col-md-1" style="min-width: 180px">
                    <div class="form-group">
                        <label class="control-label">Data Inicial</label>
                        <input type="date" id="diario_inicial" class="form-control" style="min-width: 170px" placeholder="dia/mês/ano" kl_vkbd_parsed="true">
                    </div>
                </div>
                <div class="col-12 col-md-1" style="min-width: 180px">
                    <div class="form-group">
                        <label class="control-label">Data Final</label>
                        <input type="date" id="diario_final" class="form-control" style="min-width: 170px" placeholder="dia/mês/ano" kl_vkbd_parsed="true">
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tipo_mensal">
                <div class="col-12 col-md-1" style="min-width: 180px">
                    <div class="form-group">
                        <label class="control-label">Mês Inicial</label>
                        <input type="month" id="mensal_inicial" class="form-control" style="min-width: 170px" kl_vkbd_parsed="true">
                    </div>
                </div>
                <div class="col-12 col-md-1" style="min-width: 180px">
                    <div class="form-group">
                        <label class="control-label">Mês Final</label>
                        <input type="month" id="mensal_final" class="form-control" style="min-width: 170px" kl_vkbd_parsed="true">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button id="filtrar" type="button" class="btn btn-info">Filtrar</button>
    </div>
</form>