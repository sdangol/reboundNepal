<?php
/*
Plugin Name: WP Khalti
Description: Implement Khalti Payment Gateway on your website
Version: 1.0.0
Author: ReboundNepal
	Copyright 2017 ReboundNepal
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( !defined( 'WPKHALTI_VER' ) )
	define( 'WPKHALTI_VER', '1.0.0' );
// Start up the engine
class WP_Khalti
{
	/**
	 * Static property to hold our singleton instance
	 *
	 */
	static $instance = false;
	/**
	 * This is our constructor
	 *
	 * @return void
	 */
	private function __construct() {
		//Load Dependencies required
		$this->load_dependencies();
		// back end
		add_action		( 'plugins_loaded', 					array( $this, 'textdomain'				) 			);
		add_action		( 'admin_enqueue_scripts',				array( $this, 'admin_scripts'			)			);
		add_action		( 'admin_menu', 					array( $this, 'wpkhalti_create_menu'				) 			);
		add_action		( 'admin_init', 					array( $this, 'wpkhalti_register_settings'				) 			);
		// front end
		add_action		( 'wp_enqueue_scripts',					array( $this, 'front_scripts'			),	10		);
		add_action		( 'init',					array( $this, 'register_shortcode'			)	);
		//ajax
		add_action('wp_ajax_verifyPayment',array($this,'verify_payment'));
		add_action('wp_ajax_nopriv_verifyPayment',array($this,'verify_payment'));
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for showing transactions of Khalti
		 */
		require_once plugin_dir_path( __FILE__  ) . 'includes/class-khalti-transactions.php';
	}


	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * retuns it.
	 *
	 * @return WP_Khalti
	 */
	public static function getInstance() {
		if ( !self::$instance )
			self::$instance = new self;
		return self::$instance;
	}
	/**
	 * load textdomain
	 *
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( 'wpkhalti', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * call front-end scripts
	 *
	 * @return void
	 */
	public function admin_scripts() { 
		$screen	= get_current_screen();
		if ($screen->base == 'toplevel_page_wpkhalti_main_menu')
			wp_enqueue_style( 'khalti-css', plugins_url('css/khalti-admin.css',__FILE__));
			wp_enqueue_script( 'khalti-js', plugins_url('js/khalti-admin.js',__FILE__),array('jquery'),WPKHALTI_VER,true);
	}


	/**
	 * call front-end scripts
	 *
	 * @return void
	 */
	public function front_scripts() {
		wp_enqueue_style( 'khalti-frontend-style', plugins_url('css/khalti-frontend.css',__FILE__));
		wp_enqueue_script( 'khalti-checkout', 'https://khalti.com/static/khalti-checkout.js', array(), WPKHALTI_VER,true);
		wp_enqueue_script( 'khalti-frontend', plugins_url('js/khalti-frontend.js',__FILE__),array('jquery'),WPKHALTI_VER,true);
		wp_localize_script( 'khalti-frontend', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	}

	/**
	 * Create a top level menu 
	 */
	function wpkhalti_create_menu() {
		//create new top-level menu
		add_menu_page(__('Khalti Payment Gateway','wpkhalti'), __('Khalti','wpkhalti'),'manage_options', 'wpkhalti_main_menu', array($this,'wpkhalti_settings_page'),plugins_url('images/khaltilogo_small.png',__FILE__));
		//add sub menu
		add_submenu_page('wpkhalti_main_menu',__('Khalti Payment Gateway','wpkhalti'),__('Manage Keys','wpkhalti'),'manage_options','wpkhalti_main_menu',array($this,'wpkhalti_settings_page') );
		$transactions = new Khalti_Transaction_List;
		add_submenu_page('wpkhalti_main_menu',__('Khalti Transactions','wpkhalti'),__('Khalti Transactions','wpkhalti'),'manage_options','khalti-transactions',array($transactions,'wpkhalti_transactions_page') );
	}

	/**
	 * Register plugin settings in the wp_options table
	 */
	function wpkhalti_register_settings() {
		//register our settings
		register_setting( 'wpkhalti-settings-group', 'wpkhalti_options',array($this,'wpkhalti_sanitize_options') );
	}

	/**
	 * Render the plugin settings page
	 */
	function wpkhalti_settings_page() {
	?>
		<div class="wrap">
			<h2><?php _e('Manage Khalti Payment Api Keys','wpkhalti') ?></h2>
			<!-- Display errors during saving of settings -->
			<?php settings_errors(); ?>
			<h4><?php printf(__('To get your api keys, sign up as a merchant with %s','wpkhalti'),'<a href="https://khalti.com/join/merchant/">Khalti</a>'); ?></h4>
			<form method="post" action="options.php">
				<!-- Add hidden settings field -->
				<?php settings_fields( 'wpkhalti-settings-group' ); ?>
				<!-- Get saved settings -->
				<?php $wpkhalti_options = get_option( 'wpkhalti_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Enable Sandbox','wpkhalti') ?></th>
						<td><input type="checkbox" id="env-checkbox" name="wpkhalti_options[sandbox_enabled]" value="1" <?php checked($wpkhalti_options['sandbox_enabled'],1); ?> /></td>
					</tr>
					<tbody <?php if (!$wpkhalti_options['sandbox_enabled']) echo 'style = "display:none"'; ?> id="test-keys">
						<tr valign="top">
							<th scope="row"><?php _e('Test Public Key','wpkhalti'); ?></th>
							<td><input type="text" name="wpkhalti_options[test_public_key]" value="<?php echo esc_attr( $wpkhalti_options['test_public_key']); ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e('Test Secret Key','wpkhalti'); ?></th>
							<td><input type="text" name="wpkhalti_options[test_secret_key]" value="<?php echo esc_attr( $wpkhalti_options['test_secret_key']); ?>" /></td>
						</tr>
					</tbody>
					<tbody <?php if ($wpkhalti_options['sandbox_enabled']) echo 'style = "display:none"'; ?> id="live-keys">
						<tr valign="top">
							<th scope="row"><?php _e('Live Public Key','wpkhalti'); ?></th>
							<td><input type="text" name="wpkhalti_options[live_public_key]" value="<?php echo esc_attr( $wpkhalti_options['live_public_key']); ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e('Live Secret Key','wpkhalti'); ?></th>
							<td><input type="text" name="wpkhalti_options[live_secret_key]" value="<?php echo esc_attr( $wpkhalti_options['live_secret_key']); ?>" /></td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes','wpkhalti') ?>" />
				</p>
			</form>
		</div>
	<?php
	}

	/**
	 * Sanitize saved options
	 */
	function wpkhalti_sanitize_options( $input ) {
		$input['sandbox_enabled'] = ( isset($input['sandbox_enabled']) && $input['sandbox_enabled'] == 1 ) ? 1 : 0;
		$input['test_public_key'] = sanitize_text_field( $input['test_public_key'] );
		$input['test_secret_key'] = sanitize_text_field( $input['test_secret_key'] );
		$input['live_public_key'] = sanitize_text_field( $input['live_public_key'] );
		$input['live_secret_key'] = sanitize_text_field( $input['live_secret_key'] );
		return $input;
	}

	/**
	 * Register all shortcodes to be used
	 */
	function register_shortcode(){
		add_shortcode('wpkhalti',array($this,'wpkhalti_btn'));
	}

	/**
	 * Create a Pay with Khalti Button
	 */
	function wpkhalti_btn( $atts, $content = null ) {
		$wpkhalti_options = get_option( 'wpkhalti_options' );
		$publicKey = ($wpkhalti_options['sandbox_enabled'])?$wpkhalti_options['test_public_key']:$wpkhalti_options['live_public_key'];
		$atts = shortcode_atts(
			array(
				'amount' => 1000, //Default amount
				'public_key' => $publicKey,
				'product_id' => 'uniqueId',
				'name' => 'My Product',
				'product_url' => get_permalink(),
				'success_url' => '',
				'failed_url' => '',
				'custom' => '',
				'text' => __('Pay With Khalti','wpkhalti') //Default button text
			), $atts );
		ob_start();
	?>
		<button class="wpkhalti-payment-btn" data-amount = "<?php echo $atts['amount'] ?>" data-publickey = "<?php echo $atts['public_key'] ?>" data-productidentity = "<?php echo $atts['product_id'] ?>" data-productname = "<?php echo $atts['name'] ?>" data-producturl = "<?php echo $atts['product_url'] ?>" data-successurl = "<?php echo $atts['success_url'] ?>" data-failedurl = "<?php echo $atts['failed_url'] ?>" data-custom="<?php echo $atts['custom'] ?>" ><?php echo $atts['text']; ?></button>
		<?php
		return ob_get_clean();
}

	/**
	 * After user confirms payment, it is verified server to server. 
	 */
	function verify_payment(){
		$args = http_build_query(array(
        'token' => $_POST['token'],
        'amount'  => $_POST['amount']
       ));

    $url = "https://khalti.com/api/payment/verify/";

    # Make the call using API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $wpkhalti_options = get_option( 'wpkhalti_options' );
    $secretKey = ($wpkhalti_options['sandbox_enabled'])?$wpkhalti_options['test_secret_key']:$wpkhalti_options['live_secret_key'];
    $headers = ['Authorization: Key '.$secretKey];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Response
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $msg = [];
    if ($status_code == 200){
    	//Action hook for plugin users if successfull transaction
    	do_action('wp_khalti_success',array('response' => $response,'custom' => $_POST['custom'],'amount' => $_POST['amount']));
    	if (!empty($_POST['success_url'])){
    		$msg['action'] = 'redirect';
    		$msg['url'] = $_POST['success_url'];
    	}
    }else{
    	//Action hook for plugin users if failed transaction
    	do_action('wp_khalti_failure',$response);
    	if (!empty($_POST['failed_url'])){
    		$msg['action'] = 'redirect';
    		$msg['url'] = $_POST['failed_url'];
    	}
    }
    $msg['response'] = $response;
    $msg['code'] = $status_code;
    echo json_encode($msg);
    wp_die();
	}


/// end class
}
// Instantiate our class
$WP_Khalti = WP_Khalti::getInstance();