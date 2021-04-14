/*

Javascript do projeto responsavel por atividades no Keyword

Julio Vitorino, 12/09/2018
*/

function getserp(pid){

    var req1 = $.ajax({
                url: '../php/classes/gateway/listProjetoSERPController.php',
                method: "POST",
                data: {
                	projetoid: pid
                },
                success: getSERPCallback
    });

    var req2 = $.ajax({
                url: '../php/classes/gateway/listProjetoSERPAnaliticoController.php',
                method: "POST",
                data: {
                	projetoid: pid
                },
                success: popularSERPAnaliticoCallback
    });
}

var getSERPCallback = function(retorno, status){

	// Transforma em objeto javascript e obtem lista de projetos
    var lst = JSON.parse(retorno);

    if (lst.length > 0) {         
   	    // grafico ranking, DA e PA
		var barChartDataRanking = dadosGraficoBarra(lst);
    }

    // grafico ranking
    seostudioChartBar(barChartDataRanking, "chartjs_bar", "Tendência");
}

function dadosGraficoBarra(lst) {

	var labelMesesX = [];
	var dadosBarRanking = [];
	var dadosBarPA = [];
	var dadosBarDA = [];

	for (var i = 0; i < lst.length; i++) {
		var serp = lst[i]; // GraficoProjetoSERPDTO
		labelMesesX.push(serp.mesano);
		dadosBarDA.push(parseInt(serp.sumDA,10));
		dadosBarPA.push(parseInt(serp.sumPA,10));
		dadosBarRanking.push(parseInt(serp.sumranking,10));
	}
    var color = Chart.helpers.color;
	var datasetRanking = {
             label: 'Ranking',
             backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
             borderColor: window.chartColors.blue,
             borderWidth: 1,
             data: dadosBarRanking
         }

	var datasetPA = {
             label: 'Page Authority',
             backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
             borderColor: window.chartColors.green,
             borderWidth: 1,
             data: dadosBarPA
         }

	var datasetDA = {
             label: 'Domain Authority',
             backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
             borderColor: window.chartColors.red,
             borderWidth: 1,
             data: dadosBarDA
         }

     var retorno = {
         labels: labelMesesX,
         datasets: [datasetRanking, datasetPA, datasetDA]
     };

     return retorno;

}

function seostudioChartBar(dados, canvasid, titulo){
	var color = Chart.helpers.color;
	var barChartData = dados;

	// simula um reset no canvas
	$('#' + canvasid).remove();
	$('#graph-container').append('<canvas id="'+canvasid+'"><canvas>');

     var ctx = document.getElementById(canvasid).getContext("2d");
     window.myBar = new Chart(ctx, {
         type: 'bar',
         data: barChartData,
         options: {
             responsive: true,
             legend: {
                 position: 'top',
             },
             title: {
                 display: true,
                 text: titulo
             }
         }
     });

}

function popularProjetosSERP(){
    var request = $.ajax({
                url: '../php/classes/gateway/loadtableController.php',
                success: popularProjetosSERPCallback
    });

}

var popularProjetosSERPCallback = function(retorno, status){
    //alert(retorno);

	// Transforma em objeto javascript e obtem lista de projetos
    var dto = JSON.parse(retorno);
    var lst = dto.lst_projetos;


	var t = $('#support_table_serp_projetos').DataTable( {
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
						'	<a href="javascript:getserp('+pid+'); "  class="btn btn-info btn-xs">' +
						'		<i class="fa fa-bar-chart "></i>'+
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


var popularSERPAnaliticoCallback = function (retorno, status) {
	//alert(retorno);
	
	// Apagar as linhas da TBody
	$('#table_serp_projetos_analitico > tbody').empty();

	// faz um parse no retorno
    var lst = JSON.parse(retorno);
	for (var i = 0; i < lst.length; i++) {
		var kwd = lst[i];
		
		$('#table_serp_projetos_analitico > tbody').append('<tr>'
                                                    +    '<td>'+ kwd.link +'</td>'
                                                    +    '<td>'+kwd.posicaoDA+'</td>'
                                                    +    '<td>'+kwd.posicaoPA+'</td>'
                                                    +    '<td>'+kwd.ranking+'</td>');
	}

}


function popularListaKeyword(){
    var request = $.ajax({
                url: '../php/classes/gateway/listKeywordController.php',
                method: "POST",
                success: popularListaKeywordSolicitadasClickCallback
    });

}



var popularListaKeywordSolicitadasClick = function() {
	popularListaKeyword();
}

var popularListaKeywordSolicitadasClickCallback = function (retorno, status) {
	// Apagar as linhas da TBody
	$('#support_table > tbody').empty();

	// faz um parse no retorno
    var lst = JSON.parse(retorno);
	for (var i = 0; i < lst.length; i++) {
		var kwd = lst[i];
		
		var diff =  parseInt(kwd.niveldificuldade,10);
		var diffcss = "danger";
		var difftxt = "Muito Difícil";
		if (diff <= 20){
			difftxt = "Muito Fácil";
			diffcss = "success";
		} else if (diff <= 40) {
			difftxt = "Fácil";
			diffcss = "warning";
		} else if (status <= 60) {
			difftxt = "Difícil";
			diffcss = "warning";
		}

		var status = kwd.status;
		var statuscss = "info";
		var statustxt = "Processado";
		if (status === 'Q'){
			statustxt = "Na fila";
			statuscss = "warning";
			difftxt = "Na Fila";
			diffcss = statuscss;

		} else if (status === 'B') {
			statustxt = "Plano Excedido";
			statuscss = "danger";
		} else if (status === 'W') {
			statustxt = "Processando agora";
			statuscss = "sucess";
		}

		$('#support_table > tbody').append('<tr>'
                                                    +    '<td>'+ kwd.keyword +'</td>'
                                                    +    '<td>'+kwd.volumepesquisa+'</td>'
                                                    +    '<td>'+kwd.valorcpc+'</td>'
                                                    +    '<td>'+kwd.niveldificuldade+'</td>'
                                                    +    '<td>'
                                                    +    '    <span class="label label-sm label-'+diffcss+'">'+difftxt+'</span>'
                                                    +    '</td>'
                                                    +    '<td>'
                                                    +    '    <span class="label label-sm label-'+statuscss+'">'+statustxt+'</span>'
                                                    +    '</td>'
                                                    +    '<td>'+kwd.dataAtualizacao+'</td>'
                                                    +    '<td><a href="javascript:popularRelacionadas('+kwd.id+');javascript:popularSERP('+kwd.id+')" class="" data-toggle="tooltip" title="Palavras relacionadas" >&nbsp;<i class="fa fa-link"></i></a></td>'
                                                    + '</tr>');
	}

}
function popularSERP(kwdid) {
    var request = $.ajax({
                url: '../php/classes/gateway/listKeywordSERPController.php',
                method: "POST",
                data: {
                	keywordparentid: kwdid
                },
                success: popularSERPCallback
    });
}

var popularSERPCallback = function (retorno, status) {
	// Apagar as linhas da TBody
	$('#support_table_serp_concorrentes > tbody').empty();

	// faz um parse no retorno
    var lst = JSON.parse(retorno);
	for (var i = 0; i < lst.length; i++) {
		var kwd = lst[i];
		
		$('#support_table_serp_concorrentes > tbody').append('<tr>'
                                                    +    '<td>'+ kwd.link +'</td>'
                                                    +    '<td>'+kwd.posicaoDA+'</td>'
                                                    +    '<td>'+kwd.posicaoPA+'</td>'
                                                    +    '<td>'+kwd.linkRelQtd+'</td>'
                                                    +    '<td>'+kwd.facebooklike+'</td>'
                                                    +    '<td>'+kwd.ranking+'</td>'
                                                    +    '<td>'+kwd.visitas+'</td>');
	}

}

function popularRelacionadas(kwdid) {
    var request = $.ajax({
                url: '../php/classes/gateway/listKeywordRelatedController.php',
                method: "POST",
                data: {
                	keywordparentid: kwdid
                },
                success: popularRelacionadasCallback
    });
}

var popularRelacionadasCallback = function (retorno, status) {
	// Apagar as linhas da TBody
	$('#support_table_related > tbody').empty();

	// faz um parse no retorno
    var lst = JSON.parse(retorno);
	for (var i = 0; i < lst.length; i++) {
		var kwd = lst[i];
		
		var diff =  parseInt(kwd.niveldificuldade,10);
		var diffcss = "danger";
		var difftxt = "Muito Difícil";
		if (diff <= 20){
			difftxt = "Muito Fácil";
			diffcss = "success";
		} else if (diff <= 40) {
			difftxt = "Fácil";
			diffcss = "warning";
		} else if (status <= 60) {
			difftxt = "Difícil";
			diffcss = "warning";
		}


		var status = kwd.status;
		var statuscss = "info";
		var statustxt = "Processado";
		if (status === 'Q'){
			statustxt = "Na fila";
			statuscss = "warning";
		} else if (status === 'B') {
			statustxt = "Plano Excedido";
			statuscss = "danger";
		} else if (status === 'W') {
			statustxt = "Processando agora";
			statuscss = "sucess";
		}

		$('#support_table_related > tbody').append('<tr>'
                                                    +    '<td>'+ kwd.keyword +'</td>'
                                                    +    '<td>'+kwd.volumepesquisa+'</td>'
                                                    +    '<td>'+kwd.valorcpc+'</td>'
                                                    +    '<td>'+kwd.niveldificuldade+'</td>'
                                                    +    '<td>'
                                                    +    '    <span class="label label-sm label-'+diffcss+'">'+difftxt+'</span>'
                                                    +    '</td>'
                                                    +    '<td>'
                                                    +    '    <span class="label label-sm label-'+statuscss+'">'+statustxt+'</span>'
                                                    +    '</td>'
                                                    +    '<td>'+kwd.dataAtualizacao+'</td>'
                                                    +    '<td><a href="javascript:popularRelacionadas('+kwd.id+')" class="" data-toggle="tooltip" title="Palavras relacionadas" >&nbsp;<i class="fa fa-link"></i></a></td>'
                                                    + '</tr>');
	}

}


//=============================================================================
/* após do DOM totalmente carregado configura e executa alguns procedimentos */
//=============================================================================
$(document).ready(function () {
	/* ==============================================
	        CONFIGURA EVENTOS DO LINKS DO MENU
	   ==============================================
	 */

    $('#btn-refresh').click(popularListaKeywordSolicitadasClick);
	
    // Eventos imediatos após DOM carregado
	popularListaKeyword();
	popularProjetosSERP();

});

