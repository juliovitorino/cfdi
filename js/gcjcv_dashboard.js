/*

Javascript do projeto responsavel por atividades no bashboard

Julio Vitorino, 14/08/2018
*/
/*
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
}
*/
//=============================================================================
/* após do DOM totalmente carregado configura e executa alguns procedimentos */
//=============================================================================
$(document).ready(function () {
	/* ==============================================
	        CONFIGURA EVENTOS DO LINKS DO MENU
	   ==============================================
	 */

     //popularUsuarioAtivo();



});

