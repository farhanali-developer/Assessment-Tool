<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/admin
 * @author     Farhan Ali <farhan@logikware.tech>
 */
class Assessment_tool_Admin {

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
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

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
		 * defined in Assessment_tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Assessment_tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/assessment_tool-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css", array(), $this->version, 'all' );

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
		 * defined in Assessment_tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Assessment_tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/assessment_tool-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js", array( 'jquery' ), $this->version, true );

	}

	function admin_menu(){
		add_menu_page( "Assessment Tool", "Assessment Tool", "manage_options", "assessment_tool", "assessment_tool_function", "dashicons-forms", "15" );
		add_submenu_page( "assessment_tool", "Assessment Form", "Assessment Form", "manage_options", "assessment_form", "assessment_form_function");
		add_submenu_page( "assessment_tool", "Settings", "Settings", "manage_options", "settings", "settings_function");
	}



}

function assessment_tool_function(){
	return "";
}

function assessment_form_function(){
?>
	<div class="container-fluid mt-5">
		<div class="row mx-auto justify-content-between">
			<div class="col-12 col-md-5 offset-md-2">
				<form>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1">
					</div>
					<div class="mb-3 form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Check me out</label>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="col-12 col-md-3">	
				<div class="card text-dark bg-light mb-3 p-0">
					<div class="card-header">Display Form</div>
					<div class="card-body">
						<h5 class="card-title">Form Shortcode</h5>
						<input class="form-control" value="[assessment_tool]" readonly/>
						<p class="card-text mt-3">This must be used on a page where your assessment form can be found - otherwise this plugin won't know where to display the form.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

function settings_function(){
?>
<div class="container-fluid mt-5">
	<div class="row mx-auto">
		<div class="col-12 col-md-4 offset-md-2">
			<h1>Assessment Tool Settings</h1>
			<form>
				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<div id="emailHelp" class="form-text">This email address will be used to send assessment tool results.</div>
				</div>
				<div class="mb-3">
					<h2>Form Styles</h2>
					<label class="mt-3">Theme:</label>
					<select id="theme_selector" class="form-control">
						<option value="default">Default</option>
						<option value="arrows" selected="">Arrows</option>
						<option value="dots">Dots</option>
						<option value="progress">Progress</option>
					</select>
					
					<label class="mt-3">Animation:</label>
					<select id="animation" class="form-control">
						<option value="none">None</option>
						<option value="fade">Fade</option>
						<option value="slide-horizontal" selected="">Slide Horizontal</option>
						<option value="slide-vertical">Slide Vertical</option>
						<option value="slide-swing">Slide Swing</option>
					</select>
					
					<div class="custom-control custom-checkbox mt-3">
						<input type="checkbox" class="custom-control-input" id="is_justified" value="1" checked="" data-np-checked="1">
						<label class="custom-control-label" for="is_justified">Justified</label>
					</div>

					<div class="custom-control custom-checkbox mt-3 mb-3">
						<input type="checkbox" class="custom-control-input" id="dark_mode" value="1" data-np-checked="1">
						<label class="custom-control-label" for="dark_mode">Dark Mode</label>
					</div>
					
					<span>An example of these stylings can be found out at: </span><a target="_blank" href="http://techlaboratory.net/jquery-smartwizard">Click Here</a>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
<?php
}
