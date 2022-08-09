<?php 
// 1follows : >100.000 follows
// 2follows : 100.000 -500.000 follows
// 3follows : 1.000.000 -2.000.000 follows
/**
 * @snippet       WooCommerce Add New Tab @ My Account
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// ------------------
// 1. Register new endpoint (URL) for My Account page
// Note: Re-save Permalinks or it will give 404 error
add_filter ( 'woocommerce_account_menu_items', 'wptips_customize_account_menu_items' );
function wptips_customize_account_menu_items( $menu_items ){
 
    //unset( $menu_items['dashboard'] ); // Remove Dashboard from My Account Menu
    unset( $menu_items['orders'] ); // Remove Orders from My Account Menu
    unset( $menu_items['downloads'] ); // Remove Downloads from My Account Menu
    //unset( $menu_items['edit-account'] ); // Remove Account details from My Account Menu
    unset( $menu_items['payment-methods'] ); // Remove Payment Methods from My Account Menu
    //unset( $menu_items['edit-address'] ); // Addresses from My Account Menu
    //unset( $menu_items['customer-logout'] ); // Remove Logout link from My Account Menu
	return $menu_items;
}
function kol_add_info_support_endpoint() {
    add_rewrite_endpoint( 'info-support', EP_ROOT | EP_PAGES );
	flush_rewrite_rules();
}
  
add_action( 'init', 'kol_add_info_support_endpoint' );
  
// ------------------
// 2. Add new query var
  
function kol_info_query_vars( $vars ) {
    $vars[] = 'info-support';
    return $vars;
}
  
add_filter( 'query_vars', 'kol_info_query_vars', 0 );
  
// ------------------
// 3. Insert the new endpoint into the My Account menu
  
function kol_add_info_link_my_account( $items ) {
    $items['info-support'] = 'Thông tin thêm';
    return $items;
}
  
add_filter( 'woocommerce_account_menu_items', 'kol_add_info_link_my_account' );
  
// ------------------
// 4. Add content to the new tab
  
function kol_info_support_content() {
	if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$roles = ( array ) $current_user->roles;
		// echo "<pre>";
		// var_dump($current_user->ID);
		// echo "</pre>";
	}

	// Role is koc/kol
	if ( $roles[0] == 'kol_user' ){
		// $select_kol = get_field('koc_select','user_' . $current_user->ID);
        
		$kol_select = get_field_object( 'koc_select','user_'. $current_user->ID );
        if( $kol_select == true ){
            $kol_select = $kol_select;
        }else{
            $kol_select = get_field_object( 'koc_select');
        }
		$kol_select_value = $kol_select['value'];
		$kol_select_label = $kol_select['choices'];
        $field = get_field_object('koc_select', 'user_19');
		// echo "<pre>";
		// var_dump($kol_select);
		// echo "</pre>";
		// if (isset($_POST['updateInforUser'])) {
		// 	// update_row('koc_select',$_POST['userFirstName'] , 'user_' . $current_user->ID);
		// 	update_field('koc_select', $_POST['kol_select'],'user_' . $current_user->ID);
		// 	echo '<script language="javascript">';
		// 	echo '$(".alert").html("Cập nhập thành công ")';
		// 	echo '</script>';
		// }
		?>
			
			<form action="" id="formChangeProfile" method="post">
                <h5 class="account_kol_title">Thông tin về tài khoản</h5>
				<div class="form-info">
					<div class="box-input">
						<span>Chọn Kol/koc<span class="required">*</span></span>
						<select name="kol_select" id="kol_select">
							<option value="all">Lượng follow </option>
							<?php 
							
								foreach( $kol_select_label as $key=>$value):
									?> <option value="<?php echo $key;?>" <?php if( $kol_select_value == $value ) echo 'selected';?> ><?php echo $value;?></option><?php
								endforeach;
								// echo "<pre>";
								// var_dump(  $terms );
								// echo "</pre>";
							?>
						</select>
						
					</div>
					
				</div>
                <div class="kol_alert alert alert-success my-2" role="alert">
                    
                </div>
               <p></p>
				<div class="btn-save">
					<button type="submit" name="updateInforUser" class="btn btn-primary btn-submit"> Save</button>
				</div>
				<input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php');?>">
			</form>
			
		<?php
	} 
    // else if( $roles[0] == 'kol_user' ){

    // }

//    echo do_shortcode( ' /* your shortcode here */ ' );
}
  
add_action( 'woocommerce_account_info-support_endpoint', 'kol_info_support_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format