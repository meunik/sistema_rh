function cidCategoria(row) {
    var cid = (row.cid) ? row.cid : "";
    var cids_id = (row.cids_id) ? row.cids_id : "";
    var cid_cat = (row.cid_categoria_id) ? row.cid_categoria_id : "0";
    var selected = {cid_cat: null};
    selected[`${cid_cat}`] = "selected";
    var id = row.id;
    var html1 = `<div class="text-left form-group row m-0">
                    <label for="cidCategoria${id}" class="control-label p-0">CID Categoria:</label>
                    <div class="">
                        <select id="cidCategoria${id}" name="cidCategoria" class="form-control w-130" autocomplete="off" style="width: 250px;" onchange="cidSubCategoria(this.value, ${id}, null)">
                            <option selected disabled>Selecione</option>
                            <option value="1" ${selected[1]}>(A00 - B99) Algumas doenças infecciosas e parasitárias</option>
                            <option value="2" ${selected[2]}>(C00 - D48) Neoplasias [tumores]</option>
                            <option value="3" ${selected[3]}>(D50 - D89) Doenças do sangue e dos órgãos hematopoéticos e alguns transtornos imunitários</option>
                            <option value="4" ${selected[4]}>(E00 - E90) Doenças endócrinas, nutricionais e metabólicas</option>
                            <option value="5" ${selected[5]}>(F00 - F99) Transtornos mentais e comportamentais</option>
                            <option value="6" ${selected[6]}>(G00 - G99) Doenças do sistema nervoso</option>
                            <option value="7" ${selected[7]}>(H00 - H59) Doenças do olho e anexos</option>
                            <option value="8" ${selected[8]}>(H60 - H95) Doenças do ouvido e da apófise mastóide</option>
                            <option value="9" ${selected[9]}>(I00 - I99) Doenças do aparelho circulatório</option>
                            <option value="10" ${selected[10]}>(J00 - J99) Doenças do aparelho respiratório</option>
                            <option value="11" ${selected[11]}>(K00 - K93) Doenças do aparelho digestivo</option>
                            <option value="12" ${selected[12]}>(L00 - L99) Doenças da pele e do tecido subcutâneo</option>
                            <option value="13" ${selected[13]}>(M00 - M99) Doenças do sistema osteomuscular e do tecido conjuntivo</option>
                            <option value="14" ${selected[14]}>(N00 - N99) Doenças do aparelho geniturinário</option>
                            <option value="15" ${selected[15]}>(O00 - O99) Gravidez, parto e puerpério</option>
                            <option value="16" ${selected[16]}>(P00 - P96) Algumas afecções originadas no período perinatal</option>
                            <option value="17" ${selected[17]}>(Q00 - Q99) Malformações congênitas, deformidades e anomalias cromossômicas</option>
                            <option value="18" ${selected[18]}>(R00 - R99) Sintomas, sinais e achados anormais de exames clín… de laboratório, não classificados em outra parte</option>
                            <option value="19" ${selected[19]}>(S00 - T98) Lesões, envenenamento e algumas outras consequências de causas externas</option>
                            <option value="20" ${selected[20]}>(V01 - Y98) Causas externas de morbidade e de mortalidade</option>
                            <option value="21" ${selected[21]}>(Z00 - Z99) Fatores que influenciam o estado de saúde e o contato com os serviços de saúde</option>
                            <option value="22" ${selected[22]}>(U04 - U99) Códigos para propósitos especiais</option>
                            <option value="23" ${selected[23]}>(A00 - B99) Algumas doenças infecciosas e parasitárias</option>
                            <option value="24" ${selected[24]}>(C00 - D48) Neoplasias [tumores]</option>
                            <option value="25" ${selected[25]}>(D50 - D89) Doenças do sangue e dos órgãos hematopoéticos e alguns transtornos imunitários</option>
                            <option value="26" ${selected[26]}>(E00 - E90) Doenças endócrinas, nutricionais e metabólicas</option>
                            <option value="27" ${selected[27]}>(F00 - F99) Transtornos mentais e comportamentais</option>
                            <option value="28" ${selected[28]}>(G00 - G99) Doenças do sistema nervoso</option>
                            <option value="29" ${selected[29]}>(H00 - H59) Doenças do olho e anexos</option>
                            <option value="30" ${selected[30]}>(H60 - H95) Doenças do ouvido e da apófise mastóide</option>
                            <option value="31" ${selected[31]}>(I00 - I99) Doenças do aparelho circulatório</option>
                            <option value="32" ${selected[32]}>(J00 - J99) Doenças do aparelho respiratório</option>
                            <option value="33" ${selected[33]}>(K00 - K93) Doenças do aparelho digestivo</option>
                            <option value="34" ${selected[34]}>(L00 - L99) Doenças da pele e do tecido subcutâneo</option>
                            <option value="35" ${selected[35]}>(M00 - M99) Doenças do sistema osteomuscular e do tecido conjuntivo</option>
                            <option value="36" ${selected[36]}>(N00 - N99) Doenças do aparelho geniturinário</option>
                            <option value="37" ${selected[37]}>(O00 - O99) Gravidez, parto e puerpério</option>
                            <option value="38" ${selected[38]}>(P00 - P96) Algumas afecções originadas no período perinatal</option>
                            <option value="39" ${selected[39]}>(Q00 - Q99) Malformações congênitas, deformidades e anomalias cromossômicas</option>
                            <option value="40" ${selected[40]}>(R00 - R99) Sintomas, sinais e achados anormais de exames clín… de laboratório, não classificados em outra parte</option>
                            <option value="41" ${selected[41]}>(S00 - T98) Lesões, envenenamento e algumas outras consequências de causas externas</option>
                            <option value="42" ${selected[42]}>(V01 - Y98) Causas externas de morbidade e de mortalidade</option>
                            <option value="43" ${selected[43]}>(Z00 - Z99) Fatores que influenciam o estado de saúde e o contato com os serviços de saúde</option>
                            <option value="44" ${selected[44]}>(U04 - U99) Códigos para propósitos especiais</option>
                        </select>
                    </div>
                </div>`;

    var html2 = `<div class="text-left form-group row m-0 ">
                    <label for="cid${id}" class="control-label p-0">CID:</label>
                    <div class="">
                        <input type="text" class="form-control" autocomplete="off" name="cids_nome" value="${cid}" id="cids_nome${id}" placeholder="Cid" onKeyUp="getCid(this.value, ${id})" style="width: 150px;">
                        <div id="listaCid${id}"></div>
                        <input type="text" class="input-invisivel" autocomplete="off" name="cids_id" value="${cids_id}" id="cids_id${id}">
                    </div>
                </div>`;

    if (row.cids_id != null) {
        return html2;
    } else {
        return html1;
    }
}

function cidSubCategoria(row) {
    var id = row.id;
    if (row.cod === 'AT') var options = optionsSubCategoria(row.cid_categoria_id, row.id, row.cid_sub_categoria_id);
    
    var html = `<div class="text-left form-group row m-0">
                    <label for="cidSubCategoria${id}" class="control-label p-0">CID Subcategoria:</label>
                    <div class="">
                        <select id="cidSubCategoriaSelect${id}" name="cidSubCategoria" class="form-control w-130" autocomplete="off" style="width: 250px;">
                            <option selected disabled>Selecione</option>`+options+
                        `</select>
                    </div>
                </div>`;
    return html;
}