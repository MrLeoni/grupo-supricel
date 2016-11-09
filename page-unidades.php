<?php
/**
 * Template Name: Unidades
 */
 
// Utilizando o thumbnail da página como banner
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, "full", true);
// $replace = preg_replace("/ /", "+", $string);

/**-----------------------------------------------------
 * 
 * Página que exibira as unidades do Grupo Supricel
 * 
 * Aqui vamos criar uma query para enfileirar posts
 * do tipo "Unidades"
 * 
 * Dentro de cada post há um campo no qual o usuário
 * colocou a sigla do estdo no qual a unidade está
 * localizada. E usaremos esse campo como filtro.
 * Quando o usuário clicar em algum estado do mapa
 * apenas posts que tenham a silga do estdo será 
 * exibido, usaremos JavaScript para executar essa
 * função.
 * 
 * Essa página conta também com uma função em PHP 
 * e em JavaScript para exibir o endereço da
 * unidade no mapa no final da página. Aqui está
 * uma breve descrição de seu funcionamento:
 * 
 * 1 -> O usuário preenche o campo de endereço da
 * unidade durante a criação do campo
 * 
 * 2 -> Pegamos esse campo, aplicamos a função 
 * "preg_replace()" para trocar todos os espaços
 * por "+"
 * 
 * 3 -> Aplicamos o resultado do metodo em um
 * atributo HTML
 * 
 * 4 -> Utlizamos esse atributo em uma função
 * JavaScript para substituir parcialmente o "src"
 * do iframe e exibir o novo endereço.
 * 
 * ---------------------------------------------------*/
 
// Criando argumentos para a query
$unidades_args = array(
	"post_type"	=> "unidades",
	"orderby"	=> "modified",
	"posts_per_page"	=> 99,
);
$unidade_query = new WP_Query( $unidades_args );


get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<section class="banner" style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center">
			<h1><?php echo get_the_title(); ?></h1>
		</section>
		
		<section id="unidades">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php get_template_part( 'template-parts/content', 'brasil' ); ?>
					</div>
					<div class="col-md-6">
						<div class="unidades-wrapper">
							
							<div class="unidade-box initial">
								<div class="unidade-content">
									<h2 class="temp-title">Selecione um estado</h2>
								</div>
							</div>
							
							<?php
								while($unidade_query->have_posts()): $unidade_query->the_post();
								
									// ACF Fields
									$state = get_field("unidade-state");
									$map_check = get_field("unidade-check");
									$map_zoom = get_field("unidade-zoom");
									$map_address_raw = get_field("unidade-address");
									// Substituindo espaços em branco
									$map_address_ready = preg_replace("/ /", "+", $map_address_raw);
									?>
									
									<div class="unidade-box" data-state="<?php echo $state; ?>" >
										<div class="unidade-content">
											<?php the_title("<h3>", "</h3>");
											the_content(); 
											
											if($map_check == "true") { ?>
												<button class="address-btn fill" data-address="<?php echo $map_address_ready; ?>" >Ver no mapa</button>
											<?php } ?>
										</div>
									</div>
									
								<?php
								endwhile;
								wp_reset_postdata();
							?>
						
						</div>
					</div>
				</div>
			</div>
			<div id="#map" class="map-box">
				<iframe id="google-maps" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?key=AIzaSyCHOQP_b4S5a2akoafsPXoky728zyAVjSM&center=-9.8427305,-51.2325373&zoom=5" allowfullscreen></iframe>
			</div>
			<div class="follow-box"></div>
		</section>
		
	</main>
</div>

<?php get_footer(); ?>