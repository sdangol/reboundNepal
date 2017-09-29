<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	/**
	 * Plugin Name: Rebound Donors
	 * Description: Plugin to manage donors for Rebound nepal
	 * Version: 1.0
	 * Author: ReboundNepal
	 */
	define('REBOUND_PLUGIN_DIR',plugin_dir_path(__FILE__));
	require_once( REBOUND_PLUGIN_DIR . 'rebound-donors.php' );
	class Rebound_Plugin {
		// class instance
		static $instance;
		// donor WP_List_Table object
		public $donor_obj;

		// class constructor
		public function __construct() {
			add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
			add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
		}

		public static function set_screen( $status, $option, $value ) {
			return $value;
		}

		public function plugin_menu() {
			$donor_hook = add_menu_page('Rebound Donors','Rebound Donors','manage_options','rebound_donors',[ $this, 'donor_list_page' ],'dashicons-money');
			add_action( "load-$donor_hook", [ $this, 'donor_screen_option' ] );
		}

		/**
		* donor Screen options
		*/
		public function donor_screen_option() {
			$option = 'per_page';
			$args   = [
				'label'   => 'Donors',
				'default' => 10,
				'option'  => 'donor_per_page'
			];
			add_screen_option( $option, $args );
			$this->donor_obj = new Rebound_Donor_List();
		}

		/**
		* donor list page
		*/
		public function donor_list_page() {
			?>
			<div class="wrap">
				<h2>Rebound Nepal Donors</h2>
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-12">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form id="donor_form" method="GET">
									<input type="hidden" name="page" value="rebound_donors">
									<?php
									$this->donor_obj->prepare_items();
									$this->donor_obj->display(); ?>
								</form>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
			</div>
		<?php
		}

		/** Singleton instance */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

	}
	add_action( 'plugins_loaded', function () {
		Rebound_Plugin::get_instance();
	} );