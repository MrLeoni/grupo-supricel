$(document).ready(function() {
  
  /*--------------------------------
  // Mobile navigation engine
  --------------------------------*/
  
  $("#js-mobile-btn").click(function() {
    
    // Toggle class in #js-mobile-btn
    // When "active" is placed, the icon changes to a times icon and the navigation apears
    $(this).toggleClass("active");
    
    // Creating a boolean variable to check if #js-mobile-btn has or not the "active" class
    var btnHasClass = $(this).hasClass("active");
    // Store "menu-navigation-box" in a variable
    var nav = $(".menu-navigation-box");
    
    if (btnHasClass) {
      // If #js-mobile-nav is active, change css in menu-navigation-box
      nav.css("height", "auto");
    } else {
      // If it's not active, set "height" to "0"
      nav.css("height", "0");
    }
    
  });
  
  /*--------------------------------
  // Home Sliders
  --------------------------------*/
  
  /* Banner */
  $(".home-banner").bxSlider({
    mode: "fade",
    controls: false,
    auto: true,
    autoHover: true,
    pause: 7000,
    pagerCustom: "#home-pager",
  });
  
  /* Seguimentos */
  $(".seguimentos-slider").bxSlider({
    mode: "fade",
    pager: false,
    nextSelector: ".seg-next",
    prevSelector: ".seg-prev",
    auto: true,
    autoHover: true,
    pause: 7000,
  });
  
  /*--------------------------------
  // Default Carrossel
  --------------------------------*/
  
	// Função para checar a existência do elemento ".carrossel-default na página"
	function blogSlider() {
		
		// Criando variáveis: 
		// Armazenando o elemento em uma variável
		var elementSlider = $(".carrossel-default");
		// screenWidth = Metodo para detectar tamanho da tela
    var screenWidth = $(window).width();
    // margin = número em px de margin
    var margin;
		
		// Detectando o tamanho da tela do dispositivo e retornar a margem
	  // adequada entre os slides, dependendo do tamanho da tela
	  var sliderMargin = function(screen, margin) {
	    
	    // Checando tamanho da tela e retornando
	    // valor para margin
	    if(screen < 990 && screen > 460) {
	      margin = 40;
	    } else if (screen < 460) {
	      margin = 20;
	    } else {
	      margin = 90; 
	    }
	    return margin;
	    // Retornando margin
	  };
		
		// Checando sua existência
		if(!elementSlider.length == 0) {
		
			// Se existir, aplicar .bxSlider à ele
			elementSlider.bxSlider({
			pager: false,
			auto: true,
			autoHover: true,
			pause: 5000,
			nextSelector: ".ctrl-next",
			prevSelector: ".ctrl-prev",
			slideWidth: 200,
			minSlides: 2,
			maxSlides: 3,
			moveSlides: 1,
			slideMargin: sliderMargin(screenWidth, margin) /* Executando função */
			});
		}
		
	}
	blogSlider();
	
	/*--------------------------------
  // Unidades
  --------------------------------*/
  
  /* Mapa do Brasil */
  // Aplica classe "active" para mostrar qual estado esta ativo
  function toggleClass() {
    var menu = $('.brasil-map-box svg path');
    menu.click(function () {
      menu.not(this).removeClass('active');
      $(this).toggleClass('active');
    });
  }
  toggleClass();
  
  // Caixa que segue o mouse quando ele está em cima do mapa
  $(".brasil-map-box").on('mousemove', function(e){
    $('.follow-box').css({
     left:  e.pageX,
     top:   e.pageY
    });
  });
  
  // Exibe atributo do estado quando o mouse passa por cima d eum estado
  $(".estado").hover(function() {
    var nomeEstado = $(this).attr("data-state-info");
    $(".follow-box").css("background-color", "#0b4d8e").html(nomeEstado);
  }, function() {
    $(".follow-box").css("background-color", "transparent").html(" ");
  });
  
  
  /*--------------------------------
	* Preenchimento automático de 
  * endereço através do CEP
  *
  * Créditos: ViaCEP
  * http://viacep.com.br
  --------------------------------*/
  
  function limpa_formulário_cep() {
	  // Limpa valores do formulário de cep.
	  $("#rua").val("");
	  $("#bairro").val("");
	  $("#cidade").val("");
	  $("#uf").val("");
	  $("#ibge").val("");
  }
  
	$("#cep").blur(function() {
		//Nova variável "cep" somente com dígitos.
		var cep = $(this).val().replace(/\D/g, '');
		
		//Verifica se campo cep possui valor informado.
		if (cep != "") {
		
			//Expressão regular para validar o CEP.
			var validacep = /^[0-9]{8}$/;
			
			//Valida o formato do CEP.
			if(validacep.test(cep)) {
			
				//Preenche os campos com "..." enquanto consulta webservice.
				$("#rua").val("...");
				$("#bairro").val("...");
				$("#cidade").val("...");
				$("#uf").val("...");
				$("#ibge").val("...");
				
				//Consulta o webservice viacep.com.br/
				$.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
				
					if (!("erro" in dados)) {
						//Atualiza os campos com os valores da consulta.
						$("#rua").val(dados.logradouro);
						$("#bairro").val(dados.bairro);
						$("#cidade").val(dados.localidade);
						$("#uf").val(dados.uf);
						$("#ibge").val(dados.ibge);
					} //end if.
					else {
						//CEP pesquisado não foi encontrado.
						limpa_formulário_cep();
						alert("CEP não encontrado.");
					}
				});
			} //end if.
			else {
				//cep é inválido.
				limpa_formulário_cep();
				alert("Formato de CEP inválido.");
			}
		} //end if.
		else {
			//cep sem valor, limpa formulário.
			limpa_formulário_cep();
		}
	});
  
});