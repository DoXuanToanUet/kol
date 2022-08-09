<?php 
add_action('wp_ajax_kol_select', 'kol_select');
add_action('wp_ajax_nopriv_kol_select', 'kol_select');

function kol_select(){
    $err = '';
    $success = '';
    $kol_select = isset($_POST['kol_select']) ? $_POST['kol_select'] : '';
    $current_user = wp_get_current_user();
    update_field('koc_select', $_POST['kol_select'],'user_' . $current_user->ID);

            
    $success = 'Cập nhập thành công';
    wp_send_json_success(array(
        "message"=>"success",
        "showdata"=> $success,
        'class'=>'success'
    ));   
    die();     
       
}
