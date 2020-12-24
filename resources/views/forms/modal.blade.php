<div class="modal fade" id="dataList" tabindex="-1" role="dialog" aria-labelledby="dataList" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="dataList_label"></h4> 
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Cod</th>
                                <th class="text-center">Data Inicial</th>
                                <th class="text-center">Data Final</th>
                                <th class="text-center">Covid</th>
                                <th class="text-center">Cid</th>
                                <th class="text-center">Motivo</th>
                                <th class="text-center">Retornou</th>
                                @if(Auth::user()->is_admin != null)
                                    <th class="text-center">Ações</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="dataList_body"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>

<!-- Editar Telefone -->
<div class="modal fade" id="editTell" tabindex="-1" role="dialog" aria-labelledby="editTell" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editTellForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="editTell_label"></h4> 
                </div>
                <div class="modal-body">
                    <div class="text-left form-group row m-0">
                        <label for="editTell_input" class="control-label p-0">Telefone:</label>
                        <div class="">
                            <input type="text" class="form-control" autocomplete="off" name="editTell_input" id="editTell_input" placeholder="Telefone">
                            <input type="text" class="d-none" autocomplete="off" name="editTell_id" id="editTell_id" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="editTellSubmit" onclick="editTell()">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Editar Telefone -->

<!-- Editar Arquivo Atestado -->
<div class="modal fade" id="atestadoFIle" tabindex="-1" role="dialog" aria-labelledby="atestadoFIle" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="atestadoFIleForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="atestadoFIle_label">
                        <span class="text-info font-16 m-b-5">
                            <i class="fa fa-plus"></i> Arquivo <i class="fa fa-file"></i>
                        </span>
                    </h4> 
                </div>
                <div class="modal-body row">
                    <div class="col-sm-6 text-left form-group">
                        <label for="atestadoNomeFIle_input" class="control-label">Nome do arquivo:</label>
                        <div class="">
                            <input type="text" class="form-control" autocomplete="off" name="atestadoNomeFIle_input" id="atestadoNomeFIle_input" placeholder="Nome do arquivo">
                            <input type="text" class="d-none" autocomplete="off" name="atestadoFIle_id" id="atestadoFIle_id" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 text-left form-group">
                        <label for="atestadoFIle_input" class="control-label">Adicionar arquivo:</label>
                        <div class="">
                            <input type="file" class="form-control" autocomplete="off" name="atestadoFIle_input" id="atestadoFIle_input" placeholder="Adicionar arquivo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="atestadoFIleSubmit" onclick="atestadoFileSubmit()">Salvar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Editar Arquivo Atestado -->