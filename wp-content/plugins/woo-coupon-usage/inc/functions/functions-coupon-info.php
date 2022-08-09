<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get info from the coupon based on coupon code
 *
 * @param string $coupon_code
 *
 * @return mixed
 *
 */
if( !function_exists( 'wcusage_get_coupon_info' ) ) {
	function wcusage_get_coupon_info($coupon_code) {

		try {

			$get_options = get_option( 'wcusage_options' );

			$coupon = new WC_Coupon($coupon_code);
			if($coupon) {
				$couponid = $coupon->get_id();

				$coupon_commission_percent = get_post_meta( $couponid, 'wcu_text_coupon_commission', true );
					if(!$coupon_commission_percent) { $coupon_commission_percent = wcusage_get_setting_value('wcusage_field_affiliate', '0'); }

				$coupon_user_id = get_post_meta( $couponid, 'wcu_select_coupon_user', true );

				return array($coupon_commission_percent, $coupon_user_id, $couponid);
			}

		} catch (Exception $e) {

			return "";

		}

	}
}
add_action('wcusage_hook_get_coupon_info', 'wcusage_get_coupon_info', 10, 1);

/**
 * Get info from the coupon based on ID
 *
 * @param string $couponid
 *
 * @return mixed
 *
 */
if( !function_exists( 'wcusage_get_coupon_info_by_id' ) ) {
	function wcusage_get_coupon_info_by_id($couponid) {

		$options = get_option( 'wcusage_options' );

		$coupon_commission_percent = get_post_meta( $couponid, 'wcu_text_coupon_commission', true );
			if(!$coupon_commission_percent) { $coupon_commission_percent = wcusage_get_setting_value('wcusage_field_affiliate', '0'); }

		$coupon_user_id = get_post_meta( $couponid, 'wcu_select_coupon_user', true );

		$unpaid_commission = get_post_meta( $couponid, 'wcu_text_unpaid_commission', true );
			if(!$unpaid_commission) { $unpaid_commission = 0; }

    $pending_payouts = get_post_meta( $couponid, 'wcu_text_pending_payment_commission', true );
			if(!$pending_payouts) { $pending_payouts = 0; }

		$wcusage_justcoupon = wcusage_get_setting_value('wcusage_field_justcoupon', '1');

		$coupon = get_the_title($couponid);

		// Getting the URL
		if($wcusage_justcoupon) {
			$secretid = $coupon;
		} else {
			$secretid = $coupon . "-" . $couponid;
		}

		$thepageurl = wcusage_get_coupon_shortcode_page(1);

		$uniqueurl = $thepageurl . 'couponid=' . $secretid;

		// Return
		return array($coupon_commission_percent, $coupon_user_id, $unpaid_commission, $coupon, $uniqueurl, $pending_payouts);

	}
}
add_action('wcusage_hook_get_coupon_info_by_id', 'wcusage_get_coupon_info_by_id', 10, 1);
