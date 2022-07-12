<?php get_header(); //requires header.php ?>
<main class="content">
	<?php 
//The Loop
	if( have_posts() ){ ?>

	<h1>Category: <?php single_cat_title(); ?></h1>

	<?php while( have_posts() ){ 
			the_post();
	?>
		<article class="post">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="entry-content">
				<?php 
				//if this is a single post or page, show the full content
				if( is_singular() ){
					the_content(); //full
				}else{
					the_excerpt(); //teaser
				}
				?>
			</div>
			<div class="postmeta">
				<span class="author">by: <?php the_author_posts_link(); ?> </span>
				<span class="date"><?php the_date(); ?></span>
				<span class="num-comments"><?php comments_number(); ?></span>
				<span class="categories"><?php the_category(); ?></span>
				<span class="tags"><?php the_tags(); ?></span>
			</div>
			<!-- end .postmeta -->
		</article>
		<!-- end .post -->
	<?php
		} //end while 
	}else{
		echo 'Sorry, No Posts.';
	} //end The Loop

	?>
</main>
<!-- end .content -->


<?php get_sidebar(); // requires sidebar.php ?>
<?php get_footer(); //requires footer.php ?>  