<?php
/**
 * The template for displaying 404 pages (not found).
 *
 */

get_header(); ?>

<?php 
// Theme Init
$theme_init = new cryptic_init_class;
if($theme_init->cryptic_get_page_404_template_variant() == 'page_404_v1_center'){
	$alignment = 'text-center';
	$grid_class = 'col-md-12';
}elseif ($theme_init->cryptic_get_page_404_template_variant() == 'page_404_v2_left') {
	$alignment = 'text-left';
	$grid_class = 'col-md-9';
}
?>

	<!-- Page content -->
	<div id="primary" class="content-area">
	    <main id="main" class="container blog-posts site-main">
	        <div class="col-md-12 main-content">
				<section class="error-404 not-found">
					<header class="page-header-404">
						<div class="high-padding row">
							<div class="<?php echo esc_attr($grid_class); ?>">
								<h1 class="page-404-digits <?php echo esc_attr($alignment); ?>"><?php esc_html_e( '404', 'cryptic' ); ?></h1>
								<h2 class="page-title <?php echo esc_attr($alignment); ?>"><?php esc_html_e( 'Sorry, this page does not exist', 'cryptic' ); ?></h2>
								<h3 class="page-title <?php echo esc_attr($alignment); ?>"><?php esc_html_e( 'The link you clicked might be corrupted, or the page may have been removed.', 'cryptic' ); ?></h3>
							</div>
							<?php if($theme_init->cryptic_get_page_404_template_variant() == 'page_404_v2_left'){ ?>
								<div class="col-md-3 sidebar-content">
									<?php get_sidebar(); ?>
								</div>
							<?php } ?>
						</div>
					</header>
				</section>
			</div>
		</main>
	</div>

<?php get_footer(); ?>