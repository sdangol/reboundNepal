<?php
	if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}

	class Khalti_Transaction_List extends WP_List_Table {

		private static $total_records;
		/** Class constructor */
		public function __construct() {
			parent::__construct( [
						'singular' => __( 'Transaction', 'sp' ), //singular name of the listed records
						'plural'   => __( 'Transactions', 'sp' ), //plural name of the listed records
						'ajax'     => false //should this table support ajax?
			] );
		}

		/**
		 * Retrieve transaction data from the Khalti Transaction API
		 *
		 * @param int $per_page
		 * @param int $page_number
		 *
		 * @return mixed
		 */
		public static function get_transactions( $per_page = 10, $page_number = 1 ) {
			$url = "https://khalti.com/api/transaction/";

			# Make the call using API.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$wpkhalti_options = get_option( 'wpkhalti_options' );
			if ( isset($_REQUEST['display'])){
				if ($_REQUEST['display'] == 'live') $secretKey = $wpkhalti_options['live_secret_key'];
				else $secretKey = $wpkhalti_options['test_secret_key'];
			}else{
				$secretKey = ($wpkhalti_options['sandbox_enabled'])?$wpkhalti_options['test_secret_key']:$wpkhalti_options['live_secret_key'];
			}
			$headers = ['Authorization: Key '.$secretKey];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			// Response
			$response = curl_exec($ch);
			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			$results = json_decode($response);
			if ($status_code == 200){
				$records = $results->records;
				$records = array_reverse($records);
				self::$total_records = $results->total_records;
				return array_slice($records,($page_number - 1)*$per_page,$per_page );
			}else{
				self::$total_records = 0;
				return array();
			}
		}

		/**
		 * Returns the count of records in the database.
		 *
		 * @return null|string
		 */
		public static function record_count() {
			return self::$total_records;
		}

		/** Text displayed when no subscriber data is available */
		public function no_items() {
			_e( 'No transactions avaliable.' );
		}

		/**
		 * Render a column when no column specific method exist.
		 *
		 * @param array $item
		 * @param string $column_name
		 *
		 * @return mixed
		 */
		public function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'idx':
				case 'type':
				case 'state':
				case 'amount':
				case 'fee_amount':
				case 'created_on':
				case 'source':
					return $item->$column_name;						 
			}
		}

		/**
		 *  Associative array of columns
		 *
		 * @return array
		 */
		function get_columns() {
			$columns = [
				'idx'    => __( 'ID' ),
				'type' => __( 'Type' ),
				'state'    => __( 'State' ),
				'amount'    => __( 'Amount (in paisa)'),
				'fee_amount'    => __( 'Fee Amount'),
				'created_on'    => __( 'Created On'),
				'source'    => __( 'Source'),
			];
			return $columns;
		}


		/**
		 * Handles data query and filter, sorting, and pagination.
		 */
		public function prepare_items() {
			$this->_column_headers = $this->get_column_info();
			$per_page     = $this->get_items_per_page( 'transactions_per_page', 5 );
			$current_page = $this->get_pagenum();
			$this->items = self::get_transactions( $per_page, $current_page );
			$total_items  = self::record_count();
			$this->set_pagination_args( [
				'total_items' => $total_items, //WE have to calculate the total number of items
				'per_page'    => $per_page //WE have to determine how many items to show on a page
			] );
		}


		protected function get_views() { 
			$views = array();
			$wpkhalti_options = get_option( 'wpkhalti_options' );
			if ( isset($_REQUEST['display'])){
				if ($_REQUEST['display'] == 'live') $current = 'live';
				else $current = 'test';
			}else{
				$current = ($wpkhalti_options['sandbox_enabled'])?'test':'live';
			}
		   //Live link
		   $live_url = add_query_arg('display','live');
		   $class = ($current == 'live' ? ' class="current"' :'');
		   $views['live'] = "<a href='{$live_url}' {$class} >Live Transactions</a>";

		   //Test link
		   $test_url = add_query_arg('display','test');
		   $class = ($current == 'test' ? ' class="current"' :'');
		   $views['test'] = "<a href='{$test_url}' {$class} >Test Transactions</a>";

   		return $views;
		}

		public function wpkhalti_transactions_page(){
		?>
			<div class="wrap">
        <h2>Khalti Transactions</h2>
        <div id="poststuff">
          <div id="post-body" class="metabox-holder columns-12">
            <div id="post-body-content">
              <div class="meta-box-sortables ui-sortable">
                <?php
                  $this->prepare_items();
                  $this->views();
                  $this->display();
                ?>
              </div>
            </div>
          </div>
          <br class="clear">
        </div>
    	</div>
    <?php
		}
	}
