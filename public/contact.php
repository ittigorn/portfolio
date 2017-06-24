<?php
	require_once("../_includes/run_first_addon.php"); 
	require_once(SITE_ROOT."_includes/_functions/_classes/mailer.php");

	// SETTING INITIAL PAGE MODE
	$page_mode = "new_entry";

	if ($server->contact_form) {

		// IF GET IS SET
		if (isset($_GET["mode"])) {
			if ($_GET["mode"] === "success") {
				$page_mode = "message_sent";
			}
		}

		// SETTING UP DEFAULT VALUES FOR CONTACT FORM 
		if ($page_mode === "new_entry") {

			$contact_subject 	= 'general';
			$contact_name 		= '';
			$contact_email 		= '';
			$contact_phone 		= '';
			$contact_line		= '';
			$contact_back 		= TRUE;
			$contact_message 	= '';
			$contact_channel 	= array();

			$prepared_message 	= '';

			// IF SUBJECT IS PREDEFINED
			if (isset($_GET["subject"])){
				if ($_GET["subject"] === 'info') {
					$contact_subject = 'info';
					if (isset($_GET['product'])) {
						$prepared_message = ($page->language === 'th') ? 'เกี่ยวกับสินค้า : ' . $_GET['product'] . PHP_EOL . PHP_EOL : 'About product : ' . $_GET['product'] . PHP_EOL . PHP_EOL;
					}
				} // end if
			} // end if

			if(isset($_POST["submit"])) {

				// clean and assign submitted info into variables
				$recaptcha_response = (isset($_POST["g-recaptcha-response"])) ? $_POST["g-recaptcha-response"] : '';
				$contact_subject	= trim(strip_tags($_POST["contact_subject"]));
				$contact_name 		= trim(strip_tags($_POST["contact_name"]));
				$contact_email 		= trim(strip_tags($_POST["contact_email"]));
				$contact_phone 		= trim(strip_tags($_POST["contact_phone"]));
				$contact_line		= trim(strip_tags($_POST["contact_line"]));
				$contact_back 		= isset($_POST["contact_back"]) ? TRUE : FALSE;
				$contact_message 	= trim(strip_tags($_POST["contact_message"]));
				if ($contact_back) { 
					if (isset($_POST["contact_channel"])) {
						foreach ($_POST["contact_channel"] as $value) {
							array_push($contact_channel, strip_tags($value));
						}
					}
				}

				// check reCaptcha
				$recaptcha_validated = $server->validate_recaptcha($recaptcha_response);
				if($recaptcha_validated) {

					$all_required_fields_are_filled = TRUE;
					// check numerous fields
					if (empty($contact_message)) { 
						$page->add_alert("ต้องมีข้อความที่จะส่ง",'Message cannot be empty'); 
						$all_required_fields_are_filled = FALSE;
					}
					elseif (strlen($contact_message) > 20000) {
						$page->add_alert("ข้อความห้ามยาวเกิน 20,000 ตัวอักษร",'Message cannot exceed 20,000 characters'); 
						$all_required_fields_are_filled = FALSE;
					}

					if (!empty($contact_name)) {
						if (strlen($contact_name) > 150) {
							$all_required_fields_are_filled = FALSE;
							$page->add_alert('ความยาวชื่อต้องอยู่ระหว่าง 0-150 ตัวอักษรเท่านั้น','Name can only be 0-150 characters long');
						}
					}

					$email_validated = TRUE;
					$already_added_email_alert = FALSE;
					if (!empty($contact_email)) {
						if (!validate_email($contact_email)) {
							$page->add_alert('กรุณาใส่อีเมลล์ที่ถูกต้อง','Please enter a valid email address');
							$email_validated = FALSE;
							$all_required_fields_are_filled = FALSE;
							$already_added_email_alert = TRUE;
						}
						elseif (strlen($contact_email) > 150) {
							$page->add_alert('กรุณาใส่อีเมลล์ที่ยาวไม่เกิน 150 ตัวอักษร','Email address cannot exceed 150 characters');
							$email_validated = FALSE;
							$all_required_fields_are_filled = FALSE;
						}
					}

					$phone_validated = TRUE;
					$already_added_phone_alert = FALSE;
					if (!empty($contact_phone)) {
						$phone_regex = '/[^0-9]/';
						$phone_numbers_only = preg_replace($phone_regex, '', $contact_phone); 
						if ((strlen($phone_numbers_only) < 9) || (strlen($phone_numbers_only) > 10)) {
							$page->add_alert('กรุณาใส่เบอร์โทรศัพท์ที่ถูกต้อง','Please enter a valid phone number');
							$phone_validated = FALSE;
							$all_required_fields_are_filled = FALSE;
							$already_added_phone_alert = TRUE;
						}
						elseif (strlen($contact_phone) > 20) {
							$page->add_alert('กรุณาใส่เบอร์โทรศัพท์ที่ยาวไม่เกิน 20 ตัวอักษร','Phone number cannot exceed 20 characters');
							$phone_validated = FALSE;
							$all_required_fields_are_filled = FALSE;
						}
					}

					if (!empty($contact_line)) {
						if (strlen($contact_line) > 50) {
							$all_required_fields_are_filled = FALSE;
							$page->add_alert('ความยาวไลน์ไอดีต้องอยู่ระหว่าง 0-50 ตัวอักษรเท่านั้น','Line ID can only be 0-50 characters long');
						}
					}

					if ($contact_back) {
						if (sizeof($contact_channel) === 0) {
							$page->add_alert("กรุณาเลือกช่องทางติดต่อกลับอย่างน้อย 1 ช่องทาง หรือเลือกที่จะไม่ให้เราติดต่อกลับ",'Please choose at least one preferred contact channel or opt-out contact back option');
							$all_required_fields_are_filled = FALSE;
						}
						else {
							if ((in_array('email', $contact_channel)) && ((!$email_validated) || (empty($contact_email)))) {
								if (!$already_added_email_alert) { $page->add_alert('กรุณาใส่อีเมลล์ที่ถูกต้อง','Please enter a valid email address'); }
								$all_required_fields_are_filled = FALSE;
							}
							if ((in_array('phone', $contact_channel)) && ((!$phone_validated) || (empty($contact_phone)))) {
								if (!$already_added_phone_alert) { $page->add_alert('กรุณาใส่เบอร์โทรศัพท์ที่ถูกต้อง','Please enter a valid phone address'); }
								$all_required_fields_are_filled = FALSE;
							}
							if ((in_array('line', $contact_channel)) && (empty($contact_line))) {
								$page->add_alert('กรุณาใส่ไอดีไลน์ที่ถูกต้อง','Please enter a valid Line ID');
								$all_required_fields_are_filled = FALSE;
							}
						} 
					}

					if ($all_required_fields_are_filled) {
						$mailer = new mailer($db);
						if ($mailer->send_contact_form($contact_name,$contact_email,$contact_line,$contact_phone,$contact_back,$contact_channel,$contact_subject,$contact_message)) {
							redirect("contact.php?mode=success");
						}
						else { 
							$page->add_alert("ไม่สามารถส่งข้อความได้",'Message sending failed');
						}
					}

				} // end if
				else { 
					$page->add_alert("กรุณายืนยัน reCaptcha ก่อนส่งข้อความ","Please complete Google's reCaptcha validation before continuing.");
				} // end else

			} // end if submit button is clicked

		} // end if page_mode === "new_entry"
		elseif ($page_mode === "message_sent") {

		} // end elseif 

	} // end if contact form is enabled
	

?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once(SITE_ROOT."_includes/global_header_addon.php"); ?>
	<title>Contact Us</title>

	<!-- Google's reCaptcha Script -->
	<?php if ((($server->host === 'localhost') && ($server->use_recaptcha_localhost)) || (($server->host !== 'localhost') && ($server->use_recaptcha_public))) { ?>
		<script src='https://www.google.com/recaptcha/api.js<?php echo ($page->language === "th") ? "?hl=th" : ''; ?>'></script>
	<?php  } // end if bypass !== TRUE ?>

	<?php if ($page_mode === 'message_sent') { ?>
		<style type="text/css">
			p#space_before_bottom_bar {
				background-color: #FFFFFF !important;
			}
		</style>
	<?php } // end if ?>

</head>
<body lang="<?php echo $page->language; ?>">
<?php require_once(SITE_ROOT."_includes/navigation_bar.php"); ?>
<?php //require_once(SITE_ROOT."_includes/_scripts/facebook_script.php"); ?>

<div id="wrapper">

	<?php
		if ($page_mode === "new_entry") { 
			if ($server->contact_form) {
	?>
			<div class="container-fluid contact_form">
				<div class="row">
					<div class="col-12 col-sm-11 col-md-9 col-lg-8 col-xl-7 col-centered">
						<form method="post" action="contact.php" target="_self">
							<fieldset>

								<legend><?php lang('ติดต่อเรา'); ?></legend>

								<div class="form-group">
									<label class="col control-label"><?php lang("เรื่อง"); ?> *</label>  
									<div class="col inputGroupContainer">
										<select class="custom-select contact_subject" name="contact_subject">
											<option value="general"<?php echo ($contact_subject === 'general') ? ' selected="selected"' : ''; ?>><?php lang('แนะนำ, ติชมทั่วไป'); ?></option>
											<option value="info"<?php echo ($contact_subject === 'info') ? ' selected="selected"' : ''; ?>><?php lang('ขอข้อมูลเพิ่มเติม'); ?></option>
											<option value="complaint"<?php echo ($contact_subject === 'complaint') ? ' selected="selected"' : ''; ?>><?php lang('ร้องเรียน'); ?></option>
										</select>
									</div>
								</div>

								<div class="form-group">
								  <label class="col control-label"><?php lang("ชื่อ"); ?></label>  
								  <div class="col inputGroupContainer">
								  <div class="input-group">
								  <span class="input-group-addon"><i class="fa fa-user"></i></span>
								  <input name="contact_name" class="form-control contact_name" type="text" value="<?php echo $contact_name; ?>" maxlength="150" autofocus>
								    </div>
								  </div>
								</div>


								<!-- Text input-->
								<div class="form-group email">
								  <label class="col control-label"><?php lang("อีเมลล์"); ?></label>  
								    <div class="col inputGroupContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								  		<input name="contact_email" class="form-control"  type="text" value="<?php echo $contact_email; ?>" maxlength="150">
								    </div>
								  </div>
								</div>


								<!-- Text input-->
								<div class="form-group phone">
								  <label class="col control-label"><?php lang("โทรศัพท์ ( ประเทศไทยเท่านั้น )"); ?></label>  
								    <div class="col inputGroupContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
								  		<input name="contact_phone" class="form-control" type="text" value="<?php echo $contact_phone; ?>" maxlength="20">
								    </div>
								  </div>
								</div>

								<!-- Text input-->
								<div class="form-group line">
								  <label class="col control-label"><?php lang("ไอดีไลน์"); ?></label>  
								    <div class="col inputGroupContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="fa fa-comments-o"></i></span>
								  		<input name="contact_line" class="form-control" type="text" value="<?php echo $contact_line; ?>" maxlength="50">
								    </div>
								  </div>
								</div>

								<!-- Text input-->
								<div class="form-group">
								    <div class="col inputGroupContainer">
								    	 <div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input contact_back" name="contact_back" type="checkbox" <?php echo ($contact_back) ? 'checked="checked"' : ''; ?>>
												<?php lang('อนุญาตให้เราติดต่อกลับได้'); ?>
											</label>
										</div>
								  	</div>
								</div>

						        <!-- checkboxes -->
						        <div class="form-group contact_option">
						        	<label class="col control-label"><?php lang("ช่องทางติดต่อที่สะดวก"); ?></label>
						        	<div class="col inputGroupContainer">
								        <div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input contact_back_email" name="contact_channel[]" value="email" type="checkbox" <?php echo (in_array('email', $contact_channel)) ? 'checked="checked"' : ''; ?>>
												<?php lang('อีเมลล์'); ?>
											</label>
										</div>
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input contact_back_phone" name="contact_channel[]" value="phone" type="checkbox" <?php echo (in_array('phone', $contact_channel)) ? 'checked="checked"' : ''; ?>>
												<?php lang('โทรศัพท์'); ?>
											</label>
										</div>
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input contact_back_line" name="contact_channel[]" value="line" type="checkbox" <?php echo (in_array('line', $contact_channel)) ? 'checked="checked"' : ''; ?>>
												<?php lang('ไลน์'); ?>
											</label>
										</div>
									</div>
								</div>

								<!-- Text area -->
								<div class="form-group">
								  <label class="col control-label"><?php lang("ข้อความ"); ?> *</label>
								    <div class="col inputGroupContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
								        	<textarea class="form-control" name="contact_message" rows="10"  maxlength="50000"><?php echo (!empty($prepared_message)) ? $prepared_message : ''; echo $contact_message; ?></textarea>
								  </div>
								  </div>
								</div>

								<?php if ((($server->host === 'localhost') && ($server->use_recaptcha_localhost)) || (($server->host !== 'localhost') && ($server->use_recaptcha_public))) { ?>
									<!-- Google's reCaptcha for localhost -->
									<div class="form-group">
									  <label class="col control-label"></label>
									  <div class="col">
									  	<p class="notice"><?php lang('กรุณายืนยัน reCaptcha ก่อนส่งข้อความ'); ?></p>
									  	<div class="g-recaptcha" data-callback="enable_submit_button" data-sitekey="<?php echo $server->recaptcha_sitekey; ?>"></div>
									  </div>
									</div>
								<?php  } // end if bypass !== TRUE ?>
								
								<!-- Button -->
								<div class="form-group">
								  <label class="col control-label"></label>
								  <div class="col">
								    <button type="submit" id="submit_email" name="submit" class="btn btn-success"><span class="fa fa-send"></span> <?php lang("ส่งข้อความ"); ?></button> 
								    <button type="button" name="clear" class="btn btn-warning clear"><span class="fa fa-times-circle"></span> <?php lang("ล้างข้อมูล"); ?></button>
								  </div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			
			<!-- CUSTOM JQUERY SCRIPTS -->
			<script type="text/javascript">

				function enable_submit_button() {
					$('button#submit_email').prop('disabled', false);
				} // end function

				$(document).ready(function(){

					// show and hide contact_channel
					function validate_contact_channel_checkbox() {
						if($('input.contact_back').is(':checked')){
							$(".contact_option").slideDown(100);
							$(".contact_option input").prop('disabled', false);
							if ((!$('.contact_back_email').is(':checked')) && (!$('.contact_back_phone').is(':checked')) && (!$('.contact_back_line').is(':checked'))) {
								$('.contact_option label').addClass('error');
							}
							else {
								$('.contact_option label').removeClass('error');
							}
						}
						else {
							$(".contact_option input").prop('disabled', true);
							$(".contact_option").slideUp(100);
						}
					}; // end function

					function validate_inputs() { 
						$('input').each(function() {
							if ($(this).attr('name') === 'contact_email') {
								if ($(this).val().trim() !== '') {
									if (validate_email($(this).val())) { // validate the email here
										$(this).removeClass('error');
									}
									else {
										$(this).addClass('error');
									}
								}
								else {
									if ($('input.contact_back_email').is(':checked')) {
										$(this).addClass('error');
									}
									else {
										$(this).removeClass('error');
									}
								}
							} // end if email
							else if ($(this).attr('name') === 'contact_phone') {
								if ($(this).val().trim() !== '') {
										$phone_num = String($(this).val().replace(/[^0-9]/g, ''));
									if (($phone_num.length >= 9) && ($phone_num.length <= 10)) {
										$(this).removeClass('error');
									}
									else {
										$(this).addClass('error');
									}
								}
								else {
									if ($('input.contact_back_phone').is(':checked')) {
										$(this).addClass('error');
									}
									else {
										$(this).removeClass('error');
									}
								}
							} // end if phone
							else if ($(this).attr('name') === 'contact_line') {
								if ($(this).val().trim() !== '') {
									if (1) { // validate the email here
										$(this).removeClass('error');
									}
									else {
										$(this).addClass('error');
									}
								}
								else {
									if ($('input.contact_back_line').is(':checked')) {
										$(this).addClass('error');
									}
									else {
										$(this).removeClass('error');
									}
								}
							} // end if email
						}); // end .each
					} // end functioื

					// initialization
					validate_contact_channel_checkbox(); 
					validate_inputs();

					<?php if ((($server->host === 'localhost') && ($server->use_recaptcha_localhost)) || (($server->host !== 'localhost') && ($server->use_recaptcha_public))) { ?>
						$('button#submit_email').prop('disabled', true);
					<?php } // ebd if ?>

					// events
					$('input').change(function(){
						if ($(this).attr('type') === 'checkbox') {
							validate_contact_channel_checkbox();
							validate_inputs();
						}
					});
					$('input').focusout(function() {
						if ($(this).attr('type') === 'text') {
							validate_contact_channel_checkbox();
							validate_inputs();
						}
					});
					$('textarea').focusout(function() {
						if ($(this).val().trim() === '') {
							$(this).addClass('error');
						}
						else {
							$(this).removeClass('error');
						}
					});

					// if clear is clicked
					$("button.clear").click(function(){
						$("input").each(function(){
							$(this).removeClass('error');
							if ($(this).attr("type") === "text") {
								$(this).val('');
							} // end if
							else if ($(this).attr("type") === "checkbox") {
								$(this).prop('checked', false);
							} // end if
						});
						$("textarea").val('');
						$('textarea').removeClass('error');
						$(".contact_back").prop('checked', true);
						$('.contact_subject').val('general');
						validate_contact_channel_checkbox();
						validate_inputs();
						$('.contact_name').focus();
					}); // end if clear is clicked

				}); // end document ready
			</script>

	<?php 	
				} // end if contact form is enabled
	?>
			<div class="container-fluid">
				<div class="row">
					<div class="company_info col-12">
						<img src="_images/_contact/sakura_branch.png">
						<div class="col-11 col-sm-8 col-md-10 col-lg-10 col-xl-9 col-centered">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-7"></div>
								<div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-5">
									<h2><?php echo htmlspecialchars($server->{'name_' . $page->language}, ENT_COMPAT, 'UTF-8'); ?></h2>
										<p><?php echo htmlspecialchars($server->{'address_' . $page->language}, ENT_COMPAT, 'UTF-8'); ?></p>
										<p><a href="tel:<?php echo $server->phone; ?>"><i class="fa fa-phone"></i> <?php echo phone_format($server->phone); ?></a></p>
										<p><i class="fa fa-envelope"></i> <?php echo htmlspecialchars($server->customer_service_email, ENT_COMPAT, 'UTF-8'); ?></p>
										<p><i class="fa fa-clock-o"></i> <?php echo $server->opening_time; ?> - <?php echo $server->closing_time; ?><?php echo ($page->language === 'th') ? ' น.' : ''; ?></p>
										<p id="store_status_indicator"></p>

										<div class="button_container">
											<a class="line_button" href="http://line.me/ti/p/~<?php echo $server->line; ?>" target="_blank">
												<img src="_images/line.png" title="Official Line Account">
											</a>
											<a class="facebook_button" href="<?php echo $server->facebook; ?>" target="_blank">
												<img src="_images/facebook.png" title="Official Facebook Page">
											</a>
											<a class="instagram_button" href="<?php echo $server->instagram; ?>" target="_blank">
												<img src="_images/instagram.png" title="Official Instagram Page">
											</a>
										</div>
										
										<!-- <div class="line-it-button" data-lang="<?php echo $page->language; ?>" data-type="friend" data-lineid="@yoihouse" style="display: none;"></div>
										<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script> -->
											
										<!-- <span class="d-block"></span>
										<div class="fb-like" data-href="https://www.facebook.com/yoiskincare" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> -->


								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
			<script type="text/javascript">

				$(document).ready(function(){

					var $opening_time = Number(<?php echo $server->opening_time; ?>);
					var $closing_time = Number(<?php echo $server->closing_time; ?>);
					var $force_closed = <?php echo $server->force_closed; ?>;

					// declaring function
					function check_store_open() {
						$date 	= new Date(); // make new date object
						$now 	= ($date.getUTCHours() + ($date.getUTCMinutes() / 100)) + 7; // get UTC time and add 7 to make it this time zone
						if (($now >= $opening_time) && ($now < $closing_time) && ($force_closed != 1)) {
							var $text = "<?php echo ($page->language === 'en') ? "We're open" : "ขณะนี้เราเปิดทำการอยู่"; ?>";
							$('#store_status_indicator').html('<span class="open"><i class="fa fa-check-circle-o"></i> ' + $text + '</span>');
						}
						else {
							var $text = "<?php echo ($page->language === 'en') ? "Sorry, we're closed at this time" : "ขออภัยขณะนี้เราไม่เปิดทำการ"; ?>";
							$('#store_status_indicator').html('<span class="closed"><i class="fa fa-times-circle-o"></i> ' + $text + '</span>');
						}
					}

					check_store_open(); // run once at initialization
					setInterval(function () { check_store_open(); }, 30000); // set to run every 30 seconds

				});

			</script>
	<?php
			} // end if page_mode === "new_entry"
			elseif ($page_mode === "message_sent") {
	?>

	<div class="container-fluid">
		<div class="col success centered">
			<h1><i class="fa fa-check-circle-o" style="color: green; font-size: 1.3em;"></i> <?php lang("ข้อความของคุณได้ถูกส่งเรียบร้อยแล้ว"); ?></h1>
			<h4><?php lang("ขอบคุณที่ติดต่อเรา"); ?></h4>
			<h4>&nbsp;</h4>
			<h4><?php lang("ระบบจะเปลี่ยนหน้าอัตโนมัติใน..."); ?> <span class="countdown">6</span></h4>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			function countdown() {
				var count = 5;
				var countdown = setInterval(function(){
					if (count == 0) {
						clearInterval(countdown);
						window.open('index.php', "_self");
					}
					$("span.countdown").html(count);
					count--;
				}, 1000);
			}
			countdown();
		});
	</script>

	<?php 	} // end if page_mode === "message_sent" ?>

</div> <!-- END WRAPPER HERE -->
<?php require_once(SITE_ROOT."_includes/bottom_bar.php"); ?>
<?php require_once(SITE_ROOT."_includes/global_script.php"); ?>
</body>
</html>