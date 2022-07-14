<?php 
/**
 * Comments Template
 * ====
 * This file shows the comments list, comment form and sites that mention this post. 
 * Display this file by calling comments_template() in your singular template files 
 */

//end this file if the password hasn't been entered yet
if( post_password_required() ){
	return;
}	
?>
<section class="comments">
	<h3>
		<?php 
		comments_number();
		_e( ' on this post', 'mmc-studio-portfolio' );
		 ?> 
		<?php if( comments_open() ){ ?>
		<a class="button" href="#respond">
			<?php _e( ' Leave a Comment', 'mmc-studio-portfolio' ); ?>	
		</a>
		<?php } ?>
	</h3>

	<ol class="comments-list">
		<?php wp_list_comments( array(
			'type' 			=> 'comment',
			'avatar_size' 	=> 50,
		) ); ?>
	</ol>

	<?php studio_comments_pagination(); ?>

</section>

<section class="comment-form">
	<?php comment_form(); ?>
</section>

<?php 
$mentions = studio_pings_number();
if( $mentions ){
?>
<section class="mentions">
	<h3>
	<?php 
	echo $mentions; 
	_e( ' this post', 'mmc-studio-portfolio' );
	?> 
	</h3>
	<ol class="pings-list">
		<?php wp_list_comments( array(
			'type' 			=> 'pings', //trackbacks and pingbacks
			'short_ping' 	=> true,
		) ); ?>
	</ol>
</section>
<?php } //end mentions ?>