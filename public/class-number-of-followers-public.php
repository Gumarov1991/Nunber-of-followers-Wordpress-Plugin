<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://number-of-followers.com/author
 * @since      1.0.0
 *
 * @package    Number_Of_Followers
 * @subpackage Number_Of_Followers/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Number_Of_Followers
 * @subpackage Number_Of_Followers/public
 * @author     Breakout Studio <gumarov2017@yandex.ru>
 */
class Number_Of_Followers_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->my_plugin_options = get_option($this->plugin_name);
        $this->access_token = $this->my_plugin_options['access_token'];
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/number-of-followers-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/number-of-followers-public.js', array( 'jquery' ), $this->version, false );

	}

    public function register_shortcodes() {
        add_shortcode( 'count_followers', array( $this, 'shortcode_function') );
    }

    public function shortcode_function() {
        return $this->get_count_followers();
    }

    public function get_count_followers() {
        $token = $this->access_token;
        $remote_wp = wp_remote_get("https://api.instagram.com/v1/users/self/?access_token=" . $token );
        $profil = json_decode( $remote_wp['body'] );
        return $profil->data->counts->followed_by;
    }

}
