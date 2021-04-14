/**
 *  Document   : table_data.js
 *  Author     : redstar
 *  Description: advance table page script
 *
 *  Adaptação..: Julio Vitorino
 *  Data.......: 26/07/2018
 *  Atualização: 10/08/2018
 **/

// Objeto JSON que será carregado na tabela 
var objeto;
var modo;

// Obtem os dados do formulario en envia ao backend
var enviarProjetoCRUDClick = function () {
   	var url = new URL(window.location.href);
	var pid = url.searchParams.get("pid");
	var projeto = $('#projeto').val();
	var email_contato = $('#email_contato').val();
	var palavra_chave_exata = $('#palavra_chave_exata').val();
	var url_minisite = $('#url_minisite').val();
	var headline = $('#headline').val();
	var nicho = $('#nicho').val();
	var plataforma = $('#plataforma').val();
	var nome_produto = $('#nome_produto').val();
	var desc_produto = $('#desc_produto').val();
	var tipo_produto = $('#tipo_produto').val();
	var preco_produto = $('#preco_produto').val();
	var hotlink_pv = $('#hotlink_pv').val();
	var hotlink_chkout = $('#hotlink_chkout').val();
	var autoridade = $('#autoridade').val();
	var breve_desc_autoridade = $('#breve_desc_autoridade').val();

    var request = $.ajax({
                url: '../php/classes/gateway/projetoCRUDController.php',
				method: "POST",
				data: {	projeto: projeto,
						email_contato: email_contato,
						palavra_chave_exata: palavra_chave_exata,
						headline: headline,
						nicho: nicho,
						plataforma: plataforma,
						nome_produto: nome_produto,
						desc_produto: desc_produto,
						tipo_produto: tipo_produto,
						preco_produto: preco_produto,
						hotlink_pv: hotlink_pv,
						hotlink_chkout: hotlink_chkout,
						autoridade: autoridade,
						breve_desc_autoridade: breve_desc_autoridade,
						url_minisite: url_minisite,
						modo: modo,
						pid: pid
					},
                success: enviarProjetoCRUDCallback
    });


}

var enviarProjetoCRUDCallback = function (retorno, status) {
    var dto = JSON.parse(retorno);
    showWithCustomIconMessageOk("Projeto", dto.msgcodeString);
}

var carregarProjetoCallback = function (retorno, status) {
    var dto = JSON.parse(retorno);
    
    $("#projeto").val(dto.projeto);
    $("#email_contato").val(dto.email_contato);
    $("#palavra_chave_exata").val(dto.palavra_chave_exata);
    $("#headline").val(dto.headline);
    $("#nome_produto").val(dto.nome_produto);
    $("#desc_produto").val(dto.desc_produto);
    $("#url_minisite").val(dto.url_minisite);
    $("#tipo_produto").val(dto.tipo_produto);
    $("#preco_produto").val(dto.preco_produto);
    $("#hotlink_pv").val(dto.hotlink_pv);
    $("#hotlink_chkout").val(dto.hotlink_chkout);
    $("#autoridade").val(dto.autoridade);
    $("#breve_desc_autoridade").val(dto.breve_desc_autoridade);
    $("#nicho").val(dto.nicho);
    $("#plataforma").val(dto.plataforma);
	$('.tag-projetoid').text(dto.id);

}


//////////////////////////////////////////////////////////////////
// DOM montado

//Prepara botão novo para ativar form de adicionar novo
$(document).ready(function() {
    $('#addNovo').click(function () {
        var target = $('#addNovo').attr('data-target');
        window.location.href=target;
    })

    $('#addNovoItem').click(function () {
    	$('#tabela-item').hide();
	    $('#form-produto-item').show();
    })

    $('#addNovoDor').click(function () {
    	$('#tabela-dor').hide();
	    $('#form-produto-dor').show();
    })

    $('#addNovoBonus').click(function () {
    	$('#tabela-bonus').hide();
	    $('#form-produto-bonus').show();
    })

    $('#addNovoBeneficios').click(function () {
    	$('#tabela-beneficios').hide();
	    $('#form-produto-beneficios').show();
    })

    $('#addNovoTecnicas').click(function () {
    	$('#tabela-tecnicas').hide();
	    $('#form-produto-tecnicas').show();
    })

	//  botões cancelar dos formularios
    $('#btn-cancel-item').click(function () {
    	$('#tabela-item').show();
	    $('#form-produto-item').hide();
    })

    $('#btn-cancel-dor').click(function () {
    	$('#tabela-dor').show();
	    $('#form-produto-dor').hide();
    })

    $('#btn-cancel-bonus').click(function () {
    	$('#tabela-bonus').show();
	    $('#form-produto-bonus').hide();
    })

    $('#btn-cancel-beneficios').click(function () {
    	$('#tabela-beneficios').show();
	    $('#form-produto-beneficios').hide();
    })

    $('#btn-cancel-tecnicas').click(function () {
    	$('#tabela-tecnicas').show();
	    $('#form-produto-tecnicas').hide();
    })

    $('#id-enviar').click(enviarProjetoCRUDClick);

	// adiciona comportamento dos botões enviar
	$('.btn-enviar-produto-detalhe').click(function () {
		var targetDetalhe = $(this).attr('data-target');
		var pid = $('.tag-projetoid').text();
		var desc;
		var controle;

		if ( targetDetalhe == 'inserir-projeto-tecnicas'){
			desc = $('#descritivo_tecnicas').val();
			controle = 'projeto-tecnicas';
		} else if( targetDetalhe == 'inserir-projeto-bonus'){
			desc = $('#descritivo_bonus').val();
			controle = 'projeto-bonus';
		} else if( targetDetalhe == 'inserir-projeto-beneficios'){
			desc = $('#descritivo_beneficios').val();
			controle = 'projeto-beneficios';
		} else if( targetDetalhe == 'inserir-projeto-dores'){
			desc = $('#descritivo_dor').val();
			controle = 'projeto-dores';
		} else if( targetDetalhe == 'inserir-projeto-item'){
			desc = $('#descritivo_item').val();
			controle = 'projeto-item';
		} 
/*		alert('modo='+targetDetalhe);
		alert('texto='+desc);
		alert('controle='+controle); */

	    var requestProjetoTecnicas = $.ajax({
	                url: '../php/classes/gateway/projetoCRUDController.php',
					method: "POST",
					data: {	pid: pid,
							modo: targetDetalhe,
							desc_produto: desc,
							projeto: controle },
	                success: carregarProjetoDetalhesTecnicasCallback
    	});
	});

    // Esconde os compontes de formulario
    $('#form-produto-item').hide();
    $('#form-produto-dor').hide();
    $('#form-produto-bonus').hide();
    $('#form-produto-beneficios').hide();
    $('#form-produto-tecnicas').hide();
   	$('.tag-projetoid').hide();


    // Le a parametrizacao da URL
   	var url = new URL(window.location.href);
    var target = url.searchParams.get("target");
	var isload = url.searchParams.get("lt");
	objeto = url.searchParams.get("o");
	modo = url.searchParams.get("mode");
	var pid = url.searchParams.get("pid");

	if (modo == "edit") 
	{
		// Carrega o registro atual
	    var request = $.ajax({
	                url: '../php/classes/gateway/projetoCarregarController.php',
					method: "POST",
					data: {	pid: pid },
	                success: carregarProjetoCallback
    	});
    	// carrega as tabelas de dependencias do projeto
	    var requestProjetoItem = $.ajax({
	                url: '../php/classes/gateway/projetodetalhesloadtableController.php',
					method: "POST",
					data: {	pid: pid,
							detalhe: 'projeto_item' },
	                success: carregarProjetoDetalhesItemCallback
    	});

	    var requestProjetoDor = $.ajax({
	                url: '../php/classes/gateway/projetodetalhesloadtableController.php',
					method: "POST",
					data: {	pid: pid,
							detalhe: 'projeto_dor' },
	                success: carregarProjetoDetalhesDorCallback
    	});

	    var requestProjetoBonus = $.ajax({
	                url: '../php/classes/gateway/projetodetalhesloadtableController.php',
					method: "POST",
					data: {	pid: pid,
							detalhe: 'projeto_bonus' },
	                success: carregarProjetoDetalhesBonusCallback
    	});

	    var requestProjetoBeneficios = $.ajax({
	                url: '../php/classes/gateway/projetodetalhesloadtableController.php',
					method: "POST",
					data: {	pid: pid,
							detalhe: 'projeto_beneficios' },
	                success: carregarProjetoDetalhesBeneficiosCallback
    	});

	    var requestProjetoTecnicas = $.ajax({
	                url: '../php/classes/gateway/projetodetalhesloadtableController.php',
					method: "POST",
					data: {	pid: pid,
							detalhe: 'projeto_tecnicas' },
	                success: carregarProjetoDetalhesTecnicasCallback
    	});
	}

})

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
    var target = url.searchParams.get("target");
	var isload = url.searchParams.get("lt");
	objeto = url.searchParams.get("o");
	modo = url.searchParams.get("mode");

	if ((isload === "true") && (target === "all_projetos")){
		carregarTabelas();	
	}

} );

// Carrega dados na tabela
var carregarTabelasCallback = function(retorno, status){
	// Executa uma função de controlador
	if (objeto === "projetos"){
		carregarTabelaProjetos(retorno);
	}
}

/* Carregar as Datatables */
function carregarTabelas() {

    // Chama a factory do facebook
    var request = $.ajax({
                url: '../php/classes/gateway/loadtableController.php',
                success: carregarTabelasCallback
    });
}

var carregarProjetoDetalhesTecnicasCallback = function (retorno, status) {
	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_tecnicas;

	var t = $('#dintable-produto-tecnicas').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {
    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<span onclick="deletarProjetoTecnicas('+pid+')" class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</span>'+
						'</td>';

			// Adiciona projeto x itens na datatable
			t.row.add( [
		            lst[i].desc,
		            acoes
		        ] ).draw( false );

		}
	}

}

var carregarProjetoDetalhesBeneficiosCallback = function (retorno, status) {

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_beneficios;


	var t = $('#dintable-produto-beneficios').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {

    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<span onclick="deletarProjetoBeneficios('+pid+')" class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</span>'+
						'</td>';

			// Adiciona projeto x itens na datatable
			t.row.add( [
		            lst[i].desc,
		            acoes
		        ] ).draw( false );
		}
	}
}

var carregarProjetoDetalhesBonusCallback = function (retorno, status) {

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_bonus;


	var t = $('#dintable-produto-bonus').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {

    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<span onclick="deletarProjetoBonus('+pid+')" class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</span>'+
						'</td>';

			// Adiciona projeto x itens na datatable
			t.row.add( [
		            lst[i].desc,
		            acoes
		        ] ).draw( false );
		}
	}
}


var carregarProjetoDetalhesDorCallback = function (retorno, status) {

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_dores;


	var t = $('#dintable-produto-dor').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {

    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<span onclick="deletarProjetoDores('+pid+')" class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</span>'+
						'</td>';

			// Adiciona projeto x itens na datatable
			t.row.add( [
		            lst[i].desc,
		            acoes
		        ] ).draw( false );
		}
	}
}

var carregarProjetoDetalhesItemCallback = function (retorno, status) {

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_itens;


	var t = $('#dintable-produto-item').DataTable( {
        "scrollX": true
    } );

    if (lst.length > 0) {         
    	for (var i = 0; i < lst.length; i++) {

    		// string html dos botões
    		var pid = lst[i].id;
			var acoes = '<td class="valigntop">' +
						'	<span onclick="deletarProjetoItens('+pid+')" class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</span>'+
						'</td>';

			// Adiciona projeto x itens na datatable
			t.row.add( [
		            lst[i].desc,
		            acoes
		        ] ).draw( false );
		}
	}
}


// Adicionar elemento inserido dentro da tabela dinamicamente após ter sido inserido 
function addProjetoDetalhesTecnicas(item) {

	// Transforma em objeto javascript e obtem lista de projetos
    //var dto = JSON.parse(item);

	var t = $('#dintable-produto-tecnicas').DataTable( {
        "scrollX": true
    } );

    		// string html dos botões
    		var pid = 1;
			var acoes = '<td class="valigntop">' +
						'	<span onclick="deletarProjetoTecnicas('+pid+')" class="btn btn-danger btn-xs">' +
						'		<i class="fa fa-trash-o "></i>'+
						'	</span>'+
						'</td>';

			// Adiciona projeto x itens na datatable
			t.row.add( [
		            'teste de inclusao na unha',
		            acoes
		        ] ).draw( false );
}




// Carrega dados na tabela Projeto
function carregarTabelaProjetos(retorno){

    //alert(retorno);

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


} // fim function carregarTabelaProjetos

function deletarProjetoTecnicas(id) {

    var request = $.ajax({
                url: '../php/classes/gateway/projetoCRUDController.php',
				method: "POST",
				data: {	pid: id ,
						projeto: 'projeto-tecnicas', 
						modo: 'deletar-projeto-tecnicas' },
                success: deletarProjetoTecnicasCallback
    });
}

function deletarProjetoItens(id) {

    var request = $.ajax({
                url: '../php/classes/gateway/projetoCRUDController.php',
				method: "POST",
				data: {	pid: id ,
						projeto: 'projeto-item', 
						modo: 'deletar-projeto-item' },
                success: deletarProjetoItensCallback
    });
}

function deletarProjetoDores(id) {

    var request = $.ajax({
                url: '../php/classes/gateway/projetoCRUDController.php',
				method: "POST",
				data: {	pid: id ,
						projeto: 'projeto-dores', 
						modo: 'deletar-projeto-dores' },
                success: deletarProjetoDoresCallback
    });
}

function deletarProjetoBonus(id) {

    var request = $.ajax({
                url: '../php/classes/gateway/projetoCRUDController.php',
				method: "POST",
				data: {	pid: id ,
						projeto: 'projeto-bonus', 
						modo: 'deletar-projeto-bonus' },
                success: deletarProjetoBonusCallback
    });
}

function deletarProjetoBeneficios(id) {

    var request = $.ajax({
                url: '../php/classes/gateway/projetoCRUDController.php',
				method: "POST",
				data: {	pid: id ,
						projeto: 'projeto-beneficios', 
						modo: 'deletar-projeto-beneficios' },
                success: deletarProjetoBeneficiosCallback
    });
}

var deletarProjetoItensCallback = function () {
	alert('refresh deletarProjetoItensCallback');

}
var deletarProjetoDoresCallback = function () {
	alert('refresh deletarProjetoDoresCallback');

}
var deletarProjetoBonusCallback = function () {
	alert('refresh deletarProjetoBonusCallback');

}
var deletarProjetoBeneficiosCallback = function () {
	alert('refresh deletarProjetoBeneficiosCallback');

}
var deletarProjetoTecnicasCallback = function () {
	alert('refresh deletarProjetoTecnicasCallback');

}
