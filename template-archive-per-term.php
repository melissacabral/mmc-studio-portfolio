<?php 
/* 
Template Name: Post thumbnails by taxonomy term
*/
//edit these to match the stuff you registered in your custom post type plugin
$post_type = 'work';
$taxonomy = 'work_category'; ?>

<?php get_header(); ?>

<main class="content">
    <?php         

// Gets every term in this taxonomy
    $terms = get_terms( $taxonomy );

//go through each term in this taxonomy one at a time
    foreach( $terms as $term ) : 

    //get ONE post assigned to this term
        $custom_loop = new WP_Query( array(
            'post_type' => $post_type,
            'taxonomy' => $taxonomy,
            'term' => $term->slug,
        ) );

    //LOOP
        if( $custom_loop->have_posts() ): ?>
            <section class="container">
                <h1><?php echo $term->name; ?></h1>

                <div class="grid">
                <?php
                while( $custom_loop->have_posts() ) : $custom_loop->the_post(); ?>
                    <article>                  
                        <a href="<?php the_permalink(); ?>">
                             <?php the_post_thumbnail('thumbnail', array('class' => 'item')); ?>
                        </a>                   
                    </article>

                <?php endwhile; ?>
                </div> <!-- end .grid -->
            </section>
       <?php endif;
    endforeach;
    ?>
</main>
<?php get_footer() ?>