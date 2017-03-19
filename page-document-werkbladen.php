<?php
/**
 * Template Name: Werkbladen
 *
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">

<?php
$document_args = array(
    'post_type' => 'attachment',
    'post_mime_type' =>'application/pdf',
    'post_status' => 'inherit',
    'tax_query' => array(
        array(
            'taxonomy' => 'document',
            'field'    => 'term_id',
            'terms'    => 48,
        ),
    ),

);
$document_query = new WP_Query( $document_args );

if( $document_query->have_posts() ) { ?>
<ul>
<?php while ( $document_query->have_posts() ) {
$document_query->the_post();
printf( '<li><a href="%1$s" rel="bookmark">%2$s</a></li>', esc_url( wp_get_attachment_url() ), get_the_title() );
}
?>
</ul>
<?php } else { ?>
<p><?php _e( 'Er zijn geen documenten beschikbaar', 'mvdk' ); ?></p>
<?php }
wp_reset_postdata();
?>

			</div><!-- .entry-content -->
		<?php edit_post_link( __( 'Edit', 'radiate' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>