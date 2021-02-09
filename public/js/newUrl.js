/**
 * Coloca parametros na URL
 * @param {
 *  var params = {
 *          'exemplo1': exemplo1,
 *          'exemp2': exemp2,
 *      };
 *  } params
 */
var newUrl = function newUrl(params) {
    var url = window.location.pathname+'?' + jQuery.param(params);
    window.location.href = url;
};
