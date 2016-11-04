<?php
/**
 * Template Name: Contato
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
		
		<section id="contact">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php
							while(have_posts()): the_post();
								the_content();
							endwhile;
						?>
					</div>
					<div class="col-md-6">
						<div class="contact-map-box">
							<iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Rua%20Luis%20Silveira%20Pedreira%2C%20100&key=AIzaSyCHOQP_b4S5a2akoafsPXoky728zyAVjSM" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();