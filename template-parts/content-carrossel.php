<?php
/**----------------------------------------
* Tempalte para exibir Carrosséis
* 
* Vamos utilizar uma Custom Query padrão 
* para pegar posts do tipo "Carrossel" e
* disponibiliza-los na página desejada
* 
* A variável, para trocar o conteúdo do 
* carrossel, é o campo "terms" dentro do
* parámetro "tax_query". Onde o usuário
* coloca o slug desejado.
* ---------------------------------------*/

// Pegando termo slug através do ACF Fields
$carrossel_slug = get_field("carrossel-slug");
// Argumentos para a Query
$home_clients_args = array(
	"post_type"	=> "carrossel",
	"orderby"	=> "modified",
	"posts_per_page"	=> 99,
	"tax_query"	=> array(array( "taxonomy" => "carrossel-categorias", "field" => "slug", "terms" => "$carrossel_slug"/* Aplicando o slug escolhido */))
);
// Aplicando argumentos
$home_clients_query = new WP_Query( $home_clients_args );

// Exibir conteúdo apenas se existir algum conteúdo
// um pouco óbvio, não? :)
if($home_clients_query->have_posts()) {
	
?>

<section id="carrossel">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-10">
				<div class="carrossel-wrapper">
					<ul class="carrossel-default">
						
						<?php
							// Loop para disponibilziar o conteúdo da Query que foi criada
							while($home_clients_query->have_posts()): $home_clients_query->the_post(); 
								
								// Utilizando o tamanho de thumbnail "medium" por motivos de consistência
								// e para criar um tamamnho padrão
								?>
								<li><?php the_post_thumbnail("medium"); ?></li>
								
							<?php // Fim do Loop
							endwhile;
							wp_reset_postdata();
						?>
						
					</ul>
					<?php // Controle para avançar ou retroceder nos clientes	?>
					<div class="carrossel-control">
						<span class="ctrl-prev" href></span>
						<span class="ctrl-next" href></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	}  // Fim do IF
?>