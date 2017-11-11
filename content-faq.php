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

	<header class="entry-header">
		<?php if( !is_singular() ) { ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php } else { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>

	<?php if( is_singular() ) { ?>
		<div class="entry-meta">
<?php
$post_type = get_post_type();
foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
	$term_list = get_the_term_list( $post->ID, $tax_name, '', ' ', '' );
	if ( !empty( $term_list ) ) {
		$the_tax = get_taxonomy( $tax_name );
		?>
		<div class="taxonomy-<?php echo esc_attr( $tax_name ); ?> entry-terms">
			<?php echo wp_kses_post( $term_list ); ?>
		</div>
		<?php
	}
}
?>
		</div><!-- .entry-meta -->
	<?php } ?>

	</header><!-- .entry-header -->

	<?php if( is_singular() ) { ?>
		<div class="entry-content">
		<?php the_content(); ?>
		</div><!-- .entry-content -->
	<?php } ?>

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'radiate' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->