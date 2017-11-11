<?php
/**
 * The template used for displaying page content in single.php
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php radiate_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p>Helaas, om dit te kunnen bekijken moet je <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login op MeezterTom.nl">inloggen</a>.</p>
	</div><!-- .entry-content -->

</article><!-- #post-## -->