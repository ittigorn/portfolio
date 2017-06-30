<?php

require_once(SITE_ROOT."_includes/php_mailer/PHPMailerAutoload.php");

class mailer {

	private $customer_service_email;
	private $contact_form_email_destination;

	function __construct($db) {

		global $server;

		$this->mail_header 						= '';
		$this->customer_service_email 			= $server->customer_service_email;
		$this->contact_form_email_destination 	= $server->contact_form_email_destination;

	}// end constructor


	public function send_customer_email($customer_name,$customer_email,$subject,$message) {

		$mail = new PHPMailer;
		$mail->isSendmail();
		$mail->CharSet 	= 'UTF-8'; // Set charset
		$mail->setFrom($this->customer_service_email, 'Ittigorn Tradussadee');
		$mail->isHTML(true);
		$mail->addAddress($customer_email,$customer_name);
		$mail->Subject 	= $subject;
		$mail->Body 	= $message;
		$mail->AltBody 	= strip_tags($mail->Body);

		// send it	
		if(!$mail->send()) {
			// echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		}
		else {
			// echo "Email sent";
			return true;
		}

	}// end function


	public function send_contact_form($sender_name,$sender_email,$sender_line,$sender_phone,$allow_contact,$preferred_contact_channel,$subject,$message) {

		$sender_name = (empty($sender_name)) ? 'N/A' : $sender_name;
		$sender_email = (empty($sender_email)) ? 'N/A' : $sender_email;
		$sender_line = (empty($sender_line)) ? 'N/A' : $sender_line;

		// format subject
		switch ($subject) {
			case 'general':
				$subject = 'General Comment & Suggestions';
				break;

			case 'job':
				$subject = 'Job Inquiry';
				break;

			case 'info':
				$subject = 'Information Inquiry';
				break;

			case 'complaint':
				$subject = 'Complaint';
				break;
			
			default:
				$subject = 'General Comment &amp; Suggestions';
				break;
		}

		// format phone number
		$sender_phone = (empty($sender_phone)) ? 'N/A' : phone_format($sender_phone);

		// format contact channels
		foreach ($preferred_contact_channel as $key => $value) {
			$preferred_contact_channel[$key] = ucfirst($value);
		}
		$preferred_contact_channel = (sizeof($preferred_contact_channel) === 0) ? 'N/A' : implode(', ', $preferred_contact_channel);

		$mail = new PHPMailer;

		$mail->isSendmail();
		$mail->CharSet = 'UTF-8'; // Set charset
		$mail->setFrom($this->customer_service_email, "Portfolio website\'s contact form");
		$mail->isHTML(true);
		$mail->addAddress($this->contact_form_email_destination, 'Ittigorn Tradussadee');

		$mail->Subject = '(Contact Form) '.$subject;

		// ASSEMBLE HTML BODY
		$mail->Body     = "
		<table>
			<tr>
				<th style='text-align: left;'>Sender's Name: </th>
				<td>{$sender_name}</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Sender's Email: </th>
				<td>{$sender_email}</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Sender's Line ID: </th>
				<td>{$sender_line}</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Sender's Phone: </th>
				<td>{$sender_phone}</td>
			</tr>
		";
		if ($allow_contact == TRUE) {
			$mail->Body    .= "
			<tr>
				<th style='text-align: left;'>Allow Contact Back: </th>
				<td>Yes</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Prefered Contact Channel: </th>
				<td>{$preferred_contact_channel}</td>
			</tr>";
		}
		else {
			$mail->Body    .= "
			<tr>
				<th style='text-align: left;'>Allow Contact Back: </th>
				<td>No</td>
			</tr>";
		}
		$mail->Body    .= "
			<tr>
				<th style='text-align: left;'>Message: </th>
				<td>{$message}</td>
			</tr>";
		$mail->Body    .= "</table>";
		// END BODY

		$mail->AltBody = strip_tags($mail->Body);

		// send it	
		if(!$mail->send()) {
			// echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		}

		else {
			// echo "Email sent";
			return true;
		}

	}// end function

}// end mailer class

?>