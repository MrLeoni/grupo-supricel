<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Grupo_Supricel
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<p>Postado em: <span><?php the_date(); ?></span></p>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content slabo">
		<div class="post-thumb-box">
			<?php the_post_thumbnail("full"); ?>
		</div>
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue lendo %s <span class="meta-nav">&rarr;</span>', 'grupo-supricel' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
