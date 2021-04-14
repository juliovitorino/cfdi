/*

Javascript do projeto

Julio Vitorino, 2018
*/

/* Ajuste dinâmico do padding na seção header-overlay */
var ajustePaddingAutomativo = function autoPadding() {
	// Obtém alguns valores do browser
	var alturaWindow = $(window).height();
	var alturahc = $('.header-container').height;

	// calcula autopadding
	var paddingcalc = Math.round((alturaWindow - alturahc) / 2);

	// Realiza ajuste no CSS dinamicamente
	$('.header-container').css({
		'padding-top': paddingcalc + 'px',
		'padding-bottom': paddingcalc + 'px'
	});

}

/* ponteiro de função para controlar a transição do menu durante o evento de scroll do objeto window */
var transicaoMenu = function transicaoMenu() {

		'use strict';
		console.log($(window).scrollTop());

		// Verifica o topo da window atraves do método scrollTop() 
		// para identifica se a rolagem está na primeira página (capa)
		if($(window).scrollTop() < 110){
			$('.navbar').css({
				'margin-top': '-110px'
			});
		} else {
			$('.navbar').css({
				'margin-top': '0px'
			});
		}

	}

/* cria um procedimento de rolagem suave dentro do documento */	
/* 

fonte na web https://css-tricks.com/snippets/jquery/smooth-scrolling/ 
BY HEATHER MIGLIORISI

*/
function smoothScrolling() {
	// Select all links with hashes

	// Avisa ao JQuery quais classes e/ou ids irão sofrer o smooth
	$('.nav-item, #rolar-para-topo, .header-btns')

	  // Remove links that don't actually link to anything
	  .not('[href="#"]')
	  .not('[href="#0"]')
	  .click(function(event) {
	    // On-page links
	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
	      // Figure out element to scroll to
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      // Does a scroll target exist?
	      if (target.length) {
	        // Only prevent default if animation is actually gonna happen
	        event.preventDefault();
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000, function() {
	          // Callback after animation
	          // Must change focus!
	          var $target = $(target);
	          $target.focus();
	          if ($target.is(":focus")) { // Checking if the target was focused
	            return false;
	          } else {
	            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
	            $target.focus(); // Set focus again
	          };
	        });
	      }
	    }
	  });

}

// callback popular as respostas 
var headlinesCallback = function (retorno, status) {
	// Ativa a seção respostas
	$('.respostas-headlines').show();

	// Transforma o string encode em objeto JSON
	var hl = JSON.parse(retorno);
	$('#hl-0').text(hl.headlineA);
	$('#hl-1').text(hl.headlineB);
	$('#hl-2').text(hl.headlineC);
	$('#hl-3').text(hl.headlineD);
	$('#hl-4').text(hl.headlineE);
}

// busca a headline no backend e devolve ao callback
var getHeadlines = function () {

	//Obtém os valores dos campos da tela de formulário
	var palavrachave = $("#palavrachave").val();
	var tempo = '0';
	var objetivo = $("#objetivo").val();

	// Verifica se a Checkbox está acionada
	if ($('#tempo').is(':checked')) {
		tempo = '1';
	}

	// Invoca criador de headline 
	var request = $.ajax({
				url: 'php/headlinemaker.php',
				method: "POST",
				data: {pw: palavrachave, periodo: tempo, alvo: objetivo}
	});

	request.success(headlinesCallback);


/* FUNCIONANDO
	$.ajax({
		url: 'php/headlinemaker.php',

		success: headlinesCallback
	});
*/
}

/* após do DOM totalmente carregado configura e executa alguns procedimentos */
$(document).ready(function () {
	
	// esconde a navbar (menu de navegação) em tempo de execução 
	// ao carregar todo o DOM
	$('.navbar').css({'margin-top': '-110px'});

	// Ativa a rolagem suave de tela
	smoothScrolling();

	// Desativa a seção varias seções
	$('.respostas-headlines').hide();


	/* ==============================================
	   === CONFIGURA TODOS OS PONTEIROS DE FUNÇÃO ===
	   ==============================================
	 */

	
	$(window).scroll(transicaoMenu); // configura ponteiro na window o evento de scroll da transição do menu
	setInterval(ajustePaddingAutomativo,1000);
	$('#btn-headline').click(getHeadlines); // Configura evento de click do botão para chamar o backend
	
	/* =================================
	   === COMPONENTES DE TERCEIROS  ===
	   =================================
	 */

	// Iniciar componente Woo
	new WOW().init();


});