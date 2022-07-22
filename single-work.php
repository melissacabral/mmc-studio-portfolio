<?php get_header(); //requires header.php ?>
<main class="content">
	<?php 
//The Loop
	if( have_posts() ){
		while( have_posts() ){ 
			the_post();
	?>
		<article <?php post_class(); ?>>
			<div class="cover-image">
					
						<?php the_post_thumbnail( 'banner' ); ?>						
					
					<div class="info">						
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php 
					//show the categories for THIS post
						the_terms( $id, 'work_category', '<h3>', ', ', '</h3>' ); 
						?>
					</div>


				</div>
			<div class="entry-content">
				<?php the_field('year'); ?>

				<?php 
				//acf conditional
				$client = get_field('client');
				if($client){
					echo "<h4>$client</h4>";
				} ?>

				<?php 
				//native custom field output
				$client = get_post_meta( $id, 'client', true );
				if($client){
					echo "<h4>$client</h4>";
				} ?>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
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