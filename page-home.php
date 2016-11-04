<?php
/**
 * Template Name: Home
 */
 
/*--------------------------
* Banner
* -----------------------*/
 
// Argumentos para criar uma query de "Conteúdo Home" custom posts
// e aplicando somente posts com a taxonomia "Home Banner"
$home_banner_args = array(
	"post_type"	=> "home",
	"orderby"	=> "modified",
	"tax_query"	=> array(array( "taxonomy" => "home-categorias", "field" => "slug", "terms" => "home-banner"))
);
// Aplicando argumentos
$home_banner_query = new WP_Query( $home_banner_args );

/*--------------------------
* Segmentos
* -----------------------*/

// ACF Fields
$segmentos_title = get_field("home-segmentos");

// Argumentos para criar uma query de "Conteúdo Home" custom posts
// e aplicando somente posts com a taxonomia "Home Seguimentos"
$home_seguimentos_args = array(
	"post_type"	=> "home",
	"orderby"	=> "modified",
	"tax_query"	=> array(array( "taxonomy" => "home-categorias", "field" => "slug", "terms" => "home-seguimentos"))
);
// Aplicando argumentos
$home_seguimentos_query = new WP_Query( $home_seguimentos_args );

/*--------------------------
* Cases
* -----------------------*/

// ACF Fields
$post_title = get_field("home-post-title");
$category = get_field("home-cat");

// Utilizando a categoria digitada no ACF e obtendo o ID
$cat = get_cat_ID("$category");

// Obtendo o link da categoria
$cat_link = get_category_link($cat);

// Criando os argumentos dos posts de determinada categoria
// e aplicando o ID da categoria como parametro
$home_posts_args = array(
	"post_type"	=> "post",
	"posts_per_page"	=> 4,
	"cat"	=> "$cat"
);
// Aplicando argumentos
$home_posts_query = new WP_Query( $home_posts_args );


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="home">
				<section id="home-banner">
					<div class="home-banner-wrapper">
						<ul class="home-banner">
					<?php
						// Criando Loop para gerar os banners.
						while($home_banner_query->have_posts()): $home_banner_query->the_post();
						
							// Criando variável para checar existência de link
							$link = get_field("home-banner-link"); ?>
						
						<li>
							<?php the_post_thumbnail("full"); ?>
							<div class="home-banner-content-box">
								
								<?php // Checando se existe Link ou não
								if($link == "true") : 
										
										// Caso exista o link, buscar esses outros campos
										$url = get_field("home-banner-url");
										$title = get_field("home-banner-title");
										$target = get_field("home-banner-target"); ?>
									
									<a href="<?php echo $url; ?>" title="<?php echo $title; ?>" target="<?php echo $target; ?>">
										<?php the_title("<h2>","</h2>");
										the_content(); ?>
									</a>
									
								<?php else :
									
									// Caso não haja link, pegar apenas título e conteúdo
									the_title("<h2>","</h2>");
									the_content();
									
								// Encerrando o IF
								endif; ?>
								
							</div>
						</li>
						
						<?php 
						// Final do Loop dos Banners
						endwhile;
					?>
						</ul>
						<div id="home-pager" class="hidden-sm hidden-xs">	
							<?php
								// Utilizando novamente o Loop para criar o carrossel de thumbnails
								// que controlará os banners
								//-----------------------------------------------------------------------
								// Criando um número para aplicar no "data-slide-index" de cada thumbnail
								$slide_index = 0;
								// Começando o Loop
								while($home_banner_query->have_posts()): $home_banner_query->the_post(); ?>
									<a data-slide-index="<?php echo $slide_index; ?>" href=""><?php the_post_thumbnail("medium"); ?></a>
								<?php 
								// Interando a variável (mundando número do "data-slide-index").
								$slide_index++;
								// Final do Loop
								endwhile;
								wp_reset_postdata();
							?>
						</div>
					</div>
				</section>
				
				<section id="home-seguimentos">
					<div class="section-title">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<h3><?php echo $segmentos_title; ?></h3>
								</div>
							</div>
						</div>	
					</div>
					<div class="home-seguimentos-wrapper">
						<div class="seguimentos-slider">
							
							<?php
								// Criando Loop para exibir seguimentos de atuação
								while($home_seguimentos_query->have_posts()): $home_seguimentos_query->the_post(); ?>
								
									<div class="slider-item">
										<div class="container">
											<div class="row">
												<div class="col-md-12 slabo">
													<?php the_title("<h4 class='open mini-title'>", "</h4>");
													the_content(); ?>
												</div>
												<div class="col-md-12">
													<?php the_post_thumbnail("full"); ?>
												</div>
											</div>
										</div>
									</div>
								
								<?php // Fim do Loop
								endwhile;
								wp_reset_postdata();
							?>
							
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<?php
										// Controle para avançar ou retroceder nos seguimentos
									?>
									<div class="custom-controls seguimentos">
										<span class="seg-prev" href></span>
										<span class="seg-next" href></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				
				<section id="home-posts">
					<div class="container">
						<div class="home-posts-wrapper text-center">
							<div class="row">
								<div class="col-md-12">	
									<div class="section-title">
										<h3><?php echo $post_title; ?></h3>
									</div>
								</div>
								<div class="col-md-offset-2 col-md-8">
									<?php
										// Criando post com a query de posts criada
										while($home_posts_query->have_posts()): $home_posts_query->the_post(); ?>
										
											<div class="home-post-box text-left">
												<div class="row">
													<div class="col-sm-4 text-right hidden-xs">
														<?php the_post_thumbnail("thumbnail"); ?>
													</div>
													<div class="col-sm-8 slabo">
														<?php
															the_title("<h4 class='open mini-title'><a href='".get_the_permalink()."' title='".get_the_title()."'>", "</a></h4>");
															the_excerpt();
														?>
													</div>
												</div>
												<a href="<?php the_permalink(); ?>" title="Continuar Lendo"  class="read-more hidden-xs">Ler Mais</a>
											</div>
										
										<?php
										// Fim do Loop
										endwhile;
										wp_reset_postdata();
									?>
								</div>
							</div>
							<a class="supri-btn" href="<?php echo $cat_link; ?>" title="Ver Todos">Ver todos</a>
						</div>
					</div>
				</section>
				
				<?php get_template_part( 'template-parts/content', 'clients' ); ?>
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
