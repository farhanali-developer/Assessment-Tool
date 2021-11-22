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


<?php
		//getting file path to send form data
		$dir = plugin_dir_url( __FILE__ ) . "formdata.php";
	?>

	<div class="container-fluid mt-5">
		<div class="row mx-auto justify-content-between">
			<h2>Assessment Tool Form</h2>
			<div class="col-12 col-md-9">
				<form class="repeater" id="assessment_backend_form" method="POST" action="<?php echo $dir; ?>">
    				<div data-repeater-list="outer-list">
      					<div data-repeater-item class="card mw-100 p-0 mt-0 mb-5">
							  
						  	<div class="row mx-auto w-100 justify-content-center align-items-center card-header">
								  <div class="col-12 col-md-10">
								  	<h5>Tab Name</h5>
								  </div>
								  <div class="col-12 col-md-2">
								  	<input data-repeater-delete type="button" class="btn btn-outline-danger w-100" value="Delete Tab"/>
								  </div>
							  </div>

							<div class="card-body p-3">
							<div class="row mx-auto justify-content-start w-100 mt-2">
								<div class="col-12 col-md-10">
									<input type="text" class="form-control" name="text-input" placeholder="Add Tab Name *" required />
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
											<input type="text" name="inner-text-marks" class="form-control" min="0" placeholder="Marks" />
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



	<script>
		jQuery("#assessment_backend_form").submit(function(e){
			e.preventDefault();
			var formData = jQuery(".repeater").repeaterVal();
			// console.log(formData);
			ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
			$.ajax({
			method: "POST",
			url: ajaxurl,
			data: formData,
			success: function (data) {
				console.log("Form is submitted");
				//window.location.href =
				//"../wp-content/plugins/assessment_tool/admin/formdata.php";
				console.log(data); 
			},
			error: function (jqXHR, exception) {
				console.log(jqXHR);
				// Your error handling logic here..
			},
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
					<tr>
						<td>1</td>
						<td>System Architect</td>
						<td>(470)839-2692</td>
						<td>prudence.parker@mertz.net</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Accountant</td>
						<td>(505)530-4575</td>
						<td>wterry@gmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>3</td>
						<td>Junior Technical Author</td>
						<td>(407)825-4022</td>
						<td>elenor.nolan@schmeler.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Senior Javascript Developer</td>
						<td>(501)665-8399</td>
						<td>nkeeling@rolfson.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>5</td>
						<td>Accountant</td>
						<td>(260)357-2557</td>
						<td>mckenzie.melody@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Integration Specialist</td>
						<td>(214)799-4522</td>
						<td>kshlerin.marcella@abshire.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>7</td>
						<td>Sales Assistant</td>
						<td>(575)394-4638</td>
						<td>streich.meghan@kertzmann.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>8</td>
						<td>Integration Specialist</td>
						<td>(615)430-9078</td>
						<td>tressa55@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>9</td>
						<td>Javascript Developer</td>
						<td>(502)639-4513</td>
						<td>carter.andreanne@schulist.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>10</td>
						<td>Software Engineer</td>
						<td>(208)351-5350</td>
						<td>jerod22@bauch.org</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>11</td>
						<td>Office Manager</td>
						<td>(774)305-1070</td>
						<td>filiberto.stamm@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>12</td>
						<td>Support Lead</td>
						<td>(805)202-9053</td>
						<td>fsanford@rolfson.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>13</td>
						<td>Regional Director</td>
						<td>(206)533-3668</td>
						<td>jermaine.lemke@stehr.info</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>14</td>
						<td>Senior Marketing Designer</td>
						<td>(432)556-7910</td>
						<td>eriberto.ernser@bernhard.biz</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>15</td>
						<td>Regional Director</td>
						<td>(270)920-7447</td>
						<td>ursula.graham@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>16</td>
						<td>Marketing Designer</td>
						<td>(248)802-7272</td>
						<td>prudence.abshire@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>17</td>
						<td>Chief Financial Officer (CFO)</td>
						<td>(716)325-7308</td>
						<td>muriel.aufderhar@sauer.info</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>18</td>
						<td>Systems Administrator</td>
						<td>(225)268-3839</td>
						<td>abdullah27@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>19</td>
						<td>Software Engineer</td>
						<td>(209)569-6808</td>
						<td>welch.enola@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>20</td>
						<td>Personnel Lead</td>
						<td>(252)671-2748</td>
						<td>batz.presley@rutherford.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>21</td>
						<td>Development Lead</td>
						<td>(470)839-2692</td>
						<td>schroeder.opal@torp.org</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>22</td>
						<td>Chief Marketing Officer (CMO)</td>
						<td>(505)530-4575</td>
						<td>mlarkin@goldner.biz</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>23</td>
						<td>Pre-Sales Support</td>
						<td>(407)825-4022</td>
						<td>albert.carter@keebler.info</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>24</td>
						<td>Sales Assistant</td>
						<td>(501)665-8399</td>
						<td>jschowalter@casper.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>25</td>
						<td>Chief Executive Officer (CEO)</td>
						<td>(260)357-2557</td>
						<td>feeney.polly@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>26</td>
						<td>Developer</td>
						<td>(214)799-4522</td>
						<td>ggreenholt@hodkiewicz.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>27</td>
						<td>Regional Director</td>
						<td>(575)394-4638</td>
						<td>loy06@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>28</td>
						<td>Software Engineer</td>
						<td>(615)430-9078</td>
						<td>arlene49@gmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>29</td>
						<td>Chief Operating Officer (COO)</td>
						<td>(502)639-4513</td>
						<td>iking@ondricka.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>30</td>
						<td>Regional Marketing</td>
						<td>(208)351-5350</td>
						<td>qreinger@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>31</td>
						<td>Integration Specialist</td>
						<td>(774)305-1070</td>
						<td>cremin.quincy@kuphal.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>32</td>
						<td>Developer</td>
						<td>(805)202-9053</td>
						<td>boyer.abigail@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>33</td>
						<td>Technical Author</td>
						<td>(206)533-3668</td>
						<td>kschumm@gmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>34</td>
						<td>Team Leader</td>
						<td>(432)556-7910</td>
						<td>mcclure.maximillia@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>35</td>
						<td>Post-Sales support</td>
						<td>(248)802-7272</td>
						<td>zkiehn@lakin.info</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
						</tr>
					<tr>
						<td>36</td>
						<td>Marketing Designer</td>
						<td>(270)920-7447</td>
						<td>braden.schiller@harris.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>37</td>
						<td>Office Manager</td>
						<td>(716)325-7308</td>
						<td>ukunde@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>38</td>
						<td>Secretary</td>
						<td>(225)268-3839</td>
						<td>wiza.sam@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>39</td>
						<td>Financial Controller</td>
						<td>(209)569-6808</td>
						<td>dewayne87@will.org</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>40</td>
						<td>Office Manager</td>
						<td>(252)671-2748</td>
						<td>billy12@hills.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>41</td>
						<td>Director</td>
						<td>(509)633-5633</td>
						<td>nikolaus.miller@gmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>42</td>
						<td>Support Engineer</td>
						<td>(513)819-4217</td>
						<td>nels.rowe@yahoo.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>43</td>
						<td>Software Engineer</td>
						<td>(407)699-2419</td>
						<td>rtillman@gmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>44</td>
						<td>Support Engineer</td>
						<td>(608)261-4991</td>
						<td>mgrimes@goodwin.biz</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>45</td>
						<td>Developer</td>
						<td>(541)898-7271</td>
						<td>hugh57@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>46</td>
						<td>Support Engineer</td>
						<td>(417)874-6478</td>
						<td>beverly.conn@gulgowski.info</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>47</td>
						<td>Data Coordinator</td>
						<td>(512)470-5250</td>
						<td>beverly.conn@gulgowski.info</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>48</td>
						<td>Software Engineer</td>
						<td>(716)373-1649</td>
						<td>briana.wolf@gmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>49</td>
						<td>Software Engineer</td>
						<td>(309)677-1768</td>
						<td>teresa89@ullrich.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
					<tr>
						<td>50</td>
						<td>Junior Javascript Developer</td>
						<td>(618)234-4328</td>
						<td>kaylin.bruen@hotmail.com</td>
						<td><input class="form-check-input" type="checkbox" value=""></td>
					</tr>
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
		</div>
	</div>
</div>
<?php
}
