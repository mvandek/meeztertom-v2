<?php
/**
 * Template Name: Login + standaardpagina
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

					<?php if ( is_user_logged_in() ) { ?>
						<?php get_template_part( 'content', 'page' ); ?>
					<?php } else { ?>
						<?php get_template_part( 'members/content', 'login-form' ); ?>
					<?php } ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
