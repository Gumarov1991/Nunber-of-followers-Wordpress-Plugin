<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://number-of-followers.com/author
 * @since      1.0.0
 *
 * @package    Number_Of_Followers
 * @subpackage Number_Of_Followers/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Number_Of_Followers
 * @subpackage Number_Of_Followers/admin
 * @author     Breakout Studio <gumarov2017@yandex.ru>
 */
class Number_Of_Followers_Admin {

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
        $this->my_plugin_options = get_option($this->plugin_name);
        $this->access_token = $this->my_plugin_options['access_token'];

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
		 * defined in Number_Of_Followers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Number_Of_Followers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/number-of-followers-admin.css', array(), $this->version, 'all' );

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
		 * defined in Number_Of_Followers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Number_Of_Followers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/number-of-followers-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function add_plugin_admin_menu() {

        /*
         * Add a settings page for this plugin to the Settings menu.
        */
        add_options_page( 'Info about your instagram profil', 'Menu title', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')

        );

    }

    public function add_action_links( $links ) {

        $settings_link = array(
            '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );

    }

    public function display_plugin_setup_page() {

        include_once( 'partials/number-of-followers-admin-display.php' );

    }

    public function validate($input) {
        $valid = array();
        $valid['access_token'] = (isset($input['access_token']) && !empty($input['access_token'])) ? $input['access_token'] : '';
        return $valid;
    }

    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

    public function get_count_followers() {
        $token = $this->access_token;
        $remote_wp = wp_remote_get("https://api.instagram.com/v1/users/self/?access_token=" . $token );
        $profil = json_decode( $remote_wp['body'] );
        return $profil->data->counts->followed_by;
    }




}
