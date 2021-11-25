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

		wp_enqueue_style( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( "sweetalert2", "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( "dataTable", "https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css", array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/assessment_tool-admin.css', array(), $this->version, 'all' );

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

		wp_enqueue_script( "at_jquery", "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "dataTable", "https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "repeater", "https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "sweetalert2", "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.all.min.js", array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/assessment_tool-admin.js', array( 'jquery' ), $this->version, true );

		
		// Pass ajax_url to script.js
		wp_localize_script( 'plugin-ajax', 'plugin_ajax_object',
		array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

	function admin_menu(){
		add_menu_page( "Assessment Tool", "Assessment Tool", "manage_options", "assessment_tool", "assessment_form_function", "dashicons-forms", "15" );
		add_submenu_page( "assessment_tool", "Assessment Form", "Assessment Form", "manage_options", "assessment_tool", "assessment_form_function");
		add_submenu_page( "assessment_tool", "Settings", "Settings", "manage_options", "settings", "settings_function");
		add_submenu_page( "assessment_tool", "Users", "Users", "manage_options", "users", "users_function");
	}



}

function assessment_tool_function(){
	return "";
}

function assessment_form_function(){
?>




	<div class="container-fluid mt-5">
		<div class="row mx-auto justify-content-between">
			<h2>Assessment Tool Form</h2>
			<div class="col-12 col-md-9">
				<form class="repeater" id="assessment_backend_form">



				<?php
				global $wpdb;
				$wpdb->hide_errors();
				$tabs_table = 'assessment_tool_tabs';
				$questions_table = 'assessment_tool_questions';
				$charset_collate = $wpdb->get_charset_collate();
		
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

				$tabs = $wpdb->get_results("SELECT * FROM assessment_tool_tabs");
				$questions = $wpdb->get_results("SELECT * FROM assessment_tool_questions");
				?>
    				<div data-repeater-list="outer-list">
						<?php
							foreach($tabs as $tabs_name => $tabs_data){
								$tab = $tabs_data->tab_name;
								$description = $tabs_data->tab_description;
							
						?>
								<div data-repeater-item class="card mw-100 p-0 mt-0 mb-5">  
									<div class="row mx-auto w-100 justify-content-center align-items-center card-header">
										<div class="col-12 col-md-10">
											<h5><?php echo $tab; ?></h5>
										</div>
										<div class="col-12 col-md-2">
											<input data-repeater-delete type="button" class="btn btn-outline-danger w-100" value="Delete Tab"/>
										</div>
									</div>

									<div class="card-body p-3">
									<div class="row mx-auto justify-content-start w-100 mt-2">
										<div class="col-12 col-md-10">
											<input type="text" class="form-control" name="text-input" placeholder="Add Tab Name *" value="<?php echo $tab; ?>" required />
											<input class="form-control mt-3 mb-3" type="text" name="text-input-description" placeholder="Tab Description" value="<?php echo $description; ?>" />
										</div>
									</div>
									<?php
										foreach($questions as $questions_name => $questions_data){
											$question = $questions_data->question;
											$marks = $questions_data->marks;
									?>
									<!-- innner repeater -->
									<div class="inner-repeater">
										<div data-repeater-list="inner-list">
											<div data-repeater-item class="row mx-auto justify-content-center w-100 mt-2">
												<div class="col-12 col-md-8">
													<input type="text" name="inner-text-input" class="form-control" placeholder="Question *" value="<?php echo $question; ?>" required />
												</div>
												<div class="col-12 col-md-2">
													<input type="text" name="inner-text-marks" class="form-control" min="0" placeholder="Marks" value="<?php echo $marks; ?>" />
													<p class="font-weight-normal mt-1 mb-0">Default marks are 0.</p>
												</div>
												<div class="col-12 col-md-2">
													<input data-repeater-delete type="button" class="btn btn-danger w-100" value="Delete Question"/>
												</div>
											</div>
										</div>
										
									</div>
									<?php
									}
									?>
									<div class="row mx-auto justify-content-start">
											<div class="col-12 col-md-2">
												<input data-repeater-create type="button" class="btn btn-primary mt-2" value="Add New Question"/>
											</div>
										</div>
									</div>
								</div>
						  <?php
						 } 
						  ?>
    				</div>
    				<div class="d-flex justify-content-between">
						<input type="submit" class="btn btn-success mb-3" value="Submit Form"/>
						<input data-repeater-create type="button" class="btn btn-dark text-white mb-3" value="Add New Tab"/>
					</div>
				</form>
            </div>
            <div class="col-12 col-md-3">
                <div class="card text-dark bg-light mt-0 p-0">
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
		//getting file path to send form data
		$dir = plugin_dir_url( __FILE__ ) . "formdata.php";
	?>
	<script>
		jQuery("#assessment_backend_form").submit(function(e){
			e.preventDefault();
			var form = "<?php echo $dir ?>";
			var formData1 = $('.repeater').repeaterVal();
			var formData = new FormData();

			formData.append('data',JSON.stringify(formData1));

			$.ajax({
				method: "POST",
				url: form,
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					console.log(data);
					// window.location.href = "../wp-content/plugins/assessment_tool/admin/formdata.php";
					console.log("Form is submitted");



					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						// didOpen: (toast) => {
						//   toast.addEventListener("mouseenter", Swal.stopTimer);
						//   toast.addEventListener("mouseleave", Swal.resumeTimer);
						// },
						customClass: {
						container: "mt-4",
						},
					});
					Toast.fire({
						icon: "success",
						title: "Form Submitted Successfully",
					});





				},
				error: function (jqXHR, exception) {
					console.log(jqXHR);

					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						// didOpen: (toast) => {
						//   toast.addEventListener("mouseenter", Swal.stopTimer);
						//   toast.addEventListener("mouseleave", Swal.resumeTimer);
						// },
						customClass: {
						container: "mt-4",
						},
					});
					Toast.fire({
						icon: "error",
						title: "There is some error in the form. Please try again.",
					});

				}
			});
		});

				
				
				
// 		});
	</script>
<?php
}

function settings_function(){
?>
<div class="container-fluid mt-5">
	<div class="row mx-auto">
		<div class="col-12 col-md-4 offset-md-3">
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
					<select id="theme_selector" class="form-control mw-100">
						<option value="default">Default</option>
						<option value="arrows" selected="">Arrows</option>
						<option value="dots">Dots</option>
						<option value="progress">Progress</option>
					</select>
					
					<label class="mt-3">Animation:</label>
					<select id="animation" class="form-control mw-100">
						<option value="none">None</option>
						<option value="fade">Fade</option>
						<option value="slide-horizontal" selected="">Slide Horizontal</option>
						<option value="slide-vertical">Slide Vertical</option>
						<option value="slide-swing">Slide Swing</option>
					</select>

					<label class="mt-3">Animation:</label>
					<input type="number" class="form-control" placeholder="2" />
					<span>Please provide animated speed in seconds i.e 1 = 1seconds or 5 = 5seconds</span>
					
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

function users_function(){
?>
<div class="container mt-5">
	<div class="row mx-auto justify-content-center">
		<div class="col-12">
			<table id="dtBasicExample" class="table table-striped table-bordered table-sm cell-border hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">ID</th>
						<th class="th-sm">Full Name</th>
						<th class="th-sm">Phone Number</th>
						<th class="th-sm">Email</th>
						<th class="th-sm"><input class="form-check-input" type="checkbox" value=""> Allow Retake</th>
					</tr>
				</thead>
				<tbody>
				<?php
					global $wpdb;
					$wpdb->hide_errors();
					$users_table = 'assessment_tool_users';
					$charset_collate = $wpdb->get_charset_collate();
			
					require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

					$users = $wpdb->get_results("SELECT * FROM assessment_tool_users");

					foreach($users as $col => $val){
						$user_id = $val->user_id;
						$full_name = $val->full_name;
						$phone_number = $val->phone_number;
						$user_email = $val->user_email;
						$allow_retake = $val->allow_retake;
					?>
					<tr>
						<td><?php echo $user_id; ?></td>
						<td><?php echo $full_name; ?></td>
						<td><a class="text-dark" href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a></td>
						<td><a class="text-dark" href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></td>
						<td><input class="form-check-input" type="checkbox" value="" <?php echo $allow_retake ? 'checked' : '' ?> ></td>
					</tr>
					<?php
					}
				?>	
				</tbody>
				<tfoot>
					<tr>
						<th class="th-sm">ID</th>
						<th class="th-sm">Full Name</th>
						<th class="th-sm">Phone Number</th>
						<th class="th-sm">Email</th>
						<th class="th-sm"><input class="form-check-input" type="checkbox" value=""> Allow Retake</th>
					</tr>
				</tfoot>
			</table>
			<button class="btn btn-success text-right">Submit</button>
		</div>
	</div>
</div>
<?php
}







