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

		wp_enqueue_script( "jquery", "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js", array( 'jquery' ), true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/assessment_tool-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "repeater", "https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js", array( 'jquery' ), $this->version, true );

	}

	function admin_menu(){
		add_menu_page( "Assessment Tool", "Assessment Tool", "manage_options", "assessment_tool", "assessment_form_function", "dashicons-forms", "15" );
		add_submenu_page( "assessment_tool", "Assessment Form", "Assessment Form", "manage_options", "assessment_tool", "assessment_form_function");
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





			<div class="repeater-default">
                            <div data-repeater-list="car">
                                <div data-repeater-item="">
                                    <form class="form repeater row AVAST_PAM_loginform" data-nordpass-autofill="login" data-np-checked="1" data-nordpass-watching="1">
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="email-addr">Email address</label>
                                            <br>
                                            <input type="email" class="form-control" id="email-addr" placeholder="Enter email" data-np-checked="1" data-nordpass-autofill="username" data-nordpass-uid="zpk92xes7zi" autocomplete="off">
                                        <span data-nordpass-uid="zpk92xes7zi" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="pass">Password</label>
                                            <br>
                                            <input type="password" class="form-control" id="pass" placeholder="Password" data-np-checked="1" data-nordpass-autofill="password" data-nordpass-uid="6g6e44j1obk" autocomplete="off">
                                        <span data-nordpass-uid="6g6e44j1obk" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="bio" class="cursor-pointer">Bio</label>
                                            <br>
                                            <textarea class="form-control" id="bio" rows="2"></textarea>
                                        </div>
                                        <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                            <label for="tel-input">Gender</label>
                                            <br>
                                            <input class="form-control" type="tel" value="1-(555)-555-5555" id="tel-input" data-np-checked="1">
                                        </div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="profession">Profession</label>
                                            <br>
                                            <select class="form-control" id="profession">
                                              <option>Select Option</option>
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                              <option>Option 4</option>
                                              <option>Option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                            <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="feather icon-x"></i> Delete</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            <div data-repeater-item="" style="">
                                    <form class="form row AVAST_PAM_loginform" data-nordpass-autofill="identity" data-np-checked="1" data-nordpass-watching="1">
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="email-addr">Email address</label>
                                            <br>
                                            <input type="email" class="form-control" id="email-addr" placeholder="Enter email" data-np-checked="1" data-nordpass-autofill="identity_email" data-nordpass-uid="nhqa3fj5gzs" autocomplete="off">
                                        <span data-nordpass-uid="nhqa3fj5gzs" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="pass">Password</label>
                                            <br>
                                            <input type="password" class="form-control" id="pass" placeholder="Password" data-np-checked="1">
                                        </div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="bio" class="cursor-pointer">Bio</label>
                                            <br>
                                            <textarea class="form-control" id="bio" rows="2"></textarea>
                                        </div>
                                        <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                            <label for="tel-input">Gender</label>
                                            <br>
                                            <input class="form-control" type="tel" value="1-(555)-555-5555" id="tel-input" data-np-checked="1" data-nordpass-autofill="identity_phone_number" data-nordpass-uid="ihefqe7iat" autocomplete="off">
                                        <span data-nordpass-uid="ihefqe7iat" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="profession">Profession</label>
                                            <br>
                                            <select class="form-control" id="profession">
                                              <option>Select Option</option>
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                              <option>Option 4</option>
                                              <option>Option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                            <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="feather icon-x"></i> Delete</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div><div data-repeater-item="" style="">
                                    <form class="form row AVAST_PAM_loginform" data-nordpass-autofill="identity" data-np-checked="1" data-nordpass-watching="1">
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="email-addr">Email address</label>
                                            <br>
                                            <input type="email" class="form-control" id="email-addr" placeholder="Enter email" data-np-checked="1" data-nordpass-autofill="identity_email" data-nordpass-uid="buhwjqv71xu" autocomplete="off">
                                        <span data-nordpass-uid="buhwjqv71xu" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="pass">Password</label>
                                            <br>
                                            <input type="password" class="form-control" id="pass" placeholder="Password" data-np-checked="1">
                                        </div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="bio" class="cursor-pointer">Bio</label>
                                            <br>
                                            <textarea class="form-control" id="bio" rows="2"></textarea>
                                        </div>
                                        <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                            <label for="tel-input">Gender</label>
                                            <br>
                                            <input class="form-control" type="tel" value="1-(555)-555-5555" id="tel-input" data-np-checked="1" data-nordpass-autofill="identity_phone_number" data-nordpass-uid="p9pngrfqz6" autocomplete="off">
                                        <span data-nordpass-uid="p9pngrfqz6" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="profession">Profession</label>
                                            <br>
                                            <select class="form-control" id="profession">
                                              <option>Select Option</option>
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                              <option>Option 4</option>
                                              <option>Option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                            <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="feather icon-x"></i> Delete</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div><div data-repeater-item="" style="">
                                    <form class="form row AVAST_PAM_loginform" data-nordpass-autofill="identity" data-np-checked="1" data-nordpass-watching="1">
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="email-addr">Email address</label>
                                            <br>
                                            <input type="email" class="form-control" id="email-addr" placeholder="Enter email" data-np-checked="1" data-nordpass-autofill="identity_email" data-nordpass-uid="8b4o8rhf39x" autocomplete="off">
                                        <span data-nordpass-uid="8b4o8rhf39x" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="pass">Password</label>
                                            <br>
                                            <input type="password" class="form-control" id="pass" placeholder="Password" data-np-checked="1">
                                        </div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="bio" class="cursor-pointer">Bio</label>
                                            <br>
                                            <textarea class="form-control" id="bio" rows="2"></textarea>
                                        </div>
                                        <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                            <label for="tel-input">Gender</label>
                                            <br>
                                            <input class="form-control" type="tel" value="1-(555)-555-5555" id="tel-input" data-np-checked="1" data-nordpass-autofill="identity_phone_number" data-nordpass-uid="ctwzeu324o" autocomplete="off">
                                        <span data-nordpass-uid="ctwzeu324o" style="width: 24px; min-width: 24px; height: 24px; background-image: url(&quot;chrome-extension://fooolghllnmhmmndgjiamiiodkpenpbb/icons/icon.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: auto; border: none; display: inline; visibility: visible; position: absolute; cursor: pointer; z-index: 1001; padding: 0px; transition: none 0s ease 0s; pointer-events: all; left: 203.766px; top: 34.5px;"></span></div>
                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                            <label for="profession">Profession</label>
                                            <br>
                                            <select class="form-control" id="profession">
                                              <option>Select Option</option>
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                              <option>Option 4</option>
                                              <option>Option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                            <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="feather icon-x"></i> Delete</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div></div>
                            <div class="form-group overflow-hidden">
                                <div class="col-12">
                                    <button data-repeater-create="" class="btn btn-primary btn-lg">
                                        <i class="icon-plus4"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>






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
