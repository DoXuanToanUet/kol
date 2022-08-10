
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/assets/plugin/xls/jquery.dataTables.min.css'; ?>">
<div class="kol-admin-report">

    <?php 
        $usercount = count_users();
        $result_usercount = $usercount['total_users']; 
        // echo "<pre>";
        // var_dump( $usercount['avail_roles'] );
        // echo "</pre>";
        
    ?>
    <div class="kol-user-manager">
        <p>User Manage</p>
        <div class="row g-3">
            <div class="col-3">
                <div class="user-manager p-3 text-center">
                    <p>Total</p>
                    <p><?= $result_usercount; ?></p>
                </div>  
            </div>
            <?php foreach( $usercount['avail_roles'] as $role => $count ) : global $wp_roles;  
                // echo "<pre>";
                // var_dump( $wp_roles->role_names );
                // echo "</pre>";
                $arr = [];
                foreach ( $wp_roles->role_names as $key => $value ){
                    array_push( $arr,$key );
                }
                if(  in_array (  $role, $arr ) ){
                    $role_name = $wp_roles->roles[$role]['name']; 
                } else{
                    $role_name = 'None';
                }
            ?>
                <div class="col-3">
                    <div class="user-manager p-3 text-center">
                        <p><?= $role_name; ?></p>
                        <p><?= $count; ?></p>
                    </div> 
                </div>
            <?php endforeach;   ?>
        
        </div>
    </div>
    <div class="kol-coupon-manager py-4">
        <p>User Coupon Manage</p>  
        <div class="row kol-tab d-flex g-3">
            <div class="col kol-tab-item common-tab active-tab" data-tab="kolTab">
                KOL/KOC <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="salemanTab">
                Saleman  <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="payTab">
                Thanh toán  <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="machineTab">
                Gia công  <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="successTab">
                Hoàn thành <span></span>
            </div>
            <div class="col kol-tab-item common-tab" data-tab="deliveryTab">
                Giao hàng <span></span>
            </div>
        </div>
        <div class="kol_tab-content-wrapper">
            <div class="kol-tab-content kolTab py-4">
                <?php 
                    $args_kol = array(
                        'role'    => 'kol_user',
                        'orderby' => 'user_nicename',
                        'order'   => 'ASC'
                    );
                    $users_kol = get_users( $args_kol );
                    
                    
                ?>
                <table id="table_kol_tab" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Coupon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach( $users_kol as $key=>$value ): 
                                // echo "<pre>";
                                // var_dump( $value);
                                // echo "</pre>";
                                $args_kol_coupon = array(
                                    'post_type' => 'shop_coupon',
                                    'post_status' => 'publish',
                                    'order' => 'DESC',
                                    'orderby' => 'DATE',
                                    'posts_per_page' => -1 ,
                                    'meta_key'       => 'wcu_select_coupon_user',
                                    'meta_value'     => $value->ID,
                                );
                                $report_kol_coupon = new WP_Query($args_kol_coupon);
                        ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td><?php echo $value->user_nicename; ?></td>
                                <td>
                                    <?php 
                                         if ( $report_kol_coupon->have_posts() ) : while ( $report_kol_coupon->have_posts() ) :$report_kol_coupon->the_post();
                                        global $wpdb;
                                        $table_name = $wpdb->prefix . 'wcusage_clicks';
                                        $id = get_the_id();
                                        $date1 = date("Y-m-d", strtotime('-30 days'));
                                        $date2 = date("Y-m-d", strtotime('+1 days'));
                                        // echo $date1;
                                        // echo "\n";
                                        // echo $date2;
                                        $result2 = $wpdb->get_results( 
                                            $wpdb->prepare(
                                                // "SELECT * from wp_my_books WHERE id = %d ",$book_id
                                                "SELECT * FROM " . $table_name . " WHERE date > '$date1' AND date < '$date2' AND couponid = %d",$id
                                            )
                                        );
                                        $clickcount = count($result2);
                                        // var_dump($clickcount);
                                         ?>
                                            <div >
                                                <span><?php the_title();?></span>
                                                <span>- <?php echo $clickcount;?></span>
                                            </div>
                                         <?php
                                        endwhile; wp_reset_postdata();  endif;
                                    ?>
                                </td>
                               
                            </tr>
                            
                        <?php $i++; endforeach; ?>   
                    </tbody>
                </table>
                <canvas id="bar-chart" width="800" height="450"></canvas>
                <script>
                    (function ($) {
                        $(document).ready(function () {
                            $("#table_kol_tab").DataTable();
                                new Chart(document.getElementById("bar-chart"), {
                                type: 'bar',
                                data: {
                                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                                datasets: [
                                    {
                                    label: "Population (millions)",
                                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                    data: [2478,5267,734,784,433]
                                    }
                                ]
                                },
                                options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Predicted world population (millions) in 2050'
                                }
                                }
                            });
                        })
                    })(jQuery);
                </script>
            </div>
            <div class="kol-tab-content salemanTab py-4">
                Saleman 
            </div>
        </div>
    </div>
</div>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/plugin/xls/jquery.dataTables.min.js'; ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/plugin//chart.min.js'; ?>"></script>