<?php
//adds featured images to posts and pages
add_theme_support('post-thumbnails');

//custom body background
add_theme_support('custom-background');

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


//no close php