/**
 *  Document   : table_data.js
 *  Author     : redstar
 *  Description: advance table page script
 *
 *  Adaptação: Julio Vitorino
 *  Data: 26/07/2018
 **/

// Objeto JSON que será carregado na tabela 
var objeto;

$(document).ready(function() {
	'use strict';
/*	
    $('#example1').DataTable( {
        "scrollX": true
    } );
    
    var table = $('#example2').DataTable( {
        "scrollY": "200px",
        "paging": false
    } );
 
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );

    $('#example4').DataTable( {
        "scrollX": true
    } );
    
    $('#saveStage').DataTable( {
    	 "scrollX": true,
        stateSave: true
    } );
    */
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
    var target = url.searchParams.get("target");
	var isload = url.searchParams.get("lt");
	objeto = url.searchParams.get("o");

	if (isload === "true"){
		carregarTabelas();	
	}

} );

/* Carregar as Datatables */
function carregarTabelas() {

    // Chama a factory do facebook
    var request = $.ajax({
                url: '../php/classes/gateway/loadtableController.php',
                success: carregarTabelasCallback
    });
}


// Carrega dados na tabela
var carregarTabelasCallback = function(retorno, status){

	// Executa uma função de controlador
	if (objeto === "projetos"){
		carregarTabelaProjetos(retorno);
	}
}



// Carrega dados na tabela
function carregarTabelaProjetos(retorno){

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_projetos;


	var t = $('#dintable').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {

    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<a href="edit_projeto.html?p='+pid+' " class="btn btn-primary btn-xs">' +
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
			}
			var statushtml = '<span class="label label-sm '+ label +'"> '+span+' </span>';


			// Adiciona projeto na tabela
			t.row.add( [
		            lst[i].projeto,
		            lst[i].palavra_chave_exata,
		            lst[i].nicho,
		            statushtml,
		            acoes
		        ] ).draw( false );
		}

	}


}
