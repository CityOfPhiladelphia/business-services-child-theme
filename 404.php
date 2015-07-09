<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

	<div class="page-not-found-container container">
		<div class="gdlr-item page-not-found-item">
			<div class="page-not-found-block">
				<div class="page-not-found-caption">
					<?php echo 'The page you were looking for may have been moved. <br> Try a keyword search or <a href="/index.php">go to the homepage</a>.' ?>
				</div>
				<div class="page-not-found-search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
