<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Grupo_Supricel
 */
 
// Utilizando o thumbnail da página como banner
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, "full", true);

get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<section class="banner" style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center">
			<!-- Empty -->
		</section>
		
		<section id="grupo" class="single-page-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php
							while(have_posts()): the_post();
								the_content();
							endwhile;
						?>
					</div>
				</div>
			</div>
		</section>
		
	</main>
</div>

<?php get_footer(); ?>
