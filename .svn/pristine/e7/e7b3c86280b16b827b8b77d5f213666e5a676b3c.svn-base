/**
 *  Document   : table_data.js
 *  Author     : redstar
 *  Description: advance table page script
 *
 *  Adaptação..: Julio Vitorino
 *  Data.......: 11/09/2018
 *  Atualização: 12/09/2018
 **/

// Objeto JSON que será carregado na tabela 
var objeto;
var modo;
var url;
var target;
var isload;
var pid;

//////////////////////////////////////////////////////////////////
// DOM montado

//Prepara botão novo para ativar form de adicionar novo
$(document).ready(function() {
    // Le a parametrizacao da URL
    url = new URL(window.location.href);
    target = url.searchParams.get("target");
    isload = url.searchParams.get("lt");
    objeto = url.searchParams.get("o");
    modo = url.searchParams.get("mode");
    pid = url.searchParams.get("pid");
});

$(document).ready(function() {
    // prepara comportamento dos botões
    $('#btn-pqp').click(atualizarBacklinks);
    $('#btn-criar-bkl').click(criarBacklinks);
});

/* Criar mais backlinks */
var criarBacklinks = function() {
    // Chama a factory do facebook
    var request = $.ajax({
                url: '../php/classes/gateway/backlinknfCriarController.php',
                success: criarBacklinksCallback
    });
}


/* Carregar as Datatables */
var atualizarBacklinks = function() {
    // Chama a factory do facebook
    var request = $.ajax({
                url: '../php/classes/gateway/backlinknfController.php',
                method: "POST",
                data: { objeto: objeto,
                        modo: modo,
                        target: target,
                        isload: isload,
                        pid: pid
                },
                success: carregarTabelasCallback
    });
}

// Carrega dados na tabela
var criarBacklinksCallback = function(retorno, status){
    var dto = JSON.parse(retorno);
    showWithCustomIconMessageOk("Criar Backlink No Follow", dto.msgcodeString);
}

var carregarTabelasCallback = function(retorno, status){
    PopularBacklinks(retorno);
}

function PopularBacklinks(retorno) {

    var t = $('#dintable').DataTable( {
        "scrollX": true
    } );

    // parse da array de UsuarioBacklinkDTO
    var lstub = JSON.parse(retorno);
    if (lstub.length > 0){
        for (var i = 0; i < lstub.length; i++) {
            var ubdto = lstub[i];
            var fake = ubdto.fakedto;

            // string html dos botões
            var pid = ubdto.id;
//            var urlbacklink = ubdto.url;
            var urlbacklink = 'Pesquisar URLs dentro do Brasil';
            var nome = fake.nome;
            var sobrenome = fake.sobrenome;
            var email = fake.email;
            var status = ubdto.status;

            var acoes = '<td class="valigntop">' +
                        '   <a href="'+ubdto.url+'" target="_blank" class="btn btn-info btn-xs" title="Ir para o backlink">' +
                        '       <i class="fa fa-external-link "></i>'+
                        '   </a>'+
                        '   <a href="javascript:reportarbugBacklink('+pid+');" class="btn btn-danger btn-xs" title="Reportar um problema">' +
                        '       <i class="fa fa-bug"></i>' +
                        '   </a>' +
                        '   <a href="javascript:checkBacklist('+pid+');" class="btn btn-success btn-xs" title="Finalizar o backlink">' +
                        '       <i class="fa fa-check"></i>' +
                        '   </a>' +
                        '</td>';

            // string html do status
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
            } else if (status === "R"){
                label = "label-success";
                span = "Realizado";
            }
            var statushtml = '<span class="label label-sm '+ label +'"> '+span+' </span>';
//alert(statushtml);

            // Adiciona projeto na tabela
            t.row.add( [
                    urlbacklink,
                    nome,
                    sobrenome,
                    email,
                    statushtml,
                    acoes
                ] ).draw( false );

        }
    }
}

function reportarbugBacklink(usbaid){
    var request = $.ajax({
                url: '../php/classes/gateway/backlinkAtualizarStatusController.php',
                method: "POST",
                data: { usbaid: usbaid,
                        novostatus: 'B'
                },
                success: reportarBacklinkCallback
    });
}

function checkBacklist(usbaid) {
    var request = $.ajax({
                url: '../php/classes/gateway/backlinkAtualizarStatusController.php',
                method: "POST",
                data: { usbaid: usbaid,
                        novostatus: 'R'
                },
                success: reportarBacklinkCallback
    });
}

var reportarBacklinkCallback = function(retorno, status){
    var dto = JSON.parse(retorno);
    showWithCustomIconMessageOk("Backlink No Follow", dto.msgcodeString);
}
