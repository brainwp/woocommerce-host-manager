<?php
/**
 *
 *
 * @package   WooCommerce Host Manager
 * @author    Matheus Gimenez <contato@matheusgimenez.com.br>
 * @license   GPL-2.0+
 * @link      http://brasa.art.br
 * @copyright 2014 Matheus Gimenez
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Host Manager
 * Plugin URI:        nd
 * Description:       WooCommerce Host Manager
 * Version:           0.1
 * Author:            Matheus Gimenez
 * Plugin URI:        nd
 * Text Domain:       wc-host-manager
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/brasadesign/woocommerce-host-manager
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class WC_Host_Manager {
	public function __construct() {
		define( 'WC_HOST_MANAGER_URL', plugin_dir_url( __FILE__ ) );
		load_plugin_textdomain( 'wc-host-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			//require_once plugin_dir_path( __FILE__ ) . 'inc/options.php';
			require_once plugin_dir_path( __FILE__ ) . 'inc/metabox.php';
		}
		add_action( 'woocommerce_payment_complete', array($this,'add_dates') );
	}
	/*
	* add newsletter emails
	*/
	public function add_dates($id){
		$order = new WC_Order($id);
		$before = 0;
		$after = 0;
		$del = 0;
		foreach($order->get_items() as $item){
		    if(intval($item['qty']) > 1){
		    	$_before = intval(get_post_meta( $item['product_id'], 'wc-host-manager-meta-before', true )) * intval($item['qty']);
		    	$_after = intval(get_post_meta( $item['product_id'], 'wc-host-manager-meta-after', true )) * intval($item['qty']);
		    	$_del = intval(get_post_meta( $item['product_id'], 'wc-host-manager-meta-before', true )) * intval($item['qty']);
		    }
		    else{
		    	$_before = $before + intval(get_post_meta( $item['product_id'], 'wc-host-manager-meta-before', true ));
		    	$_after = $after + intval(get_post_meta( $item['product_id'], 'wc-host-manager-meta-after', true ));
		    	$_after = $del + intval(get_post_meta( $item['product_id'], 'wc-host-manager-meta-del', true ));
		    }
		    $before = $_before + $before;
		    $after = $_after + $after;
		    $del = $_del + $del;
		    $order->add_order_note('before:'.$before.'  - after:'.$after.' - del:'.$del);
		}
	}
}
new WC_Host_Manager();
