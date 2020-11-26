
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
$(document).ready( function () {
    
    $("#tipo_diario").show();
    
    var inicial = getUrlParameter('inicial');
    var final = getUrlParameter('final');

    if(inicial != undefined && final != undefined) {
        $('#diario_inicial').val(inicial);
        $('#diario_final').val(final);
    } else {
        var now = new Date();
        var nowInicial = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        nowInicial.setDate(now.getDate() - 10);
        var dayInicial = ("0" + nowInicial.getDate()).slice(-2);
        var monthInical = ("0" + (nowInicial.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day);
        var dayInicial = nowInicial.getFullYear()+"-"+(monthInical)+"-"+(dayInicial);
        $("#diario_inicial").val(dayInicial);
        $("#diario_final").val(today);
        // newUrl(dayInicial,today);
    }
});

$("#filtrar").click(function(event) {
    event.preventDefault();
    var inicial = "";
    var final = "";
    inicial = $("#diario_inicial").val();
    final = $("#diario_final").val();
    newUrl(inicial,final);
});