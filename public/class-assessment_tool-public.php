<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/public
 * @author     Farhan Ali <farhan@logikware.tech>
 */
class Assessment_tool_Public {

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

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		

		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/assessment_tool-public-display.php';

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
		 * defined in Assessment_tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Assessment_tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( "smart-wizard", "https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( "font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/assessment_tool-public.css', array(), $this->version, 'all' );

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
		 * defined in Assessment_tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Assessment_tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( "at_jquery", "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "smart-wizard", "https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js", array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/assessment_tool-public.js', array( 'jquery' ), $this->version, true );
	}

}
