/**
 *  Document   : table_data.js
 *  Author     : redstar
 *  Description: advance table page script
 *
 *  Adaptação..: Julio Vitorino
 *  Data.......: 28/05/2019
 *  Atualização: 08/06/2019
 **/

// Objeto JSON que será carregado na tabela 
var objeto;
var modo;

//////////////////////////////////////////////////////////////////
// DOM montado

// prepara carga da tabela
$(document).ready(function() {
	'use strict';
    var table = $('#tableGroup').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "scrollX": true,
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#tableGroup tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
    
	// Obter os parametros enviados da página index.html na StringQuery
	var url = new URL(window.location.href);
    //var target = url.searchParams.get("target");
	//var isload = url.searchParams.get("lt");
	//objeto = url.searchParams.get("o");
	//modo = url.searchParams.get("mode");

	//if (target === "all_campanha"){
		carregarTabelas();	
	//}

} );

/* Carregar as Datatables */
function carregarTabelas() {
//alert('vou chamar o backend');
    // Chama a factory 
    var request = $.ajax({
                url: '../php/classes/gateway/campanhaLoadTableController.php',
                success: carregarTabelasCallback
    });
}


// Carrega dados na tabela
var carregarTabelasCallback = function(retorno, status){
//alert('retornei do backend');
//alert(retorno);
	carregarTabelaView(retorno);
}

function ativarCampanha(idcampanha){
    var request = $.ajax({
		url: '../php/classes/gateway/ativarCampanhaController.php',
		method: "POST",
		data: {
			idcampanha: idcampanha
		},
		success: ativarCampanhaCallback
	});
}

var ativarCampanhaCallback = function(retorno, status){
	var dto = JSON.parse(retorno);
	showWithCustomIconMessageOk("Campanha", dto.msgcodeString);
}

// Carrega dados na tabela Projeto
function carregarTabelaView(retorno){

    //alert(retorno);

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    //var lst = dto.lst_projetos;
    var lst = dto;


	var t = $('#dintable').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {

    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<button onclick=ativarCampanha('+pid+') "  class="btn btn-info btn-xs">' +
						'		<i class="fa fa-check-square-o"></i>'+
						'	</button>'+
						'	<a href="profile_projeto.html?p='+pid+' "  class="btn btn-info btn-xs">' +
						'		<i class="fa fa-eye "></i>'+
						'	</a>'+
						'	<a href="index.php?target=edit_projeto&lt=true&o=projetos&mode=edit&pid='+pid+' " class="btn btn-primary btn-xs">' +
						'		<i class="fa fa-pencil"></i>' +
						'	</a>' +
						'	<a href="del_projeto.html?p='+pid+' "  class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</a>'+
						'</td>';

			// string html do status
			var status = lst[i].status;
			var label = "label-info";
			var span = "Informação";
			if (status === "A") {
				label = "label-success";
				span = "Ativo";
			} else if (status === "I"){
				label = "label-danger";
				span = "Inativo";
			} else if (status === "B"){
				label = "label-danger";
				span = "Bloqueado";
			} else if (status === "P"){
				label = "label-warning";
				span = "Pendente";
			} else if (status === "E"){
				label = "label-danger";
				span = "Encerrado";
			} else if (status === "W") {
				label = "label-warning";
				span = "Em Processamento";
			} else if (status === "F"){
				label = "label-success";
				span = "Em Fila";
			}else {
				label = "label-warning";
				span = "Status=" + status;

			}
			var statushtml = '<span class="label label-sm '+ label +'"> '+span+' </span>';


			// Adiciona projeto na tabela
			t.row.add( [
		            lst[i].nome,
		            lst[i].dataInicio,
		            lst[i].dataTermino,
		            lst[i].maximoCartoes,
		            statushtml,
		            lst[i].dataCadastro,
		            acoes
		        ] ).draw( false );
		}

	}


} // fim function carregarTabelaProjetos

