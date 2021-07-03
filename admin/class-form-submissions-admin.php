<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://samuilmarinov.co.uk
 * @since      1.0.0
 *
 * @package    Form_Submissions
 * @subpackage Form_Submissions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Form_Submissions
 * @subpackage Form_Submissions/admin
 * @author     samuil marinov <samuil.marinov@gmail.com>
 */
class Form_Submissions_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Form_Submissions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Form_Submissions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/form-submissions-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Form_Submissions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Form_Submissions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/form-submissions-admin.js', array( 'jquery' ), $this->version, false );

	}

}

function Form_Submissions_add_settings_page() {
    add_options_page( 'Booking System Settings', 'System Settings', 'manage_options', 'Form_Submissions', 'Form_Submissions_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'Form_Submissions_add_settings_page' );


function Form_Submissions_render_plugin_settings_page() {
    ?>
    <h2>Booking System Settings</h2>
    <form action="options.php" method="post">
        <?php 
        settings_fields( 'Form_Submissions_options' );
        do_settings_sections( 'Form_Submissions' ); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
    </form>
    <?php
}

function Form_Submissions_register_settings() {
    register_setting( 'Form_Submissions_options', 'Form_Submissions_options', 'Form_Submissions_options_validate' );
    add_settings_section( 'api_settings', 'General Settings', 'Form_Submissions_section_text', 'Form_Submissions' );

    add_settings_field( 'Form_Submissions_setting_api_key', 'API Key', 'Form_Submissions_setting_api_key', 'Form_Submissions', 'api_settings' );
    add_settings_field( 'Form_Submissions_setting_results_limit', 'Results Limit', 'Form_Submissions_setting_results_limit', 'Form_Submissions', 'api_settings' );
    add_settings_field( 'Form_Submissions_setting_start_date', 'Start Date', 'Form_Submissions_setting_start_date', 'Form_Submissions', 'api_settings' );
}
add_action( 'admin_init', 'Form_Submissions_register_settings' );


function Form_Submissions_section_text() {
    echo '<p>Here you can set all the options</p>';
}

function Form_Submissions_setting_api_key() {
    $options = get_option( 'Form_Submissions_options' );
    echo "<input id='Form_Submissions_setting_api_key' name='Form_Submissions_options[api_key]' type='text' value='" . esc_attr( $options['api_key'] ) . "' />";
}

function Form_Submissions_setting_results_limit() {
    $options = get_option( 'Form_Submissions_options' );
    echo "<input id='Form_Submissions_setting_results_limit' name='Form_Submissions_options[results_limit]' type='text' value='" . esc_attr( $options['results_limit'] ) . "' />";
}

function Form_Submissions_setting_start_date() {
    $options = get_option( 'Form_Submissions_options' );
    echo "<input id='Form_Submissions_setting_start_date' name='Form_Submissions_options[start_date]' type='text' value='" . esc_attr( $options['start_date'] ) . "' />";
}

//EXPORT TO CSV

//EXPORT TO CSV

/**
* PART 2. Defining Custom Table List
* ============================================================================
*
* In this part you are going to define custom table list class,
* that will display your database records in nice looking table
*
* http://codex.wordpress.org/Class_Reference/WP_List_Table
* http://wordpress.org/extend/plugins/custom-list-table-example/
*/

if (!class_exists('WP_List_Table')) {
   require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
* Custom_Table_Example_List_Table class that will display our custom table
* records in nice table
*/
class Custom_Table_Example_List_Table extends WP_List_Table
{
   /**
	* [REQUIRED] You must declare constructor and give some basic params
	*/
   function __construct()
   {
	   global $status, $page;

	   parent::__construct(array(
		   'singular' => 'submission',
		   'plural' => 'submissions',
	   ));
   }

   /**
	* [REQUIRED] this is a default column renderer
	*
	* @param $item - row (key, value array)
	* @param $column_name - string (key)
	* @return HTML
	*/
   function column_default($item, $column_name)
   {
	   return $item[$column_name];
   }

   // /**
   //  * [OPTIONAL] this is example, how to render specific column
   //  *
   //  * method name must be like this: "column_[column_name]"
   //  *
   //  * @param $item - row (key, value array)
   //  * @return HTML
   //  */
   // function column_fromaddress()
   // {
   //     return '<em>' . $item['fromaddress'] . '</em>';
   // }

   /**
	* [OPTIONAL] this is example, how to render column with actions,
	* when you hover row "Edit | Delete" links showed
	*
	* @param $item - row (key, value array)
	* @return HTML
	*/
   function column_name($item)
   {
	   // links going to /admin.php?page=[your_plugin_page][&other_params]
	   // notice how we used $_REQUEST['page'], so action will be done on curren page
	   // also notice how we use $this->_args['singular'] so in this example it will
	   // be something like &submission=2
	   $actions = array(
		   'edit' => sprintf('<a href="?page=submissions_form&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
		   'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'cltd_example')),
	   );

	   return sprintf('%s %s',
		  $item['name'],
		   $this->row_actions($actions)
	   );
   }

   /**
	* [REQUIRED] this is how checkbox column renders
	*
	* @param $item - row (key, value array)
	* @return HTML
	*/
   function column_cb($item)
   {
	   return sprintf(
		   '<input type="checkbox" name="id[]" value="%s" />',
		   $item['id']
	   );
   }

   /**
	* [REQUIRED] This method return columns to display in table
	* you can skip columns that you do not want to show
	* like content, or description
	*
	* @return array
	*/
   function get_columns()
   {   
	   
	   $columns = array(
		   'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
		   'id' => __('Id', 'cltd_example'),
		   'name' => __('Name', 'cltd_example'),
		   'email' => __('E-Mail', 'cltd_example'),
		   'phone' => __('Phone', 'cltd_example'),
		   'service' => __('Service', 'cltd_example'),
		   'vehicle' => __('Vehicle', 'cltd_example'),
		   'pickup_time' => __('Pick-up time', 'cltd_example'),
		   'return_time' => __('Return time', 'cltd_example'),
		   'pickup' => __('Pickup', 'cltd_example'),
		   'destination' => __('Destination', 'cltd_example'),
		   'created_at' => __('Date', 'cltd_example'),
	   );
	   
	   return $columns;
   }

   /**
	* [OPTIONAL] This method return columns that may be used to sort table
	* all strings in array - is column names
	* notice that true on name column means that its default sort
	*
	* @return array
	*/
   function get_sortable_columns()
   {
	   $sortable_columns = array(
		   'id' => array('id', true),
		   'name' => array('name', true),
		   'email' => array('email', false),
		   'phone' => array('phone', false),
		   'service' => array('service', false),
		   'vehicle' => array('vehicle', false),
		   'pickup_time' => array('pickup_time', false),
		   'return_time' => array('return_time', false),
		   'pickup' => array('pickup', false),
		   'destination' => array('destination', false),
		   'created_at' => __('Date', 'cltd_example'),
	   );
	   return $sortable_columns;
   }

   /**
	* [OPTIONAL] Return array of bult actions if has any
	*
	* @return array
	*/
   function get_bulk_actions()
   {
	   $actions = array(
		   'delete' => 'Delete'
	   );
	   return $actions;
   }

   /**
	* [OPTIONAL] This method processes bulk actions
	* it can be outside of class
	* it can not use wp_redirect coz there is output already
	* in this example we are processing delete action
	* message about successful deletion will be shown on page in next part
	*/
   function process_bulk_action()
   {
	   global $wpdb;
	   $table_name = $wpdb->prefix . 'submissions'; // do not forget about tables prefix

	   if ('delete' === $this->current_action()) {
		   $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
		   if (is_array($ids)) $ids = implode(',', $ids);

		   if (!empty($ids)) {
			   $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
		   }
	   }
   }

   /**
	* [REQUIRED] This is the most important method
	*
	* It will get rows from database and prepare them to be showed in table
	*/
   function prepare_items()
   {
	   global $wpdb;
	   $table_name = $wpdb->prefix . 'submissions'; // do not forget about tables prefix

	   $per_page = 20; // constant, how much records will be shown per page

	   $columns = $this->get_columns();
	   $hidden = array();
	   $sortable = $this->get_sortable_columns();
	   $catselect = $_GET['catselect'];

	   // here we configure table headers, defined in our methods
	   $this->_column_headers = array($columns, $hidden, $sortable);

	   // [OPTIONAL] process bulk action if any
	   $this->process_bulk_action();

	   // will be used in pagination settings
	   $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

	   // prepare query params, as usual current page, order by and order direction
	   $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged'] - 1) * $per_page) : 0;
	   $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
	   $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'DESC';

	   // [REQUIRED] define $items array
	   // notice that last argument is ARRAY_A, so we will retrieve array
	   $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE `service` LIKE '%$catselect%' ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);

	   // [REQUIRED] configure pagination
	   $this->set_pagination_args(array(
		   'total_items' => $total_items, // total items defined above
		   'per_page' => $per_page, // per page constant defined at top of method
		   'total_pages' => ceil($total_items / $per_page) // calculate pages count
	   ));
   }
}

/**
* PART 3. Admin page
* ============================================================================
*
* In this part you are going to add admin page for custom table
*
* http://codex.wordpress.org/Administration_Menus
*/

/**
* admin_menu hook implementation, will add pages to list submissions and to add new one
*/
function cltd_example_admin_menu()
{
   add_menu_page(__('submissions', 'cltd_example'), __('Bookings', 'cltd_example'), 'activate_plugins', 'submissions', 'cltd_example_submissions_page_handler');
   add_submenu_page('submissions', __('Bookings', 'cltd_example'), __('Bookings', 'cltd_example'), 'activate_plugins', 'submissions', 'cltd_example_submissions_page_handler');
   // add new will be described in next part
   add_submenu_page('submissions', __('Add new', 'cltd_example'), __('Add new', 'cltd_example'), 'activate_plugins', 'submissions_form', 'cltd_example_submissions_form_page_handler');
}

add_action('admin_menu', 'cltd_example_admin_menu');


/**
* List page handler
*
* This function renders our custom table
* Notice how we display message about successfull deletion
* Actualy this is very easy, and you can add as many features
* as you want.
*
* Look into /wp-admin/includes/class-wp-*-list-table.php for examples
*/
function cltd_example_submissions_page_handler()
{
   global $wpdb;

   $table = new Custom_Table_Example_List_Table();
   $table->prepare_items();

   $message = '';
   if ('delete' === $table->current_action()) {
	   $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'cltd_example'), count($_REQUEST['id'])) . '</p></div>';
   }
 
   ?>
<div class="wrap">

   <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
   <h2><?php _e('Bookings', 'cltd_example')?> <a class="add-new-h2"
								href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=submissions_form');?>"><?php _e('Add new', 'cltd_example')?></a>
   </h2>
   
	<a href="/wp-admin/export_csv.php" class="page-title-action"><?php _e('Export to CSV','Form_Submissions');?></a>

	<a href="/wp-admin/admin.php?page=submissions&catselect=Drivers" class="page-title-action">Drivers</a>

	<a href="/wp-admin/admin.php?page=submissions&catselect=Transfer" class="page-title-action">Transfer</a>

	<a href="/wp-admin/admin.php?page=submissions&catselect=Pick-up" class="page-title-action">Pick-up</a>

	<a href="/wp-admin/admin.php?page=submissions&catselect=Cars" class="page-title-action">Cars</a>

	<a href="/wp-admin/admin.php?page=submissions&catselect=Scooters" class="page-title-action">Scooters</a>

   <?php echo $message; ?>

   <form id="submissions-table" method="GET">
	   <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
	   <?php $table->display() ?>
   </form>

</div>
<?php
}

/**
* PART 4. Form for adding andor editing row
* ============================================================================
*
* In this part you are going to add admin page for adding andor editing items
* You cant put all form into this function, but in this example form will
* be placed into meta box, and if you want you can split your form into
* as many meta boxes as you want
*
* http://codex.wordpress.org/Data_Validation
* http://codex.wordpress.org/Function_Reference/selected
*/

/**
* Form page handler checks is there some data posted and tries to save it
* Also it renders basic wrapper in which we are callin meta box render
*/
function cltd_example_submissions_form_page_handler()
{   

   global $wpdb;
   $table_name = $wpdb->prefix . 'submissions'; // do not forget about tables prefix

   $message = '';
   $notice = '';

   // this is default $item which will be used for new records
   $default = array(
	   'id' => 0,
	   'name' => '',
	   'email' => '',
	   'phone' => '',
	   'service' => '',
	   'vehicle' => '',
	   'pickup_time' => '',
	   'return_time' => '',
	   'pickup' => '',
	   'destination' => '',	   
   );

   // here we are verifying does this request is post back and have correct nonce
   if ( isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
	   // combine our default item with request params
	   $item = shortcode_atts($default, $_REQUEST);
	   // validate data, and if all ok save item to database
	   // if id is zero insert otherwise update
	   $item_valid = cltd_example_validate_submission($item);
	   if ($item_valid === true) {
		   if ($item['id'] == 0) {
			   $result = $wpdb->insert($table_name, $item);
			   $item['id'] = $wpdb->insert_id;
			   if ($result) {
				   $message = __('Item was successfully saved', 'cltd_example');
			   } else {
				   $notice = __('There was an error while saving item', 'cltd_example');
			   }
		   } else {
			   $result = $wpdb->update($table_name, $item, array('id' => $item['id']));
			   if ($result) {
				   $message = __('Item was successfully updated', 'cltd_example');
			   } else {
				   $notice = __('There was an error while updating item', 'cltd_example');
			   }
		   }
	   } else {
		   // if $item_valid not true it contains error message(s)
		   $notice = $item_valid;
	   }
   }
   else {
	   // if this is not post back we load item to edit or give new one to create
	   $item = $default;
	   if (isset($_REQUEST['id'])) {
		   $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST['id']), ARRAY_A);
		   if (!$item) {
			   $item = $default;
			   $notice = __('Item not found', 'cltd_example');
		   }
	   }
   }

   // here we adding our custom meta box
   add_meta_box('submissions_form_meta_box', 'Booking data', 'cltd_example_submissions_form_meta_box_handler', 'submission', 'normal', 'default');

   ?>
<div class="wrap">
   <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
   <h2><?php _e('Booking', 'cltd_example')?> <a class="add-new-h2"
							   href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=submissions');?>"><?php _e('back to list', 'cltd_example')?></a>
   </h2>

   <?php if (!empty($notice)): ?>
   <div id="notice" class="error"><p><?php echo $notice ?></p></div>
   <?php endif;?>
   <?php if (!empty($message)): ?>
   <div id="message" class="updated"><p><?php echo $message ?></p></div>
   <?php endif;?>


 
   <form id="form" method="POST">
	   <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
	   <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
	   <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>
	   <div class="metabox-holder" id="poststuff">
		   <div id="post-body">
			   <div id="post-body-content">
				   <?php /* And here we call our custom meta box */ ?>
				   <?php do_meta_boxes('submission', 'normal', $item); ?>
				   <input type="submit" value="<?php _e('Save', 'cltd_example')?>" id="submit" class="button-primary" name="submit">
			   </div>
		   </div>
	   </div>
   </form>
</div>
<?php
}

/**
* This function renders our custom meta box
* $item is row
*
* @param $item
*/
function cltd_example_submissions_form_meta_box_handler($item)
{
   ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
   <tbody>
   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="name"><?php _e('Name', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="name" name="name" type="text" style="width: 95%" value="<?php echo esc_attr($item['name'])?>"
				  size="50" class="code" placeholder="<?php _e('Your name', 'cltd_example')?>" required>
	   </td>
   </tr>
   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="email"><?php _e('E-Mail', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="email" name="email" type="email" style="width: 95%" value="<?php echo esc_attr($item['email'])?>"
				  size="50" class="code" placeholder="<?php _e('Your E-Mail', 'cltd_example')?>" required>
	   </td>
   </tr>

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="phone"><?php _e('Phone', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="phone" name="phone" type="tel" style="width: 95%" value="<?php echo esc_attr($item['phone'])?>"
				  size="50" class="code" placeholder="<?php _e('Your Phone', 'cltd_example')?>" required>
	   </td>
   </tr>

	

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="service"><?php _e('Service', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="service" name="service" type="tel" style="width: 95%" value="<?php echo esc_attr($item['service'])?>"
				  size="50" class="code" placeholder="<?php _e('Service', 'cltd_example')?>" >
	   </td>
   </tr>

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="vehicle"><?php _e('Vehicle', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="vehicle" name="vehicle" type="tel" style="width: 95%" value="<?php echo esc_attr($item['vehicle'])?>"
				  size="50" class="code" placeholder="<?php _e('Vehicle', 'cltd_example')?>" >
	   </td>
   </tr>

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="pickup_time"><?php _e('Pick-up time', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="pickup_time" name="pickup_time" type="tel" style="width: 95%" value="<?php echo esc_attr($item['pickup_time'])?>"
				  size="50" class="code" placeholder="<?php _e('Pick-up time', 'cltd_example')?>" >
	   </td>
   </tr>

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="return_time"><?php _e('Return time', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="return_time" name="return_time" type="tel" style="width: 95%" value="<?php echo esc_attr($item['return_time'])?>"
				  size="50" class="code" placeholder="<?php _e('Return time', 'cltd_example')?>" >
	   </td>
   </tr>

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="pickup"><?php _e('Pickup', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="pickup" name="pickup" type="tel" style="width: 95%" value="<?php echo esc_attr($item['pickup'])?>"
				  size="50" class="code" placeholder="<?php _e('Pickup', 'cltd_example')?>" >
	   </td>
   </tr>

   <tr class="form-field">
	   <th valign="top" scope="row">
		   <label for="destination"><?php _e('Destination', 'cltd_example')?></label>
	   </th>
	   <td>
		   <input id="destination" name="destination" type="tel" style="width: 95%" value="<?php echo esc_attr($item['destination'])?>"
				  size="50" class="code" placeholder="<?php _e('Destination', 'cltd_example')?>">
	   </td>
   </tr>
   
   </tbody>
</table>
<?php
}

/**
* Simple function that validates data and retrieve bool on success
* and error message(s) on error
*
* @param $item
* @return bool|string
*/
function cltd_example_validate_submission($item)
{
   $messages = array();

   if (empty($item['name'])) $messages[] = __('Name is required', 'cltd_example');
   if (!empty($item['email']) && !is_email($item['email'])) $messages[] = __('E-Mail is in wrong format', 'cltd_example');
   // if (!ctype_digit($item['fromaddress'])) $messages[] = __('Address in wrong format', 'cltd_example');
   //if(!empty($item['fromaddress']) && !absint(intval($item['fromaddress'])))  $messages[] = __('Age can not be less than zero');
   //if(!empty($item['fromaddress']) && !preg_match('/[0-9]+/', $item['fromaddress'])) $messages[] = __('Age must be number');
   //...
  
   if (empty($messages)) return true;
   return implode('<br />', $messages);

}