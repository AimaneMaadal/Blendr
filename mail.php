<?php

	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$token = $_GET["token"];
	$email = $_GET["email"];

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "smtp.hostinger.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Port = "465";
	$mail->Username = "imd@brandish.space";
	$mail->Password = "Brandish.123";
	$mail->Subject = "Reset Password";
	$mail->setFrom('imd@brandish.space');
	$mail->isHTML(true);
	$mail->Body = '<body background-color: #f2f3f8;">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="brandish.space" title="logo" target="_blank">
                            <img width="80" src="https://i.ibb.co/stpj82K/logo-mini.png" title="logo" alt="logo" style="border-radius: 20px;">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <a href="http://brandish.space/newpassword.php?token='.$token.'"
                                            style="background-color:#FBAB7E;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:black; text-decoration: none;"><strong>www.brandish.space</strong></p>
                        </td>
                    </tr>
					<br><br><br>
                </table>
            </td>
        </tr>
    </table>
</body>';
	$mail->addAddress($email);
	if ( $mail->send() ) {
		echo "Email Sent to <b>$email</b> check ur mail";
	}
	$mail->smtpClose();
