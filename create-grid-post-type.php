function wpb_catlist() { 
    $_terms = get_terms( array('weight_categories') );
                echo '<div class="post-main">';
	echo '<ul>';
    foreach ($_terms as $term) :
    
        $term_slug = $term->slug;
        $_posts = new WP_Query( array(
                    'post_type'         => 'weight',
                    'posts_per_page'    => 10, //important for a PHP memory limit warning
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'weight_categories',
                            'field'    => 'slug',
                            'terms'    => $term_slug,
                        ),
                    ),
                ));
    
        if( $_posts->have_posts() ) :
            while ( $_posts->have_posts() ) : $_posts->the_post();
            ?>
                    <li>
                        <div class="image-main">
                            <div class="bg-image">
                                <img decoding="async" src='<?php echo get_field('image', 'term_'.$term->term_id);?>' alt="">
                            </div>
                            <div class="text-image">
                                <p>Weight: <span><?php echo get_field('weight', 'term_'.$term->term_id);?></span></p>
                            </div>
                        </div>
                        <div class="text-div">
                            <h3><?php echo $term->name ?></h3>
                            <p><?php echo $term->description ?></p>
                            <div class="read-more"><a class="read-btn" href ='<?php the_permalink();?> '>Read More <span></span> </a></div>
                        </div>
                    </li>                
            <?php
            endwhile;
           
    
        endif;
        wp_reset_postdata();
    
    endforeach;
	 echo '</ul>';
	 echo '</div>';
    }
    add_shortcode('weight_categories', 'wpb_catlist');
