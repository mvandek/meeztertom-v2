<?php
/**
 * The Template for displaying all single posts.
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php // Controle of de gebruiker is ingelogd. ?>
			<?php if ( is_user_logged_in() ) { ?>

				<?php // Controle of de gebruiker de mogelijkheid 'view_vlog' bezit. ?>
				<?php if ( current_user_can( 'view_vlog' ) ) { ?>
					<?php get_template_part( 'content', 'vlogs' ); ?>

				<?php // Anders wordt een melding gegeven dat er geen toestemming is om het te bekijken. ?>
				<?php } else { ?>
					<?php get_template_part( 'members/content', 'no-access' ); ?>
				<?php } ?>

			<?php // In alle overige situaties, geef aan dat er ingelogd moet worden. ?>
			<?php } else { ?>
				<?php get_template_part( 'members/content', 'must-login' ); ?>
			<?php } ?>

			<?php radiate_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( current_user_can( 'view_vlog' ) && ( comments_open() || '0' != get_comments_number() ) ) {
					comments_template();
				}
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>