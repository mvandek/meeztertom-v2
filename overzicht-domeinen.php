<?php
/**
 * The template used for displaying page content in page.php
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
		<?php

			$depth	      = 2;
			$hide_empty   = 0;
			$taxonomy     = 'domein';
			$orderby      = 'name';
			$pad_counts   = 0;      // 1 for yes, 0 for no
			$title        = '';

			$args = array(
			  'depth'	 => $depth,
			  'hide_empty'   => $hide_empty,
			  'taxonomy'     => $taxonomy,
			  'orderby'      => $orderby,
			  'pad_counts'   => $pad_counts,
			  'title_li'     => $title,
			);
		?>

			<ul>
				<?php wp_list_categories( $args ); ?>
			</ul>

	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'radiate' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->