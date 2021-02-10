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

<!-- Vacina -->
<div class="modal fade" id="vacinaModal" tabindex="-1" role="dialog" aria-labelledby="vacinaModal" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="vacinaModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="vacinaModal_label">
                        <span class="text-info font-16 m-b-5">
                            <img src="plugins/images/injection.png" alt="" class="" style="width: 20px;">
                            Vacina
                        </span>
                    </h4>
                </div>
                <div class="modal-body row">
                    <h4 class="modal-title text-center font-semibold font-16 m-b-5" id="vacinaModal_label2">
                        Controle de Vacinação dos Profissionais de Saúde
                    </h4>
                    <br>

                    <div class="row p-b-10" id="vacinaModa_body"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Vacina -->
