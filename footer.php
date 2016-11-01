<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Grupo_Supricel
 */
 
// Criando argumentos para exibir conteúdo criado na seção "Conteúdo Footer"
$footer_address_args = array(
	"post_type"	=> "footer",
	"orderby"	=> "modified",
);
// Aplicando argumentos
$footer_address_query = new WP_Query( $footer_address_args );

?>

			<footer id="footer">
				<div class="footer-wrapper">
					<div class="container">
						<div class="row">
							<div class="col-md-12 clearfix">
								<div class="footer-logo-box">
									<img class="logo-img" src="<?php bloginfo("stylesheet_directory"); ?>/assets/img/logo/grupo-supricel-logo.png" alt="Grupo Supricel">
								</div>
								<span class="footer-line hidden-xs"><!-- empty --></span>
							</div>
							
							<!-- Footer Content -->
							<div class="col-md-12">
								<div class="footer-content-box">
									<div class="row">
										
										<?php
											// Criando While Loop para exibir posts criados em "Conteúdo Footer"
											// Passando a query de posts que foi criada para exibir esses posts
											while($footer_address_query->have_posts()): $footer_address_query->the_post();
												
												// Criando uma variável para armazenar o slug da categoria que o post se encontra
												// e aplicando ela em um "IF" para gerar HTML em diferentes casos
												$term = wp_get_post_terms(get_the_ID(), "footer-categorias");
												$term_slug = $term[0]->slug;
												
												// Começo do IF
												if($term_slug == "footer-endereco") { ?>
													
													<div class="col-md-3 col-sm-6 footer-address">
														<?php the_title("<h4>", "</h4>");
														the_content(); ?>
													</div>
													
												<?php } // End IF
											endwhile; // End Loop
											wp_reset_postdata(); // Resetando Post Data
											
											// Criando While Loop para exibir posts criados em "Conteúdo Footer"
											// Passando a query de posts que foi criada para exibir esses posts
											while($footer_address_query->have_posts()): $footer_address_query->the_post();
												
												// Criando uma variável para armazenar o slug da categoria que o post se encontra
												// e aplicando ela em um "IF" para gerar HTML em diferentes casos
												$term = wp_get_post_terms(get_the_ID(), "footer-categorias");
												$term_slug = $term[0]->slug;
												
												// Começo do IF
												if($term_slug !== "footer-endereco") { ?>
													
													<div class="col-sm-12 footer-news">
														<?php the_content(); ?>
													</div>
													
												<?php } // End IF
											endwhile; // End Loop
											wp_reset_postdata(); // Resetando Post Data
										?>
										
										
									</div>
								</div>
							</div>
							<!-- Footer Content END-->
							
						</div>
					</div>
				</div>
				<div class="copy">
					<div class="container">
						<p>Supricel &copy; Direitos Reservados <span><a href="http://agenciadelucca.com.br" title="Agência Delucca" target="_blank">AD</a></span></p>
					</div>
				</div>	
			</footer>
			
		</div><!-- #page -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="<?php bloginfo("template_url"); ?>/js/jquery-1.12.4.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php bloginfo("template_url"); ?>/js/bootstrap.min.js"></script>
		<script src="<?php bloginfo("template_url"); ?>/js/jquery.bxslider.min.js"></script>
		<script src="<?php bloginfo("template_url"); ?>/js/main.js"></script>
	
	<?php wp_footer(); ?>
	
	</body>
</html>
