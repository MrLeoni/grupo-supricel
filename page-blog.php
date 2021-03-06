<?php
/**
 * Template Name: Blog
 */
 
// Utilizando o thumbnail da página como banner
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, "full", true);

/**------------------------------------------------
* Criando uma Query na qual o usuário, através de
* um campo gerado pelo ACF Fields, escolhe os posts
* que serão mostrados na página através da categoria
-------------------------------------------------*/

// Campo que o usuário inseriu a categoria
$cat = get_field("blog-cat");
// Pegando o ID da categoria escolhida pelo usuário
$cat_ID = get_cat_ID("$cat");
// Criando paginação, caso exista
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// Argumentos da Query de posts
$blog_args = array(
	"cat"	=> "$cat_ID", /* Aplicando ID da categoria escolhida pelo usuário */
	"paged"	=> $paged,
);
// Aplicando argumentos
$blog_query = new WP_Query( $blog_args );

get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section class="banner" style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center">
		  <!-- Empty -->
		</section>
		
		<section id="blog">
			<div class="section-title">
				<h1><?php echo get_the_title(); ?></h1>	
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-offset-1 col-md-10">
					
						<?php 
							// Criando variável para saber o número do post
							// se for o primeiro post da fila, o layout dele será diferente
							$number = 0;
							// Criando Loop para exibir posts
							while($blog_query->have_posts()): $blog_query->the_post();
								
								// Checando posição do post na fila
								// sempre renderizar primeiro post de
								// forma diferente
								if($number === 0 && !is_paged()) { ?>
									
									<div class="col-md-12">
										<div class="post-destaque">
											<div class="thumbnail-box">
												<?php the_post_thumbnail("full"); ?>
											</div>
											<div class="content-box slabo">
												<?php the_title("<h2><a href='".get_the_permalink()."' title='".get_the_title()."'>", "</a></h2>");
												the_excerpt(); ?>
											</div>
											<a href="<?php the_permalink(); ?>" title="Continuar Lendo"  class="read-more">Continuar Lendo</a>
										</div>
									</div>
									
								<?php } else { ?>
								
								<div class="col-md-6">
									<div class="post-normal">
										<div class="thumbnail-box">
											<?php the_post_thumbnail("medium"); ?>
										</div>
										<div class="content-box slabo">
											<?php the_title("<h4><a href='".get_the_permalink()."' title='".get_the_title()."'>", "</a></h4>");
											the_excerpt(); ?>
										</div>
										<a href="<?php the_permalink(); ?>" title="Continuar Lendo"  class="read-more">Continuar Lendo</a>
									</div>
								</div>
									
							<?php	} // Fim do If
							// Iterando variável
							$number++;
							// Fim do Loop
							endwhile;
							wp_reset_postdata();
						?>
						
						<div class="col-md-12">
							<nav class="pagination-wrapper clearfix">
						    <div class="prev posts-link">
						      <?php echo get_next_posts_link( 'Publicações antigas >', $blog_query->max_num_pages ); ?>
						    </div>
						    <div class="next posts-link">
						      <?php echo get_previous_posts_link( '< Publicações novas' ); ?>
						    </div>
						  </nav>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<?php get_template_part( 'template-parts/content', 'carrossel' ); ?>
		
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();