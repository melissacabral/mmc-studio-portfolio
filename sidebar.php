<aside class="sidebar">
    <?php 
    //show a widget area if it contains widgets
    if( dynamic_sidebar( 'blog_sidebar' ) ){ 
        //fallback in case there are no widgets in that widget area:
    ?>

    <section id="categories" class="widget">
        <h3 class="widget-title">Categories</h3>
        <ul>
            <?php 
            //get the most common 15 categories
            wp_list_categories( array(
                'show_count'    => true,
                'title_li'      => '',
                'order'         => 'DESC',
                'orderby'       => 'count',
                'number'        => 15,
            ) ); ?>
        </ul>
    </section>
    <section id="archives" class="widget">
        <h3 class="widget-title">Archives</h3>
        <ul>
            <?php 
            //show yearly archives
            wp_get_archives( array(
                'type' => 'yearly',
                'show_post_count' => true,
            ) ); ?>
        </ul>
    </section>
    <section id="tags" class="widget">
        <h3 class="widget-title">Tags</h3>
        <?php wp_tag_cloud( array(
            'format'    => 'list',
            'smallest'  => 1,
            'largest'   => 1,
            'unit'      => 'em',
            'show_count' => 1,
            'orderby'   => 'count',
            'order'     => 'DESC',
            'number'    => 15,
        ) ); ?>
    </section>
    <section id="meta" class="widget">
        <h3 class="widget-title">Meta</h3>
        <ul>
            <?php wp_register(); //link to admin or register form or nothing ?>
            <li><?php wp_loginout(); ?></li>
        </ul>
    </section>
    <?php } //end if dynamic sidebar ?>
</aside>
<!-- end .sidebar -->