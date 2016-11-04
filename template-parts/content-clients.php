<?php
/*--------------------------
* Clientes
* -----------------------*/

// Argumentos para criar uma query de "Conteúdo Home" custom posts
// e aplicando somente posts com a taxonomia "Home Seguimentos"
$home_clients_args = array(
	"post_type"	=> "home",
	"orderby"	=> "modified",
	"tax_query"	=> array(array( "taxonomy" => "home-categorias", "field" => "slug", "terms" => "home-clientes"))
);
// Aplicando argumentos
$home_clients_query = new WP_Query( $home_clients_args );
?>

<section id="home-clients-slider">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-10">
				<div class="home-clients-slider-wrapper">
					<ul class="home-clients">
						
						<?php
							while($home_clients_query->have_posts()): $home_clients_query->the_post(); ?>
								<li><?php the_post_thumbnail("medium"); ?></li>
							<?php endwhile;
						?>
						
					</ul>
					<?php
						// Controle para avançar ou retroceder nos clientes
					?>
					<div class="custom-controls clients">
						<span class="clients-prev" href></span>
						<span class="clients-next" href></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>