/*

Javascript do projeto

Julio Vitorino, 2018
*/

//==================================================================
// Ponteiro de função para controlar o comportamento do evento click
//==================================================================
function marcarLida(usnoid) {

    var request = $.ajax({
                url: '../php/classes/gateway/atualizarStatusNotificacaoController.php',
                method: "POST",
                data: {
                    usnoid: usnoid
                },
                success: marcarLidaNotificacaoCallback
    });
}

var marcarLidaNotificacaoCallback = function (retorno, status) {
    showWithCustomIconMessageOk("Notificação", "Mensagem será removida do painel notificação");
    popularUsuarioNotificacao();
}


function popularUsuarioNotificacao() {
    // Chama a factory de minisite
    var request = $.ajax({
                url: '../php/classes/gateway/listNotificacaoController.php',
                method: "POST",
                success: popularUsuarioNotificacaoCallback
    });
}

var popularUsuarioNotificacaoCallback = function (retorno, status) {
    // Popular a sinalização de identificação
    var dto = JSON.parse(retorno);
    $('#header_notification_bar .badge').text(' ' + dto.novos + ' ');
    $('#header_notification_bar > ul > li .notification-label').text(' ' + dto.novos + ' Novos ');
    $('#header_notification_bar #lista-notificacao').empty();

    for (var i = 0; i < dto.lstnotificacao.length; i++) {
       var notdto = dto.lstnotificacao[i];
       var lihtml = '<li>'
        + '<a href="javascript:marcarLida('+notdto.id+');">'
        + '   <span class="time">'+notdto.dataCadastro.substring(0,10)+'</span>'
        + '   <span class="details">'
        + '   <span class="notification-icon circle '+notdto.bgcolor+'">'
        + '         <i class="'+notdto.icone+'"></i></span>' + notdto.textonotificacao + '</span>'
        + '</a>'
        + '</li>';
        $('#header_notification_bar #lista-notificacao').append(lihtml);
    }
}

function popularUsuarioAtivo() {
    // Chama a factory de minisite
    var request = $.ajax({
                url: '../php/classes/gateway/dashboardController.php',
                method: "POST",
                data: { funcao: 'usuarioAtivo' },
                success: popularUsuarioAtivoCallback
    });
}

var popularUsuarioAtivoCallback = function (retorno, status) {
    var dto = JSON.parse(retorno);
    $('.id-usuario').text(dto.usuario);
    $('.user-panel img').attr('src',dto.urlfoto);
    $('.dropdown-user img').attr('src',dto.urlfoto);
    
    //console.log(dto.urlfoto);
}

var enviarKeywordClick = function () {
    var projeto = $("#id-lst-projetos").val();
    var keyword = $("#txt-keyword").val();

    var request = $.ajax({
                url: '../php/classes/gateway/addKeywordController.php',
                method: "POST",
                data: {projetoid: projeto,
                        keyword: keyword
                    },
                success: enviarKeywordClickCallback
    });

}

var  enviarKeywordClickCallback = function(retorno, status) {
    var dto = JSON.parse(retorno);
    showWithCustomIconMessageOk("Palavra chave", dto.msgcodeString);
    popularListaKeyword(); //gcjcv_keyword

}


var gerarArtigoWeb20pceClick = function () {
    
    // Obtem os dados do form
    var projeto = $("#id-lst-projetos").val();
    var s20 = $("#id-secao-20").val();

    // Chama a factory de minisite
    var request = $.ajax({
                url: '../php/classes/gateway/Web20PBNController.php',
                method: "POST",
                data: {target: projeto,
                        s20: s20
                    },
                success: gerarArtigoWeb20pceClickCallback
    });
}


var gerarArtigoWeb20pceClickCallback = function (retorno, status) {
    $("#txt-retorno").html(retorno);
    $('#txt-html').text(retorno);
}

var gerarHeadlineClick = function () {

    // obtem o nicho da lista
    var objetivo = $('#paramObjetivo').val();
    var palavrachave = $('#paramPalavraChave').val();
    var gatilho = '0';

    // Verifica se a Checkbox está acionada
    if ($('#gatilhourgencia').is(':checked')) {
        gatilho = '1';
    }

    // Chama a factory do facebook
    var request = $.ajax({
                url: '../php/classes/gateway/headlineController.php',
                method: "POST",
                data: {palavrachave: palavrachave, objetivo: objetivo, gatilho: gatilho },
                success: gerarHeadlineClickCallback
    });

}

var gerarHeadlineClickCallback = function (retorno, status) {
    $("#lst-headline").html(retorno);
}

var enviarPostFcbkClick = function () {

		// obtem o nicho da lista
		var nicho = $('#id-nicho').val();
		if (nicho == "0"){
			showWithTitleMessage("Escolha um nicho", "Aviso");
		} else {
			// Chama a factory do facebook
			var request = $.ajax({
						url: '../php/classes/gateway/facebookController.php',
						method: "POST",
						data: {target: nicho},
						success: enviarPostFcbkClickCallback
			});
		}
}

var enviarPostFcbkClickCallback = function (retorno, status) {
	$("#txt-post-facebook").html(retorno);
}

var copiarHtmlClick = function () {
    var elem = $( this ).attr("copytoclipboard");
    copyToClipboard(elem);
}

var copiarClick = function () {
	var elem = $( this ).attr("copytoclipboard");
	copyToClipboard(elem);
}

var gerarArtigoMinisiteClick = function () {
	// Obtem os dados do form
	var projeto = $("#id-lst-projetos").val();
	var s1 = $("#id-secao-01").val();
	var s2 = $("#id-secao-02").val();
	var s3 = $("#id-secao-03").val();
	var s4 = $("#id-secao-04").val();
	var s5 = $("#id-secao-05").val();
	var s6 = $("#id-secao-06").val();
	var s7 = $("#id-secao-07").val();
	var s8 = $("#id-secao-08").val();
	var s9 = $("#id-secao-09").val();
	var s10 = $("#id-secao-10").val();
	var s11 = $("#id-secao-11").val();
	var s12 = $("#id-secao-12").val();
	var s13 = $("#id-secao-13").val();
	var s14 = $("#id-secao-14").val();
	var s15 = $("#id-secao-15").val();
	var s16 = $("#id-secao-16").val();
	var s17 = $("#id-secao-17").val();
	var s18 = $("#id-secao-18").val();
	var s19 = $("#id-secao-19").val();
	var s20 = $("#id-secao-20").val();

	// Chama a factory de minisite
	var request = $.ajax({
				url: '../php/classes/gateway/minisiteController.php',
				method: "POST",
				data: {target: projeto,
						s1: s1,
						s2: s2,
						s3: s3,
						s4: s4,
						s5: s5,
						s6: s6,
						s7: s7,
						s8: s8,
						s9: s9,
						s10: s10,
						s11: s11,
						s12: s12,
						s13: s13,
						s14: s14,
						s15: s15,
						s16: s16,
						s17: s17,
						s18: s18,
						s19: s19,
						s20: s20
					},
				success: gerarArtigoMinisiteClickCallback
	});


}

var gerarArtigoMinisiteClickCallback = function (retorno, status) {
	$("#txt-retorno").html(retorno);
    $('#txt-html').text(retorno);
}

/* Controla evento change para liberação das seções */
var nichoChange = function () {
	var dataTarget = $(this).attr('data-target');
	ativarSecao(dataTarget);
}

/* ============================================================================= */



/* Ativar a seção corresponde ao pai */
function ativarSecao(secaoid){
	$(secaoid).show();
}



/* Copiar um conteúdo de um elemento para o clipboard */
function copyToClipboard(elementoAlvo){
    var copyText = document.getElementById(elementoAlvo);
    var textArea = document.createElement("textarea");
    textArea.value = $(elementoAlvo).text();
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    showWithCustomIconMessageOk("Post Copiado", "Seu post foi copiado para área de trabalho - use CTRL+V");
}

/* funções de uso Geral para Alert */

function showWithCustomIconMessageOk(titulo, msg) {
    swal({
        title: titulo,
        text: msg,
        imageUrl: "../assets/sweet-alert/thumbs_up.png"
    });
}

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage(msg) {
    swal(msg);
}

function showWithTitleMessage(titulo, msg) {
    swal(msg, titulo);
}

function showSuccessMessage(titulo, msg) {
    swal(titulo, msg, "success");
}

function showConfirmMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}

function showCancelMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

function showWithCustomIconMessage() {
    swal({
        title: "Sweet!",
        text: "Here's a custom image.",
        imageUrl: "../assets/sweet-alert/thumbs_up.png"
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Title</small>!",
        text: "A custom <span style=\"color: #CC0000\">html<span> message.",
        html: true
    });
}

function showAutoCloseTimerMessage() {
    swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
    });
}

function showPromptMessage() {
    swal({
        title: "An input!",
        text: "Write something interesting:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!"); return false
        }
        swal("Nice!", "You wrote: " + inputValue, "success");
    });
}

function showAjaxLoaderMessage() {
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        setTimeout(function () {
            swal("Ajax request finished!");
        }, 2000);
    });
}
//These codes takes from http://t4t5.github.io/sweetalert/



//=============================================================================
/* após do DOM totalmente carregado configura e executa alguns procedimentos */
//=============================================================================
$(document).ready(function () {
    /* ==============================================
            EVENTOS PADRÕES PARA OS BOTÕES:
            Novo+
            Enviar
       ==============================================
    */

    $('#addNovo').click(function () {
        var target = $('#addNovo').attr('data-target');
        window.location.href=target;
    })
    $('#btnEnviar').click(function () {
        var target = $('#btnEnviar').attr('data-target');
        window.location.href=target;
    })
	/* ==============================================
	        CONFIGURA EVENTOS DO LINKS DO MENU
	   ==============================================
	*/

	$('#id-btn-pst-fcbk').click(enviarPostFcbkClick);
	$('#id-ctc-copy-text').click(copiarClick);
    $('#id-ctc-copy-html').click(copiarHtmlClick);
    $('#id-btn-artigo-mini').click(gerarArtigoMinisiteClick);
    $('#id-btn-web20-pce').click(gerarArtigoWeb20pceClick);
    $('#btn-enviar-headline').click(gerarHeadlineClick);
	$('#id-lst-projetos').change(nichoChange);
	$('.card-body .form-selection-hide').change(nichoChange);
    $('#btn-enviar-keyword').click(enviarKeywordClick);

	$('.form-selection-hide').hide();
    $('#txt-html').hide();

    popularUsuarioAtivo();
    popularUsuarioNotificacao();

});

