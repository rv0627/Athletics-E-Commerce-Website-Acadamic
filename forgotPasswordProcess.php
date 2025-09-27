<?php

require "connection.php";


require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;



if (isset($_GET["e"])) {
    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ravindumaleesha06270107@gmail.com';
        $mail->Password = 'pfarqgtzucyhmytn';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ravindumaleesha06270107@gmail.com', 'Athletex Reset Password');
        $mail->addReplyTo('ravindumaleesha06270107@gmail.com', 'Athletex Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Athletex Forgot Password Verification Code';
        $logoPath = 'resources/logo/athletex-logo.svg';
        // Add the inline attachment
        // $mail->addEmbeddedImage($logoPath, 'logo_cid');
        $bodyContent = '
            <div style="font-family: Arial, sans-serif; padding: 20px; border: 1px solid #e0e0e0; border-radius: 5px; background-color: #f9f9f9;">
               <div style="text-align: center; margin-bottom: 20px;">
                   <img src="https://myrepublica.nagariknetwork.com/uploads/media/sports_20230518163956.jpg" class="img-fluid" style="height:300px;width:350px;">
                </div>
                <h4 style="color: black; text-align: center;">Your Verification Code is: <span style="color:red;">' . $code . '</span></h4>
                <p style="font-size: 16px; color: #333333; text-align: center;">
                Please use this verification code to reset your password.
                </p>
            </div>
            ';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification code sending failed");
        } else {
            echo ("Success");
        }
    } else {
        echo ("Invalid Email Address");
    }
} else {
    echo ("Enter email.");
}
