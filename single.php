<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Grupo_Supricel
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<section class="banner post">
			  <!-- Empty -->
			</section>
			
			<section id="single-post">
				<div class="container">
					<div class="row">
						<div class="col-sm-2 hidden-xs">
							<?php get_sidebar(); ?>
						</div>
						<div class="col-sm-offset-1 col-sm-8">
								<?php
									while ( have_posts() ) : the_post();
										
										get_template_part( 'template-parts/content', get_post_format() ); ?>
										
										<div class="pagination-wrapper">
											<h3>Outras Publicações</h3>
											<?php the_post_navigation( array( "in_same_term" => true ) ); ?>
										</div>
									
									<?php endwhile; // End of the loop.
								?>
						</div>
					</div>
				</div>
			</section>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
