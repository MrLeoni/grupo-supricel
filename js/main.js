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
  
  /* Interações com o mapa do Brasil */
  // Caixa que segue o mouse quando ele está em cima do mapa
  $(".brasil-map-box").on('mousemove', function(e){
    $('.follow-box').css({
     left:  e.pageX,
     top:   e.pageY
    });
  });
  
  // Exibe atributo do estado quando o mouse passa por cima d eum estado
  $(".estado").hover(function() {
  	// Guardando o valor do atributo "data-state-info" em uma variável,
  	// armazenando apenas do estado que o mouse estiver em cima
    var nomeEstado = $(this).attr("data-state-info");
    
    // Aplicando o conteúdo da variável no elemento "follow-box"
    $(".follow-box").css("background-color", "#0b4d8e").html(nomeEstado);
  }, function() {
  	// Se o mouse não está em cima de um estado, o elemento "follow-box" fica invisível
    $(".follow-box").css("background-color", "transparent").html(" ");
  });
  
  
  // Engine que manipula elementos ao clicar sobre um estado no mapa
  $(".estado").click(function() {
  	
  	/* Armazenando elementos importantes em variáveis */
  	
  	// Selecionando o elemento que foi clicado
  	var element = $(this);
  	// Selecionando o valor do atributo "data-state" do elemento clicado
  	var sigla = element.attr("data-state");
  	// Selecionando o elemento ".unidade-box" que possui i atributo "data-state" igual ao do elemento "element"
  	var unidadeBox = $(".unidade-box[data-state='"+sigla+"']");
  	// Selecionando o elemento ".unidade-content" dentro do elemento ".unidade-box" que possui o mesmo valor de "data-state" do elemento "element"
  	var unidadeContent = $(".unidade-box[data-state='"+sigla+"'] .unidade-content");
  	
  	// Alternando entre classes quando o elemento "element" é clicado
  	$(".estado").removeClass('active');
  	element.toggleClass('active');
  	
  	// Escondendo todos os elementos ".unidade-content" e ".unidade-box" que estejam visíveis na página
  	$(".unidade-content").animate({opacity: "0"}, 200, function() {
  		$(".unidade-box").slideUp(400);
  	});
  	
  	// Mostrando apenas o elemento ".unidade-box" e ".unidade-content" que tenham o mesmo "data-state" de "element"
  	setTimeout(function() {
  		unidadeBox.slideDown(400);
  		unidadeContent.delay(200).animate({ opacity: "1"}, 200);
  	}, 650);
  	
  });
  
  // Pega o endereço que o usuário digitou e aplica na URL do iframe do google maps
  // Faz um scroll na página até o mapa
  $(".address-btn").click(function() {
  	
  	/* Armazenando elementos */
  	// Selecionando atributo "data-address" do elemento clicado
  	var address = $(this).attr("data-address");
  	// Selecionando elemento "#google-maps"
  	var map = $("#google-maps");
  	// Criando valor numérico para utilizar no scrollTop
  	var mapOffset = map.offset().top - 150;
  	
  	// Aplica a string ao elemento "#google-maps", utilizando a variável "address"
		map.attr("src", "https://www.google.com/maps/embed/v1/place?q=" + address + "&key=AIzaSyCHOQP_b4S5a2akoafsPXoky728zyAVjSM&zoom=15");
		
		// Faz o scroll até o elemento "#google-maps"
		$('html,body').animate({
	  	scrollTop: mapOffset },
		'slow');
		
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