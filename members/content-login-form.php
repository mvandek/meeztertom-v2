<?php
/**
 * This will be shown after a referring page has checked that the user is not logged in, and has to be to see the content of the page.
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<p>Dit heeft MeezterTom afgeschermd van het internet. Je kan dit alleen bekijken door in te loggen met jouw account.</p>
		<?php wp_login_form(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->