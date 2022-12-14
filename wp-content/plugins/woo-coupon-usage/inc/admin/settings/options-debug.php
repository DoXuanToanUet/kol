<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wcusage_field_cb_debug( $args )
{
    $options = get_option( 'wcusage_options' );
    ?>

	<div id="debug-settings" class="settings-area">

	<h1><?php echo __( 'Performance, Debug & Extra Settings', 'woo-coupon-usage' ); ?></h1>

  <hr/>

  <strong style="color: green;"><p>- <?php echo __( 'For most websites, the settings on this page can be ignored (keep them as they are).', 'woo-coupon-usage' ); ?></strong></p>

	<p>- <?php echo __( 'If you are experiencing any performance issues or other bugs with the plugin, please try enabling/disabling relevant settings below.', 'woo-coupon-usage' ); ?></p>

	<p>- <?php echo __( 'This plugin is frequently updated and maintained. If you notice any bugs, issues, or conflicts with other themes/plugins, please get in touch and it will be looked into.', 'woo-coupon-usage' ); ?></p>

  <br/>

  <hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Performance Settings', 'woo-coupon-usage' ); ?> - <?php echo __( 'Saving Data', 'woo-coupon-usage' ); ?></h3>

  <i><?php echo __( 'These options will improve loading speed of your affiliate dashboard for large coupons with lots of orders (since it wont need to calculate every time).', 'woo-coupon-usage' ); ?></i><br/>
  <i><?php echo __( 'Generally there should not be any reason to turn these off, but its here just incase, and for debugging.', 'woo-coupon-usage' ); ?></i><br/>

  <br/>

  <p>
    <?php echo wcusage_setting_toggle_option('wcusage_field_enable_order_commission_meta', 1, __( 'Save the calculated "commission" values as meta data on each individual order.', 'woo-coupon-usage' ), '0px'); ?>
  </p>

  <br/>

  <p>
    <?php echo wcusage_setting_toggle_option('wcusage_field_enable_coupon_all_stats_meta', 1, __( 'Save the calculated "all time" stats for coupons as meta data.', 'woo-coupon-usage' ), '0px'); ?>
  </p>

  <?php echo wcusage_setting_toggle('.wcusage_field_enable_order_commission_meta', '.wcu-field-section-field-never-update-commission-meta'); // Show or Hide ?>
  <span class="wcu-field-section-field-never-update-commission-meta">

    <br/>

    <p>
      <?php echo wcusage_setting_toggle_option('wcusage_field_enable_never_update_commission_meta', 0, __( 'Never update the saved "commission" value for past orders.', 'woo-coupon-usage' ), '0px'); ?>
      <i><?php echo __( 'When disabled, if you change commission rates, it will automatically update the stats/commission for ALL new and past orders on the affiliate dashboard.', 'woo-coupon-usage' ); ?></i><br/>
      <i><?php echo __( 'When enabled, the PAST orders will not be affected (even if clicking "refresh data"), and it will only set the updated rates for NEW orders. The only time it WILL be updated is if an order is refunded.', 'woo-coupon-usage' ); ?></i><br/>
      <i><?php echo __( 'Please note, the commission displayed for all past orders is calculated the first time the affiliate dashboard is loaded for a coupon. New orders are calculated instantly.', 'woo-coupon-usage' ); ?></i><br/>
    </p>

  </span>

  <br/>
  
  <p><strong>Data not currently accurate, due to settings changes?</strong></p>

  <p>If you want to force refresh (re-calculate) all data that is saved on the affiliate dashboards (for past orders), then click the button below. (The first page load for each coupon dashboard may take slightly longer.)</p>

  <a href="/wp-admin/admin.php?page=wcusage_settings&refreshstats=true"
  onclick="if (confirm('Are you sure you want to refresh all affiliate dashboard data? The next time your affiliates visit their affiliate dashboard, it may take significantly longer to load (first visit).')){return true;}else{event.stopPropagation(); event.preventDefault();};"
  class="wcu-addons-box-view-details" style="padding: 7px 20px; margin: 10px 0;">
    REFRESH ALL DATA <i class="fas fa-sync" style="background: transparent; margin: 0;"></i>
  </a>

	<br/>

	<hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Performance Settings', 'woo-coupon-usage' ); ?> - <?php echo __( 'Other', 'woo-coupon-usage' ); ?></h3>

  <p>
    <?php echo wcusage_setting_toggle_option('wcusage_field_load_ajax', 1, __( 'Enable "Ajax Loading" on Affiliate Dashboard.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'This will make the initial page loading much faster for larger coupons, and show a "loading" animation in these sections whilst it loads content (usually takes no longer than a few seconds).', 'woo-coupon-usage' ); ?></i><br/>
    <i><?php echo __( 'NOTE: In some rare cases, or certain themes, this option may not work and will show the "loading..." animation continuously. In this case, simply disable it or contact us to look into fixing it for you.', 'woo-coupon-usage' ); ?></i><br/>
  </p>

  <?php echo wcusage_setting_toggle('.wcusage_field_load_ajax', '.wcu-field-section-field-show-refresh'); // Show or Hide ?>
  <span class="wcu-field-section-field-show-refresh">

  <br/>

  <p>
    <!-- Load each page individually with ajax. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_load_ajax_per_page', 1, __( 'Load tabs individually with Ajax.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'This will further increase initial loading speed/performance. It will only start loading content for each tab when the tab is clicked, showing the "loading..." animation whilst it loads.', 'woo-coupon-usage' ); ?></i><br/>
  </p>

  </span>

  <script>
  jQuery( document ).ready(function() {
    if(jQuery('.wcusage_field_load_ajax').prop('checked')) {
      jQuery('.section-wcusage-field-page-load').hide();
    }
    jQuery('.wcusage_field_load_ajax').change(function(){
      if(jQuery(this).prop('checked')) {
        jQuery('.section-wcusage-field-page-load').hide();
      } else {
        jQuery('.section-wcusage-field-page-load').show();
      }
    });
  });
  </script>

	<span class="section-wcusage-field-page-load">

      <br/>
      <!-- Load tabs on affiliate dashboard as separate pages. -->
      <?php echo wcusage_setting_toggle_option('wcusage_field_page_load', 0, __( 'Load tabs on affiliate dashboard as separate pages.', 'woo-coupon-usage' ), '0px'); ?>
      <i><?php echo __( 'This will make it so when each tab is clicked, it reloads the page, but it only loads the content for the selected tab.', 'woo-coupon-usage' ); ?> <?php echo __( 'If you experience very high volumes of orders for each coupon, this should help greately with affiliate dashboard speed/performance.', 'woo-coupon-usage' ); ?></i><br/>

  </span>

	<br/>

	<p>
    <!-- Hide the "all-time" stats on statistics tab and line graph. -->
    <?php echo wcusage_setting_toggle_option('wcusage_field_hide_all_time', 0, __( 'Hide the "all-time" stats on statistics tab and line graph.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'This will still show the "Last 30 Days" and "Last 7 Days". It will also cause the "usage" stat to be calculated slightly different.', 'woo-coupon-usage' ); ?></i><br/>
	</p>

  <br/>

  <?php $wcusage_field_user_list_affiliates = wcusage_get_setting_value('wcusage_field_user_list_affiliates', '0'); ?>
  <?php if($wcusage_field_user_list_affiliates) { ?>
    <?php  echo wcusage_setting_toggle_option('wcusage_field_user_list_affiliates', 0, __( 'Only show users with the "coupon affiliate" role when manually assigning users to coupons.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'When assigning users to coupons, if this is enabled, it will only show the list of users with the custom "coupon affiliate" role.', 'woo-coupon-usage' ); ?></i>
    <br/><i><?php echo __( 'This means that you will need to manually edit existing users to the "coupon affiliate", or have them automatically assign to this role when filling out the registration form (enable this in "registration settings").', 'woo-coupon-usage' ); ?></i>
    <br/><br/>
  <?php } ?>

  <?php $wcusage_field_hide_coupon_edit_user_list = wcusage_get_setting_value('wcusage_field_hide_coupon_edit_user_list', '0'); ?>
  <?php if($wcusage_field_hide_coupon_edit_user_list) { ?>
    <?php echo wcusage_setting_toggle_option('wcusage_field_hide_coupon_edit_user_list', 0, __( 'Disable the autofill user picker when assigning users to coupon.', 'woo-coupon-usage' ), '0px'); ?>
    <i><?php echo __( 'Turn this option on to disable the user search/picker, and to just enter the user ID manually.', 'woo-coupon-usage' ); ?></i><br/>
    <br/>
  <?php } ?>

  <hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( '(Admin) Activity Log', 'woo-coupon-usage' ); ?>:</h3>

  <!-- Enable Activity Log -->
  <?php echo wcusage_setting_toggle_option('wcusage_enable_activity_log', 1, __( 'Enable Activity Log', 'woo-coupon-usage' ), '0px'); ?>

	<br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - User Access', 'woo-coupon-usage' ); ?>:</h3>

  <!-- Show full coupon page info automatically, if there is only one coupon. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_coupon_if_single', 1, 'Users Dashboard - ' . __( 'Show full coupon page info automatically, if there is only one coupon.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'With the "[couponaffiliates]" shortcode, when a user visits this page (without the unique URL ID), enable to show full affiliate dashboard automatically if the affiliate user is only assigned to one coupon.', 'woo-coupon-usage' ); ?></i>
  <br/><i><?php echo __( 'Normally it will just show the coupon name, discount, usage, and button to direct them to the unique URL ID, for the affiliate dashboard for that coupon.', 'woo-coupon-usage' ); ?></i>
  <br/><i><?php echo __( 'Useful if you simply want a generic "affiliate" page to direct affiliates to, instead of a unique link for each one.', 'woo-coupon-usage' ); ?></i>

  <br/><br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Affiliate Dashboard - Privacy', 'woo-coupon-usage' ); ?>:</h3>

  <!-- Make all dashboard URLs private/hidden to everyone except administrators. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_urlprivate', 1, __( 'Make all dashboard URLs private/hidden to everyone except administrators and assigned user.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'When enabled, all unique affiliate dashboard URLs will ALWAYS be private, and only be visible to the assigned user (and admins).', 'woo-coupon-usage' ); ?></i>
  <br/><i><?php echo __( 'You will just need to use the shortcode:', 'woo-coupon-usage' ); ?> [couponaffiliates] - <?php echo __( 'Then, only users that are assigned to a coupon will be able to see their dashboard (for that coupon) on this page.', 'woo-coupon-usage' ); ?></i>
  <br/><i><?php echo __( 'When disabled, if there are no users assigned to a coupon, the dashboard can be viewed by anyone if they visit the unique URL directly. However, if there is a user assigned to it, the URL will be private.', 'woo-coupon-usage' ); ?></i>

  <br/><br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Extra Settings', 'woo-coupon-usage' ); ?></h3>

  <!-- Remove coupon ID from unique coupon URL. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_justcoupon', 1, __( 'Remove coupon ID from unique coupon dashboard URLs.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'Enabling this will allow the unique coupon affiliate dashboard URLs to be used without the ID, but both URLs will still work.', 'woo-coupon-usage' ); ?></i><br/>

  <br/>

  <!-- Hide the "Coupon code applied successfully." -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_coupon_applied_hide', 1, __( 'Hide the "Coupon code applied successfully." message on all pages except for the cart/checkout pages.', 'woo-coupon-usage' ), '0px'); ?>
  <i><?php echo __( 'When someone uses the referral URL, if the code is automatically applied, it will show this message on all pages.', 'woo-coupon-usage' ); ?></i><br/>
  <i><?php echo __( 'If you dont want the message to always show, toggle this setting on, and it will instead only show on the cart/checkout pages.', 'woo-coupon-usage' ); ?></i><br/>

  <br/>

  <!-- Hide the WooCommerce marketing boxes on coupons list. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_coupon_hide_woo_marketing', 1, __( 'Hide the WooCommerce marketing boxes on coupons list.', 'woo-coupon-usage' ), '0px'); ?>

  <br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( '(Admin) WooCommerce Orders "Affiliate Info" Sections', 'woo-coupon-usage' ); ?>:</h3>

	<i><?php echo __( 'Enable or disable the "affiliate info" sections displayed on WooCommerce orders in the backend.', 'woo-coupon-usage' ); ?></i>

	<br/><br/>

  <!-- Show "Affiliate Info" Column in orders list. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_column_code', 1, __( 'Show "Affiliate Info" Column in orders list.', 'woo-coupon-usage' ), '0px'); ?>

	<br/>

  <!-- Show "Affiliate Info" widget in single orders. -->
  <?php echo wcusage_setting_toggle_option('wcusage_field_show_orders_aff_info', 1, __( 'Show "Affiliate Info" widget in single orders.', 'woo-coupon-usage' ), '0px'); ?>

  <br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Admin Permissions', 'woo-coupon-usage' ); ?>:</h3>

  <!-- DROPDOWN - Admin Permission -->
	<p>
		<?php
    $wcusage_field_admin_permission = wcusage_get_setting_value('wcusage_field_admin_permission', 'administrator');
    ?>
		<input type="hidden" value="0" id="wcusage_field_admin_permission" data-custom="custom" name="wcusage_options[wcusage_field_admin_permission]" >

		<strong><label for="scales"><?php echo __( 'Permission required for plugin admin capabilities:', 'woo-coupon-usage' ); ?></label></strong><br/>
		<select name="wcusage_options[wcusage_field_admin_permission]" id="wcusage_field_admin_permission">
			<option value="administrator" <?php if($wcusage_field_admin_permission == "administrator") { ?>selected<?php } ?>><?php echo __( 'Administrator', 'woo-coupon-usage' ); ?></option>
			<option value="shop_manager" <?php if($wcusage_field_admin_permission == "shop_manager") { ?>selected<?php } ?>><?php echo __( 'Shop Manager', 'woo-coupon-usage' ); ?></option>
		</select>
    <br/>
    <i><?php echo __( 'This is the user permission required to have full access for this plugin.', 'woo-coupon-usage' ); ?></i>
    <br/>
    <i><?php echo __( 'This excludes the plugin settings which are available to those with the "manage_options" permission.', 'woo-coupon-usage' ); ?></i>

	</p>

  <br/><hr/>

  <h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> <?php echo __( 'Translations', 'woo-coupon-usage' ); ?></h3>

  <p style="display: none;">
		<?php
    if(isset($options['wcusage_field_show_custom_translations'])) {
      $wcusage_show_custom_translations = $options['wcusage_field_show_custom_translations'];
    } else {
      $wcusage_show_custom_translations = "";
    }
    $checked2 = ( $wcusage_show_custom_translations == '1' ? ' checked="checked"' : '' );
    ?>

	<label class="switch">
		<input type="hidden" value="0" id="wcusage_field_show_custom_translations" data-custom="custom" name="wcusage_options[wcusage_field_show_custom_translations]" >
		<input type="checkbox" value="1" id="wcusage_field_show_custom_translations" data-custom="custom" name="wcusage_options[wcusage_field_show_custom_translations]" <?php
    echo  $checked2 ;
    ?>>
	<span class="slider round">
    <span class="on"><span class="fa-solid fa-check"></span></span>
    <span class="off"></span>
  </span>
	</label>
		<strong><label for="scales"><?php echo __( 'Show/enable custom translation settings (discontinued - not recommended).', 'woo-coupon-usage' ); ?></label></strong><br/>
	</p>
  <i><?php echo __( 'Note: We recommended using', 'woo-coupon-usage' ); ?> "<a href="<?php echo get_site_url(); ?>/wp-admin/plugin-install.php?s=Loco%20Translate&tab=search&type=term" target="_blank">Loco Translate</a>" <?php echo __( 'or', 'woo-coupon-usage' ); ?> "<a href="https://wpml.org" target="_blank">WPML</a>" <?php echo __( 'to fully translate this plugin.', 'woo-coupon-usage' ); ?></i><br/>

  <!--
  <br/><hr/>
	<h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> Export Settings</h3>

  <textarea style="width: 100%; height: 100px;"><?php // echo json_encode($options); ?></textarea>
  -->

  <br/><hr/>
	<h3><span class="dashicons dashicons-admin-generic" style="margin-top: 2px;"></span> Plugin Uninstallation</h3>

	<p>
		<?php
    $wcusage_field_deactivate_delete = wcusage_get_setting_value('wcusage_field_deactivate_delete', '0');
    $checked2 = ( $wcusage_field_deactivate_delete == '1' ? ' checked="checked"' : '' );
    ?>
	<label class="switch">
		<input type="hidden" value="0" id="wcusage_field_deactivate_delete" data-custom="custom" name="wcusage_options[wcusage_field_deactivate_delete]" >
		<input type="checkbox" value="1" id="wcusage_field_deactivate_delete" data-custom="custom" name="wcusage_options[wcusage_field_deactivate_delete]" <?php
    echo  $checked2 ;
    ?>>
	<span class="slider round">
    <span class="on"><span class="fa-solid fa-check"></span></span>
    <span class="off"></span>
  </span>
	</label>
		<strong><label for="scales"><?php echo __( 'Delete plugin options and custom database tables on plugin deletion.', 'woo-coupon-usage' ); ?></label></strong>
	</p>
  <i><?php echo __( 'If enabled, when uninstalling (deleting) the plugin, most plugin options and custom tables/data created by this plugin will be deleted. Some data will still remain such as custom order & coupon meta data (if any).', 'woo-coupon-usage' ); ?></i>
  <br/><i><?php echo __( 'This will not delete your orders or WooCommerce data. If you want to be safe, be sure to make a backup of your website beforehand in-case you want to restore this data.', 'woo-coupon-usage' ); ?></i>

	</div>

 <?php
}
