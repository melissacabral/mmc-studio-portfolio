<?php
//adds featured images to posts and pages
add_theme_support('post-thumbnails');

//custom body background
add_theme_support('custom-background');

//improve RSS feeds
add_theme_support( 'automatic-feed-links' );

//custom header. 
//dev: don't forget to display your header in header.php
$args = array(
	'height' 		=> 400,
	'width' 		=> 1600,
	'flex-width' 	=> true,
	'flex-height' 	=> true,
);
add_theme_support('custom-header', $args);

//custom logo. 
//dev: don't forget to display the logo (header?)
$args = array(
	'height' => 200,
	'width' => 200,
	'flex-height' => true,
);
add_theme_support('custom-logo', $args);

//SEO friendly titles. 
//dev: make sure you remove the <title> from header.php
add_theme_support('title-tag');

//upgrade the markup of basic components to HTML5
add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));

//post formats. only use this if you have a blog
add_theme_support('post-formats', array('quote', 'link', 'gallery'));

//custom image size for the portfolio
//				name, width, height, crop?
add_image_size( 'banner', 1000, 300, true );

/**
 * displays the featured image of the post with a container and link to single
 * @return mixed html output
 */
function studio_featured_image( $size = 'medium' ){
	if( has_post_thumbnail() ){ ?>
		<div class="featured-image-container">
			<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( $size ); ?>
			</a>
		</div>
	<?php 
	} //end if has post thumbnail
}

/**
 * Introduction to using hooks: Customize the excerpt
 */
add_filter( 'excerpt_length', 'studio_excerpt_length' );
function studio_excerpt_length(){
	if( is_search() OR is_category() ){
		return 10; //words
	}else{
		return 75; //words
	}	
}
add_filter( 'excerpt_more', 'studio_excerpt_more' );
function studio_excerpt_more(){
	$link = get_the_permalink();
	return "&hellip; <a href='$link' class='button'>Read More</a>";
}


/*
example action hook - wp_footer
*/
add_action( 'wp_footer', 'studio_copyright', 999 );
function studio_copyright(){
	echo '&copy; 2022 Studio Theme <br>';
}

add_action( 'wp_footer', 'another_footer_thing', 1 );
function another_footer_thing(){
	echo 'this is the second hooked thingy <br>';
}

add_action( 'wp_footer', 'last_footer_thing' );
function last_footer_thing(){
	echo 'this is the third hooked thingy <br>';
}

/*
 unhook example 
*/
add_action('after_setup_theme', 'studio_unhook');
function studio_unhook(){
	remove_action( 'wp_footer', 'another_footer_thing', 1 );
	remove_action( 'wp_footer', 'studio_copyright', 999 );
}

/**
 * attach any needed CSS or JS using enqueue system
 * example: Improve the UX when replying to comments
 * example: load style.css of this theme
 */
add_action( 'wp_enqueue_scripts', 'studio_scripts' );
function studio_scripts(){
	//this script is built-into wordpress
	if( is_singular() AND comments_open() ){
		wp_enqueue_script( 'comment-reply' );
	}
	//get the theme info so we can use the version
	$theme = wp_get_theme();
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() , array() , $theme->get('Version')  );	
}

/**
 * Menu Areas - this code unlocks the menus admin area
 */
add_action( 'init' , 'studio_menu_areas' );
function studio_menu_areas(){
	register_nav_menus( array(
		'main_nav' => 'Main Navigation',
		'utilities'	=> 'Utility Area',
	) );
}

/*
Fallback Callback for the utility menu
*/
function studio_menu_default(){
	echo 'Choose a Utility Menu in the admin panel';
}

/**
 * Pagination function that can work on any template
 */
function studio_pagination(){
	echo '<div class="pagination">';
	if( is_singular() ){
		previous_post_link('%link', '&larr; %title');
		next_post_link('%link', '%title &rarr;');
	}else{
		//archive pagination 
		//if mobile, do next/previous buttons
		if( wp_is_mobile() ){
			previous_posts_link( '&larr; Previous' );
			next_posts_link( 'Next &rarr;' );
		}else{
			//desktop - numbered pagination
			the_posts_pagination(array(
				'prev_text' => '&larr; Previous',
				'next_text' => 'Next &rarr;',
				'mid_size' => 3,
			));
		}
		
	}
	echo '</div>';
}

/**
 * Register all widget areas
 */
add_action( 'widgets_init', 'studio_widget_areas' );
function studio_widget_areas(){
	//set up one widget area
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id'			=> 'blog_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id'			=> 'footer_area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Footer Area',
		'id'			=> 'home_footer_area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
}



/**
 * 	Change how comments are counted 
 * 	- only count real comments, not trackbacks
 */
add_filter( 'get_comments_number', 'studio_comments_number');
function studio_comments_number(){
	//the post we're counting comments on
	global $id; 

	$comments = get_approved_comments( $id );
	$count = 0;
	foreach( $comments AS $comment ){
		if( $comment->comment_type == 'comment' ){
			$count ++;
		}
	}
	return $count;
}

/**
 * Count Just the pingbacks and trackbacks
 * @return mixed 0 if no pings, otherwise return the count with grammar
 */
function studio_pings_number(){
	global $id; 
	$comments = get_approved_comments( $id );
	$count = 0;
	foreach( $comments AS $comment ){
		if( $comment->comment_type != 'comment' ){
			$count ++;
		}
	}
	if( $count == 0 ){
		return 0;
	}else{
		return $count == 1 ? 'One site mentions' : "$count sites mention";
	}
}

/**
 * pagination for comment lists
 */
function studio_comments_pagination(){
	//if pagination is needed, show it
	if( get_option( 'page_comments' ) ){
		?>
		<section class="comment-pagination pagination">
			<?php 
			previous_comments_link();
			next_comments_link();
			?>
		</section>
		<?php
	}
}

add_action('init', function() {
	remove_theme_support('core-block-patterns');
});

//no close php