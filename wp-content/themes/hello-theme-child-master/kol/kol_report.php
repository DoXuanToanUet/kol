<?php 
    $current_user = wp_get_current_user();
    // var_dump($current_user->ID);
    $args = array(
        'post_type' => 'shop_coupon',
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'DATE',
        'posts_per_page' => -1 ,
        'meta_key'       => 'wcu_select_coupon_user',
        'meta_value'     => $current_user->ID,
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'project_cat',
        //         'field' => 'term_id',
        //         'terms' => $cat,
        //     )
        // ),
    );
    $report = new WP_Query($args);
    $numcoupons = $report->post_count;
    // var_dump($numcoupons);
    if ( $report->have_posts() ) : while ( $report->have_posts() ) :$report->the_post();
        $usage = get_post_meta( get_the_ID(), 'usage_count', true );
        // $meta = get_post_meta( get_the_ID() );
        // echo "<pre>";
        // var_dump($meta);
        // echo "</pre>";
        ?>
            <p><?php the_title();?></p>
            <p>Số lượt click- <?php echo $usage;?></p>
        <?php
    endwhile; wp_reset_postdata();  endif;