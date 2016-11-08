<?php
/**
 * Template Name: Grupo
 */
 
// Utilizando o thumbnail da página como banner
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, "full", true);

/**--------------------------------------------------------------
 * 
 * Utilizando ACF Field para obter conteúdo adicional dentro da 
 * página de edição. O usuário escolherá se deseja ou não exibir
 * conteúdo extra
 * 
 * -------------------------------------------------------------*/
 
// Retorna true or false para box com borda no final do texto
$border_check = get_field("border-boolean");
// Retorna o conteúdo criado pelo usuário
$border_content = get_field("border-content");

// Retorna true or false para imagem ao lado do texto
$img_check = get_field("img-boolean");
// Retorna o conteúdo criado pelo usuário
$img_content = get_field("img-content");

get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<section class="banner" style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center">
			<!-- Empty -->
		</section>
		
		<section id="grupo" class="single-page-content">
			<div class="container">
				<div class="row">
					
					<?php // Se a imagem existir, renderizar esse bloco HTML
					if($img_check == "true") { ?>
					
					<div class="col-md-4">
						<div class="side-img">
							<img src="<?php echo $img_content["url"]; ?>" alt="<?php echo $img_content["alt"]; ?>">
						</div>
					</div>
					<div class="col-md-8">
						<?php
							while(have_posts()): the_post();
								the_content();
							endwhile;
						?>
					</div>
					
					<?php } // Se não existir, renderizar esse bloco HTML
					else { ?>
					
					<div class="col-md-12">
						<?php
							while(have_posts()): the_post();
								the_content();
							endwhile;
						?>
					</div>
					
					<?php } ?>
					
				</div>
				
				<?php if($border_check == "true") { ?>
				<div class="row">
					<div class="col-md-12">
						<div class="bordered-box">
							<?php echo $border_content; ?>
						</div>
					</div>
				</div>
				<?php } ?>
				
			</div>
		</section>
		
	</main>
</div>

<?php get_footer(); ?>