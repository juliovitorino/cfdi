/**
 *  Documento   : gcjcv_projeto_list.js
 *  Autor       : Julio Vitorino
 *  Descrição   : carregar um objeto select dinamicamente
 *
 *  Adaptação: 
 *  Data: 26/07/2018
 **/

// Objeto JSON que será carregado na tabela 
var objeto;

$(document).ready(function() {
	// Obter os parametros enviados da página index.html na StringQuery
	var url = new URL(window.location.href);
    var target = url.searchParams.get("target");
	var isload = url.searchParams.get("lt");
	objeto = url.searchParams.get("o");

	if (isload === "true"){
		carregarList();	
	}

} );

/* Carregar as Datatables */
function carregarList() {

    // Chama a factory do facebook
    var request = $.ajax({
                url: '../php/classes/gateway/loadlistController.php',
                success: carregarListCallback
    });
}


// Carrega dados na tabela
var carregarListCallback = function(retorno, status){

	// Executa uma função de controlador
	if (objeto === "projetos"){
		carregarListProjetos(retorno);
	}
}


// Carrega dados na tabela
function carregarListProjetos(retorno){

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_projetos

    $.each(dto.lst_projetos, function (i, item) {
    	var objprojeto = item;

	    $('#id-lst-projetos').append($('<option>', { 
	        value: objprojeto.id,
	        text : objprojeto.projeto 
	    }));
	});

}
