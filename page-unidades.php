<?php
/**
 * Template Name: Unidades
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
		
		<section id="unidades">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php get_template_part( 'template-parts/content', 'brasil' ); ?>
					</div>
				</div>
			</div>
			<div class="follow-box"></div>
		</section>
		
	</main>
</div>

<?php get_footer(); ?>