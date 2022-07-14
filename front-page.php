<?php get_header(); //requires header.php ?>
<main class="content">
	<?php 
	//The Loop
	if( have_posts() ){
		while( have_posts() ){ 
			the_post();
			the_content(); //full
		} //end while 

	}else{
		echo 'Sorry, No Posts.';
	} //end The Loop
	?>
</main>
<!-- end .content -->

<?php get_footer('home'); //requires footer-home.php ?>  