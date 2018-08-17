<?php
if (isset($_POST["dd"])) {
	$data= json_decode($_POST["dd"]);

	$from= $data->from;
	$subject= $data->subject;
	$to= $data->to;
	$message= $data->message;

	$headers= "MIME-Version: 1.0\r\n";
	$headers.= "From: ". $from ."\r\n";
	$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	foreach ($to as $campaign) {
		$name= $campaign->name;
		$email= $campaign->email;

		//	MESSAGE
		$template= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/><title>Yahia Refaiea - Thanks for joining our two weeks web design</title></head><body style="margin: 0;"><table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="padding: 84px 63px 28px 63px; background-color: #171a19;"><tr><td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" style="min-width: 280px; width: 100%; max-width: 494px; margin: 0 auto;"><tr><td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 21px;"><tr><td align="left" valign="top"><a href="https://yahiarefaiea.com" target="_blank" style="display: block; text-decoration: none; width: 100px;"><img src="https://2wwd.nuotron.co/application/includes/images/mails/signature.png" height="28px" style="display: block; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 400; font-size: 14px; line-height: 28px; color: #fff; white-space: nowrap;" alt="Yahia Refaiea signature" title="Yahia Refaiea signature"/></a></td><td align="right" valign="top"><a href="https://yahiarefaiea.com" target="_blank" style="display: block; text-decoration: none; width: 100px;"><img src="https://2wwd.nuotron.co/application/includes/images/mails/identity.png" height="10px" style="display: block; margin: 9px 0; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 400; font-size: 14px; line-height: 10px; color: #e0a458; white-space: nowrap;" alt="Yahia Refaiea identity" title="Yahia Refaiea identity"/></a></td></tr><tr><td align="left" valign="top" style="padding-top: 42px;"><span style="display: block; font-family: Georgia, sans-serif; font-weight: 700; font-size: 28px; line-height: 42px; color: #fff;">Thanks for joining our two weeks web design</span></td></tr></table><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="top"><span style="display: block; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: 400; font-size: 14px; line-height: 35px; color: #ddd;">';

		$template.= '<span style="display: block; margin-bottom: 7px;">Hi '. $name .'!</span>';

		$template.= $message;
		// $template.= '<span style="display: block; margin-bottom: 7px;">I\'m glad to have the chance to meet such a great person as you in our workshops in September.</span><span style="display: block; margin-bottom: 7px;">I\'m so excited. I\'ll study your application and reach out to you on Thursday, August 16. We have limited seats in our workshops. So, please stay tuned and confirm your acceptance immediately.</span><span style="display: block;">If you have an emergency or something.. please reach me out at:</span><a href="tel:+963962295406" target="_blank" style="display: block; margin-bottom: 7px; color: #e0a458;">(+963) 96 2295 406</a><span style="display: block;">If it’s not.. go ahead and enjoy these funny cats on YouTube:</span><a href="https://youtu.be/HxM46vRJMZs" target="_blank" style="display: block; color: #e0a458;">https://youtu.be/HxM46vRJMZs</a><span style="display: block; margin-top: 21px; font-size: 14px; line-height: 21px; color: #666;">Best wishes.</span>';

		$template.= '</span></td></tr></table></td></tr></table></td></tr></table></body></html>';

		//	SEND MAILS
		mail($email,$subject,$template,$headers);
	}

	//  RESPONSE
	$response_array['status']= 'success';
	echo json_encode($response_array);
}
?>
