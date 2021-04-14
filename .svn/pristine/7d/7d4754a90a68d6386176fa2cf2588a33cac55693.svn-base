// membros da campanha
var target;                  //URL alvo para consumir os dados desta View
var isconsole = true;        // Emite algum resulta na console do browser

// campos da sua View
var datainicio;
var datatermino;
var campanha;
var fraseefeito;
var recompensa;
var maxcartelas;
var tempoespera;
var detalhe;

function emitirConsole(){
	console.log(fraseefeito);
	console.log(recompensa);
	console.log(campanha);
	console.log(detalhe);
	console.log(datatermino);
	console.log(datainicio);
	console.log(maxcartelas);
	console.log(tempoespera);
}

function sendTarget(){
//alert('vou no backend');
	// Enviar dados ao target
	var request = $.ajax({
				url: target,
				method: "POST",
				data: {CAMP_TX_NOME: campanha,
						CAMP_TX_EXPLICATIVO: detalhe,
						CAMP_NU_MAX_CARTAO: maxcartelas,
						CAMP_DT_INICIO: datainicio,
						CAMP_DT_TERMINO: datatermino,
						CAMP_NU_MIN_DELAY: tempoespera,
						CAMP_TX_FRASE_EFEITO: fraseefeito,
						CAMP_TX_RECOMPENSA: recompensa
					},
				success: onsuccessCallback
	});

}

function onsuccessCallback(retorno, status) {
	//alert(retorno);
	var ret = JSON.parse(retorno);
	showWithCustomIconMessageOk("Campanha", ret.msgcodeString);
}

function getDadosView() {
	campanha = $("#CAMP_TX_NOME").val();
	fraseefeito = $("#CAMP_TX_FRASE_EFEITO").val();
	recompensa = $("#CAMP_TX_RECOMPENSA").val();
	detalhe = $("#CAMP_TX_EXPLICATIVO").val();
	maxcartelas = $("#CAMP_NU_MAX_CARTAO").val();

	// Obtem os dados especiais pelos campos do Materials DatePicker
	datainicio = $("input[name='CAMP_DT_INICIO']").val();
	datatermino = $("input[name='CAMP_DT_TERMINO']").val();
	tempoespera = $("input[name='CAMP_NU_MIN_DELAY']").val();

	// Emitir dados na console?
	if(isconsole){
		emitirConsole();
	}
}

$(document).ready(function() {

    $('#addbtn').click(function () {
        target = $('#addbtn').attr('data-target') + ".php";
//        alert(target);
        getDadosView();
        sendTarget();
    })



});