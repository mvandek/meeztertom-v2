<?php
/**
 * The template used for displaying vlog content in single-vlogs.php
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() && !is_singular() ) : ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'featured-image-medium' ); ?></a>
		<?php endif; ?>

	<header class="entry-header">
		<?php if( !is_singular() ) { ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php } else { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>

	<?php if( is_singular() ) { ?>
		<div class="entry-meta">
		<?php radiate_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php } ?>

	</header><!-- .entry-header -->

	<?php if( is_singular() ) { ?>
		<div class="entry-content">
		<?php the_content(); ?>
		</div><!-- .entry-content -->
	<?php } ?>

	<footer class="entry-meta">

		<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'radiate' ), __( '1 Comment', 'radiate' ), __( '% Comments', 'radiate' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'radiate' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->