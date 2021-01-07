
<!-- Atestado -->
<div class="modal fade" id="atestado" tabindex="-1" role="dialog" aria-labelledby="atestado" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="atestadoFIleForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="atestadoFIle_label">
                        <span class="text-info font-16 m-b-5">
                            <i class="fa fa-plus"></i> Atestado
                        </span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row p-b-10">
                        <div class="col-sm-2 row m-0 text-left">
                            <b class="col-12 m-0">#</b>
                            <p id="atestadoId" class="col-12 b-b-1">0321</p>

                            <input type="text" class="d-none" autocomplete="off" name="atestado_id" id="atestado_id" readonly>
                        </div>
                        <div class="col-sm-7 row m-0 text-left">
                            <b class="col-12 m-0">Nome:</b>
                            <p id="atestadoNome" class="col-12 b-b-1"></p>
                        </div>
                        <div class="col-sm-3 row m-0 text-left">
                            <b class="col-12 m-0">Telefone:</b>
                            <p id="atestadoTelefone" class="col-12 b-b-1"></p>
                        </div>
                    </div>
                    <div class="row p-b-10">
                        <div class="col-sm-3 row m-0 text-left">
                            <b class="col-12 m-0">Data Início Afastamento:</b>
                            <p id="atestadoData_inicio_afastamento" class="col-12 b-b-1"></p>
                        </div>
                        <div class="col-sm-4 row m-0 text-left">
                            <b class="col-12 m-0">Dias de Atestado:</b>
                            <p id="atestadoDias_atestado" class="col-12 b-b-1"></p>
                        </div>
                        <div class="col-sm-5 row m-0 text-left">
                            <b class="col-12 m-0">Data Final Atestado:</b>
                            <p id="atestadoData_final_atestado" class="col-12 b-b-1"></p>
                        </div>
                    </div>
                    <div class="row p-b-10">
                        <div class="col-sm-3 row m-0 text-left">
                            <b class="col-12 m-0">Motivo:</b>
                            <p id="atestadoMotivo" class="col-12 b-b-1"></p>
                        </div>
                        <div class="col-sm-4 row m-0 text-left">
                            <b class="col-12 m-0">CID Categoria:</b>
                            <p id="atestadoCid_categoria_id" class="col-12 b-b-1" data-toggle="tooltip" data-placement="bottom"></p>
                        </div>
                        <div class="col-sm-5 row m-0 text-left">
                            <b class="col-12 m-0">CID Subcategoria:</b>
                            <p id="atestadoCid_sub_categoria_id" class="col-12 b-b-1" data-toggle="tooltip" data-placement="bottom"></p>
                        </div>
                    </div>
                    <div class="row p-t-10">
                        <div class="col-sm-3">
                            <label for="encaminhado_inss">Encaminhado INSS:</label>
                            <input id="encaminhado_inss" type="checkbox" name="encaminhado_inss" autocomplete="off">
                        </div>
                        <div class="col-sm-4 text-left form-group">
                            <label for="data_proximo_contato" class="control-label p-0">Data Proximo Contato:</label>
                            <input type="date" class="form-control" autocomplete="off" name="data_proximo_contato" id="data_proximo_contato">
                        </div>
                        <div class="col-sm-5 text-left form-group">
                            <label for="data_encerramento_acompanhamento" class="control-label p-0">Data Encerramento Acompanhamento:</label>
                            <input type="date" class="form-control" autocomplete="off" name="data_encerramento_acompanhamento" id="data_encerramento_acompanhamento">
                        </div>
                        <div class="row">
                            <div class="col-sm-3 text-left form-group">
                                <label for="data_de_contato" class="control-label p-0">Data de Contato:</label>
                                <input type="date" class="form-control" autocomplete="off" name="data_de_contato" id="data_de_contato">
                            </div>
                            <div class="col-sm-9 text-left form-group">
                                <label for="observacao_inss" class="control-label p-0">Observação:</label>
                                <textarea class="form-control" autocomplete="off" name="observacao_inss" id="observacao_inss" placeholder="Observação..." maxlength="500"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row text-right p-b-10">
                        <button type="button" class="btn btn-info" id="atestadoSubmit" onclick="atestadoSubmite()">Salvar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row text-left p-b-10">

                        <h4 class="modal-title" id="atestadoFIle_label">
                            <span class="text-info font-16 m-b-5">
                                <i class="fa fa-history"></i> Histórico últimos 120 dias
                            </span>
                        </h4>
                        <table class="table table-bordered table-condensed b-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Data Inicial</th>
                                    <th class="text-center">Dias de atestado</th>
                                    <th class="text-center">CID</th>
                                </tr>
                            </thead>
                            <tbody id="dataList_body"></tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Atestado -->
