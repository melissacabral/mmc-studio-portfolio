<?php get_header(); //requires header.php ?>
<main class="content">
	<h1 class="page-title">Portfolio</h1>

	<ul class="portfolio-submenu">
		<?php wp_list_categories( array(
			'title_li' => '',
			'taxonomy' => 'work_category',
		) ); ?>
	</ul>
	<?php 
//The Loop
	if( have_posts() ){
		while( have_posts() ){ 
			the_post();
	?>
		<article <?php post_class(); ?>>
			<div class="cover-image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'banner' ); ?>						
					</a>
					<div class="info">						
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php 
					//show the categories for THIS post
						the_terms( $id, 'work_category', '<h3>', ', ', '</h3>' ); 
						?>
					</div>
				</div>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
			
		</article>
		<!-- end .post -->		
	<?php
		} //end while 

		studio_pagination();

	}else{
		echo 'Sorry, No Posts.';
	} //end The Loop

	?>
</main>
<!-- end .content -->

<?php get_footer(); //requires footer.php ?>  