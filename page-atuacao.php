<?php
/**
 * Template Name: Atuação
 */
 
// Utilizando o thumbnail da página como banner
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, "full", true);

// Obtendo campos ACF Fields
$side_text = get_field("side-text");
$side_img = get_field("side-img");
$side_bordered = get_field("side-bordered");

get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<section class="banner" style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center">
			<!-- Empty -->
		</section>
		
		<section id="atuacao" class="single-page-content">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="side-content">
							<?php 
							
							// Colocando elementos dentro de IFs. Se o elemento
							// não existir, nenhuma tag HTML é adicionada
							
							// Texto Superior
							if($side_text) { ?>
								<div class="atuacao-side-text">
									<?php echo $side_text; ?>
								</div>
							<?php	} 
							
							// Imagem
							if ($side_img) { ?>
							<div class="side-img">
								<img src="<?php echo $side_img["url"]; ?>" alt="<?php echo $side_text["alt"]; ?>">
							</div>
							<?php }
							
							// Texto com borda
							if($side_bordered) { ?>
							<div class="bordered-box">
								<?php echo $side_bordered; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-offset-1 col-md-7 atuacao-content-box">
						<?php while(have_posts()): the_post();
							the_content();
						endwhile; ?>
					</div>
				</div>
			</div>
		</section>
		
	</main>
</div>

<?php get_template_part( 'template-parts/content', 'carrossel' ); ?>

<?php get_footer(); ?>