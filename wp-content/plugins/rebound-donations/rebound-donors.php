<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}
	//Table showing donor list
	class Rebound_Donor_List extends WP_List_Table {
		/** Class constructor */
		public function __construct() {
			parent::__construct( [
				'singular' => __( 'Donor', 'rebound' ), //singular name of the listed records
				'plural'   => __( 'Donors', 'rebound' ) //plural name of the listed records
			] );
		}

		/**
		 * Retrieve donor’s data from the database
		 *
		 * @param int $per_page
		 * @param int $page_number
		 *
		 * @return mixed
		 */
		public static function get_donor( $per_page = 10, $page_number = 1 ) {
		  global $wpdb;
		  $visitor_sql = "SELECT project_id,full_name,email,address,contact,pledged_amount,backed_date FROM {$wpdb->prefix}backers_visitors WHERE completed_status = 1";
		  $registered_sql = "SELECT project_id,display_name as full_name,user_email as email,m1.meta_value as address,m2.meta_value as contact,pledged_amount,backed_date FROM {$wpdb->prefix}backers_registered t1 JOIN {$wpdb->users} u1 ON u1.ID = t1.backer_id LEFT JOIN {$wpdb->usermeta} m1 ON (m1.user_id = t1.backer_id AND m1.meta_key = 'address' ) LEFT JOIN {$wpdb->usermeta} m2 ON (m2.user_id = t1.backer_id AND m2.meta_key = 'contact' )  WHERE completed_status = 1";
		  if (isset($_REQUEST['project_id'])){
		  	$visitor_sql .= " AND project_id = ".$_REQUEST['project_id'];
		  	$registered_sql .= " AND project_id = ".$_REQUEST['project_id'];
		  }
		  $sql = $visitor_sql." UNION ".$registered_sql;
		  if ( ! empty( $_REQUEST['orderby'] ) ) {
		    $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
		    $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		  }
  	  $sql .= " LIMIT $per_page";
  	  $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
  	  $result = $wpdb->get_results( $sql, 'ARRAY_A' );
		  return $result;
		}

		public static function count_results(){
			global $wpdb;
			$visitor_sql = "SELECT COUNT(*) FROM {$wpdb->prefix}backers_visitors WHERE completed_status = 1";
		  $registered_sql = "SELECT COUNT(*) FROM {$wpdb->prefix}backers_registered WHERE completed_status = 1";
		  if (isset($_REQUEST['project_id'])){
		  	$visitor_sql .= " AND project_id = ".$_REQUEST['project_id'];
		  	$registered_sql .= " AND project_id = ".$_REQUEST['project_id'];
		  }
		  $sql = "SELECT ({$visitor_sql}) + ({$registered_sql})";
		  $count = $wpdb->get_var( $sql);
		  return $count;
		}

		/** Text displayed when no donor data is available */
		public function no_items() {
		  _e( 'No donors avaliable.' );
		}

			/**
		 *  Associative array of columns
		 *
		 * @return array
		 */
		function get_columns() {
		  $columns = [
		    'full_name'    => __( 'Name','rebound' ),
		    'email' => __( 'Email','rebound' ),
		    'address'    => __( 'Address','rebound' ),
		    'contact'    => __( 'Contact','rebound'),
		    'project_id'    => __( 'Project','rebound'),
		    'pledged_amount'    => __( 'Donated Amount','rebound'),
		    'backed_date'    => __( 'Date','rebound')
		  ];
		  return $columns;
		}

		/**
		 * Handles data query and filter, sorting, and pagination.
		 */
		public function prepare_items() {
			$columns = $this->get_columns();
		  $hidden = array();
		  $sortable = array();
		  $this->_column_headers = array($columns, $hidden, $sortable);
		  $per_page     = $this->get_items_per_page( 'donor_per_page', 10 );
		  $current_page = $this->get_pagenum();
		  $items = self::get_donor( $per_page, $current_page );
		  $total_items  = self::count_results();	
		  $this->set_pagination_args( [
		    'total_items' => $total_items, //WE have to calculate the total number of items
		    'per_page'    => $per_page //WE have to determine how many items to show on a page
		  ] );
		  $this->items = $items;
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
				global $wpdb;
				switch ( $column_name ) {
					case 'project_id':
						return get_the_title($item[ $column_name ]);
					case 'full_name':
					case 'email':
					case 'address':
					case 'contact':
					case 'pledged_amount':
					case 'backed_date':
						return $item[ $column_name ];
					default:
						//return print_r( $item, true ); //Show the whole array for troubleshooting purposes
				}
			}

			protected function extra_tablenav( $which ) {
        global $wpdb;
  		?>
        <div class="alignleft actions">
        <?php
	        if ( 'top' === $which ){
	              $sql = "SELECT {$wpdb->posts}.ID,post_title,COUNT(*) as count FROM {$wpdb->posts}";
	              $sql_visitor = $sql." JOIN {$wpdb->prefix}backers_visitors ON ({$wpdb->posts}.ID = {$wpdb->prefix}backers_visitors.project_id AND {$wpdb->prefix}backers_visitors.completed_status = 1)";
	              $sql_registered = $sql." JOIN {$wpdb->prefix}backers_registered ON ({$wpdb->posts}.ID = {$wpdb->prefix}backers_registered.project_id AND {$wpdb->prefix}backers_registered.completed_status = 1)";
	              $sql = "SELECT ID,post_title,SUM(count) as total FROM (({$sql_visitor}) UNION ({$sql_registered})) t1";
	              $projects = $wpdb->get_results($sql);
        ?>
            <select name="project_id">
              <option value="">All Projects</option>
              <?php foreach ($projects as $project) {
              ?>
              <option value="<?php echo $project->ID; ?>" <?php if (isset($_REQUEST['project_id']) && (int)$_REQUEST['project_id'] == $project->ID) echo "selected"; ?>><?php echo $project->post_title."({$project->total})"; ?></option>
        <?php } ?>
            </select>
        <?php
            submit_button( __( 'Filter' ), '', 'filter_action', false, array( 'id' => 'post-query-submit' ) );
        }
        ?>
        	</div>
			<?php
			  }

	}