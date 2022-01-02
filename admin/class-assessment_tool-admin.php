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

		
		
		$screen = get_current_screen();

		if ( $screen->id == 'toplevel_page_assessment_tool' || $screen->id == 'assessment-tool_page_assessment_tool_all_tabs' || $screen->id == 'assessment-tool_page_assessment_tool_settings' || $screen->id == 'assessment-tool_page_assessment_tool_users' || $screen->id == 'assessment-tool_page_assessment_tool_entries'){

			wp_enqueue_style( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css", array(), $this->version, 'all' );
			wp_enqueue_style( "sweetalert2", "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.min.css", array(), $this->version, 'all' );
			wp_enqueue_style( "dataTable", "https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css", array(), $this->version, 'all' );
			wp_enqueue_style( "fontawesome", "https://use.fontawesome.com/releases/v5.6.3/css/all.css", array(), $this->version, 'all' );

			// wp_enqueue_style( "bootstrap", plugins_url() . '/assessment_tool/assets/bootstrap/css/bootstrap.min.css', array(), $this->version, 'all' );
			// wp_enqueue_style( "sweetalert2", plugins_url() . '/assessment_tool/assets/sweetalert2/sweetalert2.min.css', array(), $this->version, 'all' );
			// wp_enqueue_style( "datatables", plugins_url() . '/assessment_tool/assets/dataTables/datatables.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/assessment_tool-admin.css', array(), $this->version, 'all' );

		}
		
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

		

		
		$screen = get_current_screen();
		
		if ( $screen->id == 'toplevel_page_assessment_tool' || $screen->id == 'assessment-tool_page_assessment_tool_all_tabs' || $screen->id == 'assessment-tool_page_assessment_tool_settings' || $screen->id == 'assessment-tool_page_assessment_tool_users' || $screen->id == 'assessment-tool_page_assessment_tool_entries'){

			wp_enqueue_script( "at_jquery", "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js", array( 'jquery' ), $this->version, true );
			wp_enqueue_script( "bootstrap", "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js", array( 'jquery' ), $this->version, true );
			wp_enqueue_script( "dataTable", "https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js", array( 'jquery' ), $this->version, true );
			wp_enqueue_script( "repeater", "https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js", array( 'jquery' ), $this->version, true );
			wp_enqueue_script( "sweetalert2", "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.all.min.js", array( 'jquery' ), $this->version, true );
			// wp_enqueue_script( "jquery", plugins_url() . '/assessment_tool/assets/jquery/jquery.min.js', array( 'jquery' ), $this->version, true );
			// wp_enqueue_script( "bootstrap-bundle", plugins_url() . '/assessment_tool/assets/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, true );
			// wp_enqueue_script( "datatables", plugins_url() . '/assessment_tool/assets/dataTables/datatables.min.js', array( 'jquery' ), $this->version, true );
			// wp_enqueue_script( "jquery-repeater", plugins_url() . '/assessment_tool/assets/repeaterJs/jquery.repeater.min.js', array( 'jquery' ), $this->version, true );
			// wp_enqueue_script( "sweetalert2", plugins_url() . '/assessment_tool/assets/sweetalert2/sweetalert2.all.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/assessment_tool-admin.js', array( 'jquery' ), $this->version, true );

		}


		// Pass ajax_url to script.js
		wp_localize_script( 'plugin-ajax', 'plugin_ajax_object',
		array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

	function admin_menu(){
		add_menu_page( "Assessment Tool", "Assessment Tool", "manage_options", "assessment_tool", "assessment_form_add_new_tab", "dashicons-forms", "15" );
		add_submenu_page( "assessment_tool", "Add New Tab", "Add New Tab", "manage_options", "assessment_tool", "assessment_form_add_new_tab");
		add_submenu_page( "assessment_tool", "All Tabs", "All Tabs", "manage_options", "assessment_tool_all_tabs", "all_tabs_function");
		add_submenu_page( "assessment_tool", "Users", "Users", "manage_options", "assessment_tool_users", "users_function");
		add_submenu_page( "assessment_tool", "Entries", "Entries", "manage_options", "assessment_tool_entries", "entries_function");
		add_submenu_page( "assessment_tool", "Settings", "Settings", "manage_options", "assessment_tool_settings", "settings_function");
	}



}

function entries_function(){
?>
<div class="container mt-5 pt-5">
	<div class="row mx-auto justify-content-center">
		<div class="col-lg-12">
			<form id="all-entries">
			</form>
		</div>
	</div>
</div>

<?php
$getUsersFormData = plugin_dir_url( __FILE__ ) . "getUsersFormData.php";
$postUsersFormData = plugin_dir_url( __FILE__ ) . "postUsersFormData.php";
$deleteUsersFormData = plugin_dir_url( __FILE__ ) . "deleteUsersFormData.php";
?>
<script>
	jQuery(document).ready(function($){
		function getFormData(){

			let getUsersFormData = "<?php echo $getUsersFormData; ?>";
			jQuery.ajax({
				"method" : "GET",
				"url": getUsersFormData,
				"async" : true,
				dataType: "html",
				success : function(data){
					jQuery("#all-entries").html(data);

					  // This section makes the search work.
					(function () {
						var searchTerm, panelContainerId;
						$("#accordion_search_bar").on("change keyup", function () {
							searchTerm = $(this).val();
							$("#usersaccordion > .accordion-item").each(function () {
								panelContainerId = "#" + $(this).attr("id");

								// Makes search to be case insesitive
								$.extend($.expr[":"], {
								contains: function (elem, i, match, array) {
									return (
									(elem.textContent || elem.innerText || "")
										.toLowerCase()
										.indexOf((match[3] || "").toLowerCase()) >= 0
									);
								},
								});

								// END Makes search to be case insesitive

								// Show and Hide Triggers
								$(panelContainerId + ":not(:contains(" + searchTerm + "))").hide(); //Hide the rows that done contain the search query.
								$(panelContainerId + ":contains(" + searchTerm + ")").show(); //Show the rows that do!
							});
						});
					})();
					// End Show and Hide Triggers

					$('select').on('change', function() {
						$(this).closest('.user').addClass('changed');
					});

					deleteEntry();
				},
				error: function (jqXHR, exception) {
					console.log(jqXHR);
				}
			});

		}
		
		getFormData();

		var delete_user;
		function deleteEntry(){
			$(".delete-entry").on("click", function(){
				delete_user = $(this).attr("delete-user-id");

				Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					if (result.isConfirmed) {
						deleteAjax();
						Swal.fire(
						'Deleted!',
						'Entry deleted.',
						'success'
						)
					}
				})
			});
		}

		function deleteAjax(){
			let deleteUsersFormData = "<?php echo $deleteUsersFormData; ?>";
			var deleteEntryFormData = new FormData();
			deleteEntryFormData.append('data',JSON.stringify(delete_user));

			$.ajax({
				method: "POST",
				url: deleteUsersFormData,
				data: deleteEntryFormData,
				processData: false,
				contentType: false,
				success: function(data){
					console.log(data);
					$(this).hide();
					getFormData();
				},
				error: function(jqXHR, exception){
					console.log(jqXHR);
				}
			});
		}

		

		

		$("#all-entries").submit(function(e){
			e.preventDefault();
			var formdata = []; // This has all info, logged at the bottom

			$(".changed").each(function(index,value){
				var single_user = {
					user: '',
					userid : '',
					tabs : [],
				};
				index = index+1;
				var user_id = $(this).attr("user_id");
				var user = "user"+user_id;
				single_user.userid = user_id;
				single_user.user = user;

				$(".changed[user_id = "+ user_id +"] .tab .accordion").each(function(index,value){
					var single_tab = {
						tabid : '',
						questions : [],
					}
					var tab_id = $(this).attr('tab_id');
					single_tab.tabid = tab_id;

					$(".changed[user_id = "+ user_id +"] #tabsaccordion[tab_id = "+ tab_id +"] .question").each(function(index,value){
						var single_question = {
							questionid : '',
							answer : '',
							marks: ''
						} 
						var entry_id = $(this).attr("entry_id");
						var question_id = $(this).attr("question_id");
						var question_marks = $('option:selected',this).attr('question_marks');
						// var answer = $(".user[user_id = "+ user_id +"] > #tabsaccordion[tab_id = "+ tab_id +"] .question[question_id = "+ question_id +"] .form-select option:selected").text();
						var answer = $(".form-select option:selected", this).text();

						single_question = {
							entry_id: entry_id,
							questionid: question_id,
							answer: answer,
							question_marks : question_marks
						}

						single_tab.questions.push(single_question);
					});

					single_user.tabs.push(single_tab);					
				
				});
				formdata.push(single_user);	
			});
			
			let postUsersFormData = "<?php echo $postUsersFormData; ?>";

			var updateEntryFormData = new FormData();
			updateEntryFormData.append('data',JSON.stringify(formdata));

			
			jQuery.ajax({
				method : "POST",
				url: postUsersFormData,
				data : updateEntryFormData,
				processData: false,
				contentType: false,
				success : function(data){
					// jQuery("#all-entries").html(data);
					console.log(data);
					getFormData();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						customClass: {
							container: "mt-4",
						},
					});
					Toast.fire({
						icon: "success",
						title: "User Updated Successfully",
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
						customClass: {
							container: "mt-4",
						},
					});
					Toast.fire({
						icon: "error",
						title: "User updated Failed",
					});
				}
			});		

		});

	});
</script>
<?php
}
function all_tabs_function(){
?>
<div class="container-fluid mt-5">
		<div class="row mx-auto justify-content-between">
			<div class="col-12 col-md-9">
				<form class="repeater" id="tabs_and_questions">
					<div data-repeater-list="outer-list">
						<?php
							global $wpdb;
							$wpdb->hide_errors();
							$tabs_table = 'assessment_tool_tabs';
							$questions_table = 'assessment_tool_questions';
							$charset_collate = $wpdb->get_charset_collate();

							require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

							$tabs = $wpdb->get_results("SELECT * FROM assessment_tool_tabs");

							if($tabs){
								foreach($tabs as $tabs_name => $tabs_data){
									$tab_id = $tabs_data->id;
									$tab = $tabs_data->tab_name;
									$chapter_title = $tabs_data->chapter_title;
									$description = $tabs_data->tab_description;
									
						?>
						<div data-repeater-item class="card mw-100 p-0 mt-0 mb-5">  
							<div class="row mx-auto w-100 justify-content-center align-items-center card-header">
								<div class="col-12 col-md-10">
									<input type="hidden" name="text-input-id" value="<?php echo $tab_id; ?>"/>
									<h5><?php echo $tab; ?></h5>
								</div>
								<div class="col-12 col-md-2">
									<input data-repeater-delete type="button" class="btn btn-outline-danger w-100 delete-tab" tab-id="<?php echo $tab_id; ?>" value="Delete Tab"/>
								</div>
							</div>

							<div class="card-body p-3">
								<div class="row mx-auto justify-content-start w-100 mt-2">
									<div class="col-12 col-md-10">
										<input type="text" class="form-control" name="text-input" placeholder="Add Tab Name *" value="<?php echo $tab; ?>" required />
										<input type="text" class="form-control mt-3" name="text-input-chapter" placeholder="Add Chapter Title *" value="<?php echo $chapter_title; ?>" required />
										<input class="form-control mt-3 mb-3" type="text" name="text-input-description" placeholder="Tab Description" value="<?php echo $description; ?>" />
									</div>
								</div>
								<!-- innner repeater -->
								<div class="inner-repeater">
									<div data-repeater-list="inner-list">
										<?php
											$questions = $wpdb->get_results("SELECT * FROM assessment_tool_questions WHERE tab_id = $tab_id");
											foreach($questions as $questions_name => $questions_data){
												$question_id = $questions_data->id;
												$question = $questions_data->question;
												$marks = $questions_data->marks;
										?>
											<div data-repeater-item class="row mx-auto justify-content-center w-100 mt-2 questions" question-id="<?php echo $question_id; ?>">
												<div class="col-12 col-md-8">
													<input type="hidden" name="inner-text-id" value="<?php echo $question_id; ?>"/>
													<input type="text" name="inner-text-input" class="form-control" placeholder="Question *" value="<?php echo $question; ?>" required />
												</div>
												<div class="col-12 col-md-2">
													<input type="text" name="inner-text-marks" class="form-control marks" min="0" placeholder="Marks" value="<?php echo $marks; ?>" />
													<p class="font-weight-normal mt-1 mb-0">Default marks are 0.</p>
												</div>
												<div class="col-12 col-md-2">
													<input data-repeater-delete type="button" class="btn btn-danger w-100 delete-question" question-id="<?php echo $question_id; ?>" value="Delete Question"/>
												</div>
											</div>
										<?php
										}
										?>
									</div>
									<div class="row mx-auto justify-content-start">
										<div class="col-12 col-md-2">
											<input data-repeater-create type="button" class="btn btn-primary mt-2" value="Add New Question"/>
										</div>
									</div>
								</div>
							</div>
						</div>
									<?php
									} 
									?>
					</div>
					<div class="d-flex justify-content-center update-form-btn">
						<input type="submit" class="btn btn-success mb-3" value="Update Form"/>
					</div>
						<?php
						}
						?>	
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
				<div class="alert alert-success mt-3" role="alert">
					<h4 class="alert-heading">Note!</h4>
					<p>To delete a tab or a question, just click on the <br /> <span class="fw-bold">Delete Tab</span> / <span class="fw-bold">Delete Question</span> button respectively. There is no need to click on <span class="fw-bold">Update Form</span> button.</p>
					<p>If <span class="fw-bold">Delete Tab</span> button is pressed, all the questions of that tab along with Tab itself will be deleted.</p>
					<hr>
					<p class="mb-0">If you change data from any tab or question, in that case, click on <span class="fw-bold">Update Form</span> button once you are done.</p>
				</div>
			</div>
		</div>
	</div>

	<?php
		//getting file path to send form data
		$getFormData = plugin_dir_url( __FILE__ ) . "getFormData.php";
		$updateFormData = plugin_dir_url( __FILE__ ) . "updateFormData.php";
		$deleteTab = plugin_dir_url( __FILE__ ) . "deleteTab.php";
		$deleteQuestion = plugin_dir_url( __FILE__ ) . "deleteQuestion.php";
	?>
	<script>

		var getFormData = "<?php echo $getFormData; ?>";

		jQuery(document).ready(function(){
			jQuery.ajax({
				"method" : "GET",
				"url": getFormData,
				"async" : true,
				dataType: "html",
				success : function(data){
					console.log("Form Data Fetched.");
					// console.log(data);
					//jQuery("#tabs_and_questions div[data-repeater-list='outer-list']").html(data);
				},
				error: function (jqXHR, exception) {
					console.log(jqXHR);
				}
			});
		});

		jQuery(".delete-question").click(function(e){
			e.preventDefault();
			let questionUrl = "<?php echo $deleteQuestion ?>";
			let deletequestion = jQuery(this).attr("question-id");

			jQuery.ajax({
				method: "POST",
				url: questionUrl,
				data: {"questionId": deletequestion},
				success: function (data) {
					// console.log(data);
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						customClass: {
							container: "mt-4",
						},
					});
					Toast.fire({
						icon: "success",
						title: "Question Deleted Successfully",
					});
					console.log("Question Deleted.");
				},
				error: function (jqXHR, exception) {
					console.log(jqXHR);
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						customClass: {
							container: "mt-4",
						},
					});
					Toast.fire({
						icon: "error",
						title: "Question Deleting Failed",
					});
				}
			});
		});

		jQuery(".delete-tab").click(function(){
			let tabUrl = "<?php echo $deleteTab ?>";
			let deletetabid = jQuery(this).attr("tab-id");
			let questionsid = [];
			let thisdata = jQuery(this).parent().parent().parent().children().children(".inner-repeater").children().children(".questions");
			
			jQuery(thisdata).each(function(){
				let id = jQuery(this).attr("question-id")
				questionsid.push(id);
			});
			
			jQuery.ajax({
				method: "POST",
				url: tabUrl,
				data: {
					"tabId": deletetabid,
					"questionsid": questionsid
				},
				success: function (data) {
					// console.log(data);
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						customClass: {
							container: "mt-4",
						},
					});
					Toast.fire({
						icon: "success",
						title: "Tab Deleted Successfully.",
					});
					console.log("Tabs and Questions Deleted Successfully.");
				},
				error: function (jqXHR, exception) {
					console.log(jqXHR);

					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						customClass: {
							container: "mt-4",
						},
					});
					Toast.fire({
						icon: "success",
						title: "Tab Deletition Failed",
					});
				}
			});
		});


		

			jQuery("#tabs_and_questions").submit(function(e){
				e.preventDefault();
				var updateFormdata = "<?php echo $updateFormData ?>";
				var updateFormData1 = jQuery('form#tabs_and_questions.repeater').repeaterVal();
				var updateFormData = new FormData();
				updateFormData.append('data',JSON.stringify(updateFormData1));

				jQuery.ajax({
					method: "POST",
					url: updateFormdata,
					data: updateFormData,
					processData: false,
					contentType: false,
					success: function (data) {
						console.log("Form Again Updated.");

						jQuery('div[data-repeater-list="outer-list"]').empty();
						jQuery(".update-form-btn").remove();
						jQuery('div[data-repeater-list="outer-list"]').html(data);

						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 4000,
							timerProgressBar: true,
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

		



	</script>
<?php
}

// function assessment_tool_function(){
// 	return "";
// }

function assessment_form_add_new_tab(){
?>
	<div class="container-fluid mt-5">
		<div class="row mx-auto justify-content-between">
			<div class="col-12 col-md-9">
				<form class="repeater" id="assessment_backend_form">
    				<div data-repeater-list="outer-list">
      					<div data-repeater-item class="card mw-100 p-0 mt-0 mb-5">
							  
						  	<div class="row mx-auto w-100 justify-content-center align-items-center card-header">
								  <div class="col-12 col-md-10">
								  	<h5>New Tab</h5>
								  </div>
								  <div class="col-12 col-md-2">
								  	<input data-repeater-delete type="button" class="btn btn-outline-danger w-100" value="Delete Tab"/>
								  </div>
							  </div>

							<div class="card-body p-3">
							<div class="row mx-auto justify-content-start w-100 mt-2">
								<div class="col-12 col-md-10">
									<input type="text" class="form-control" name="text-input" placeholder="Add Tab Name *" required />
									<input type="text" class="form-control mt-3" name="text-input-chapter" placeholder="Add Chapter Title *" required />
									<input class="form-control mt-3 mb-3" type="text" name="text-input-description" placeholder="Tab Description" />
								</div>
							</div>

							<!-- innner repeater -->
							<div class="inner-repeater">
								<div data-repeater-list="inner-list">
									<div data-repeater-item class="row mx-auto justify-content-center w-100 mt-2">
										<div class="col-12 col-md-8">
											<input type="text" name="inner-text-input" class="form-control" placeholder="Question *" required />
										</div>
										<div class="col-12 col-md-2">
											<input type="text" name="inner-text-marks" class="form-control marks" min="0" placeholder="Marks" />
											<p class="font-weight-normal mt-1 mb-0">Default marks are 0.</p>
										</div>
										<div class="col-12 col-md-2">
											<input data-repeater-delete type="button" class="btn btn-danger w-100" value="Delete Question"/>
										</div>
									</div>
								</div>
								<div class="row mx-auto justify-content-start">
									<div class="col-12 col-md-2">
										<input data-repeater-create type="button" class="btn btn-primary mt-2" value="Add New Question"/>
									</div>
								</div>
							</div>
							</div>
      					</div>
    				</div>
    				<div class="d-flex justify-content-between">
						<input type="submit" class="btn btn-success mb-3" value="Submit Form"/>
						<input data-repeater-create type="button" class="btn btn-dark text-white mb-3" value="Add New Tab"/>
					</div>
				</form>
            </div>
		</div>
	</div>


	<?php
		//getting file path to send form data
		$formdata = plugin_dir_url( __FILE__ ) . "formdata.php";
	?>
	<script>
		jQuery("#assessment_backend_form").submit(function(e){
			e.preventDefault();
			var formdata = "<?php echo $formdata ?>";
			var formData1 = jQuery('#assessment_backend_form').repeaterVal();
			var formData = new FormData();

			formData.append('data',JSON.stringify(formData1));

			jQuery.ajax({
				method: "POST",
				url: formdata,
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					console.log(data);
					jQuery("#assessment_backend_form input[type='text']").val('')
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
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
	</script>
<?php
}

function settings_function(){
?>
<div class="container-fluid mt-5">
	<div class="row mx-auto">
		<div class="col-12 col-md-4 offset-md-3">
			<h1>Assessment Tool Settings</h1>
			<form class="settings-form">
				
			</form>
		</div>
	</div>
</div>
<?php
	//getting file path to send form data
	$settingsUrl = plugin_dir_url( __FILE__ ) . "settings.php";
	$getSettingsUrl = plugin_dir_url( __FILE__ ) . "getSettings.php";
?>
<script>
function getSettings(){
	var getSettingsUrl = "<?php echo $getSettingsUrl; ?>";
	jQuery.ajax({
		"method" : "GET",
		"url": getSettingsUrl,
		"async" : true,
		dataType: "html",
		success : function(data){
			console.log("Users Data Fetched.");
			// console.log(data);
			jQuery(".settings-form").html(data);
		},
		error: function (jqXHR, exception) {
			console.log(jqXHR);
		}
	});
}

jQuery(document).ready(function(){
	getSettings();
});



jQuery(".settings-form").submit(function(e){
	e.preventDefault();
	var settingsUrl = "<?php echo $settingsUrl ?>";
	let emailsubject = jQuery(".emailsubject").val();
	let theme = jQuery("#theme_selector").find(":selected").text();
	let animation = jQuery("#animation").find(":selected").text();
	let animation_speed = jQuery("#animation_speed").val();
	let alignment = jQuery("#is_justified").is(":checked");
	let dark_mode = jQuery("#dark_mode").is(":checked");
	let welcome_screen_text = jQuery("#welcome_screen_text").val();
	let end_screen_text = jQuery("#end_screen_text").val();

	jQuery.ajax({
		method: "POST",
		url: settingsUrl,
		data: {
			"subject" : emailsubject,
			"theme": theme,
			"animation": animation,
			"animation_speed" : animation_speed,
			"alignment" : alignment,
			"dark_mode" : dark_mode,
			"welcome_screen_text" : welcome_screen_text,
			"end_screen_text" : end_screen_text
		},
		success: function (data) {

			const Toast = Swal.mixin({
				toast: true,
				position: "top-end",
				showConfirmButton: false,
				timer: 4000,
				timerProgressBar: true,
				customClass: {
					container: "mt-4",
				},
			});
			Toast.fire({
				icon: "success",
				title: "Form Updated.",
			});

			getSettings();

		},
		error: function (jqXHR, exception) {
			console.log(jqXHR);
			const Toast = Swal.mixin({
				toast: true,
				position: "top-end",
				showConfirmButton: false,
				timer: 4000,
				timerProgressBar: true,
				customClass: {
					container: "mt-4",
				},
			});
			Toast.fire({
				icon: "error",
				title: "Form Update Failed.",
			});

			getSettings();
		}
	});
});
</script>
<?php
}

function users_function(){
?>
<div class="container-fluid mt-5">
	<div class="row mx-auto justify-content-center">
		<div class="col-11">
			<form class="users">
			<table id="dtBasicExample" class="table table-striped table-bordered table-sm cell-border hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">ID</th>
						<th class="th-sm">Full Name</th>
						<th class="th-sm">Phone Number</th>
						<th class="th-sm">Email</th>
						<th class="th-sm">Submitted On</th>
						<th class="th-sm"><input class="form-check-input all-retake" type="checkbox"> Allow Retake</th>
						<th class="th-sm">Submitted Entry</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
						<th class="th-sm">ID</th>
						<th class="th-sm">Full Name</th>
						<th class="th-sm">Phone Number</th>
						<th class="th-sm">Email</th>
						<th class="th-sm">Submitted On</th>
						<th class="th-sm"><input class="form-check-input all-retake" type="checkbox"> Allow Retake</th>
						<th class="th-sm">Submitted Entry</th>
					</tr>
				</tfoot>
			</table>
			<input class="btn btn-success text-right" type="submit" id="update-users" value="Update Users"/>
			</form>
		</div>
	</div>
</div>

<?php
	//getting file path to send form data
	$getUsersUrl = plugin_dir_url( __FILE__ ) . "getUsers.php";
	$postUsersUrl = plugin_dir_url( __FILE__ ) . "postUsers.php";
?>
<script>
	var getUsersUrl = "<?php echo $getUsersUrl; ?>";
	var postUsersUrl = "<?php echo $postUsersUrl; ?>";

	

	jQuery(".users").submit(function(e){
		e.preventDefault();
		var retake_values = [];

		var table = jQuery("#dtBasicExample").DataTable({
			"destroy": true
		});
		jQuery(".dataTables_length").addClass("bs-select");


		table.$("input.allow-retake[type='checkbox']").each(function(){

			if(jQuery(this).prop("checked")){
				let chkbox_id = jQuery(this).attr("id");
				var single_retake = {
					"id" : chkbox_id,
					"value" : 1
				}
				retake_values.push(single_retake);
			}
			else{
				let chkbox_id = jQuery(this).attr("id");
				var single_retake = {
					"id" : chkbox_id,
					"value" : 0
				}
				retake_values.push(single_retake);
			}
		});

		var formData = new FormData();

		formData.append('data',JSON.stringify(retake_values));

		jQuery.ajax({
			"method" : "POST",
			"url" : postUsersUrl,
			"data" : formData,
			processData: false,
			contentType: false,
			cache: false,
			success: function(data){
				jQuery("#dtBasicExample tbody").html(data);

				const Toast = Swal.mixin({
					toast: true,
					position: "top-end",
					showConfirmButton: false,
					timer: 4000,
					timerProgressBar: true,
					customClass: {
						container: "mt-4",
					},
				});
				Toast.fire({
					icon: "success",
					title: "Users Updated.",
				});

				jQuery("#dtBasicExample").DataTable({
					"destroy": true
				});
  				jQuery(".dataTables_length").addClass("bs-select");
			},
			error: function (jqXHR, exception) {
				console.log(jqXHR);

				const Toast = Swal.mixin({
					toast: true,
					position: "top-end",
					showConfirmButton: false,
					timer: 4000,
					timerProgressBar: true,
					customClass: {
						container: "mt-4",
					},
				});
				Toast.fire({
					icon: "error",
					title: "Failed to update. Please try again.",
				});

				jQuery("#dtBasicExample").DataTable({
					"destroy": true,
				});
  				jQuery(".dataTables_length").addClass("bs-select");
			}
		});
	});


		
	jQuery(document).ready(function(){

		jQuery.ajax({
			"method" : "GET",
			"url": getUsersUrl,
			"async" : true,
			dataType: "html",
			success : function(data){
				console.log("Data Fetched.");
				console.log(data);
				// console.log(data);
				jQuery("#dtBasicExample tbody").html(data);
				
				var table = jQuery("#dtBasicExample").DataTable({
					"destroy": true
				});
				jQuery(".dataTables_length").addClass("bs-select");


				// Handle click on "Select all" control
				$(".all-retake").on("click", function () {
					// Check/uncheck all checkboxes in the table
					var rows = table.rows({ search: "applied" }).nodes();
					$('input[type="checkbox"]', rows).prop("checked", this.checked);
				});

				// Handle click on checkbox to set state of "Select all" control
				$("#dtBasicExample tbody").on(
					"change",
					'input[type="checkbox"]',
					function () {
					// If checkbox is not checked
					if (!this.checked) {
						var el = $(".all-retake").get(0);
						// If "Select all" control is checked and has 'indeterminate' property
						if (el && el.checked && "indeterminate" in el) {
						// Set visual state of "Select all" control
						// as 'indeterminate'
						el.indeterminate = true;
						}
					}
					}
				);
					
			},
			error: function (jqXHR, exception) {
				console.log(jqXHR);
				jQuery("#dtBasicExample").DataTable({
					"destroy": true,
				});
  				jQuery(".dataTables_length").addClass("bs-select");
			}
		});
		
	});
</script>
<?php
}
