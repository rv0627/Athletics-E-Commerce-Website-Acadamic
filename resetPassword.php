<?php

require "connection.php";

$email = $_POST["e"];
$newPassword = $_POST["np"];
$reTypePassword = $_POST["rp"];
$vCode = $_POST["v"];

if(empty($email)){
    echo ("Missing email");
}else if(empty($newPassword)){
    echo ("Enter new password");
}else if(strlen($newPassword) < 5 || strlen($newPassword) > 20){
    echo ("New password must have between 5-20 characters.");
}else if(empty($reTypePassword)){
    echo ("Enter re-type password");
}else if($newPassword != $reTypePassword){
    echo ("Password does not matched.");
}else if(empty($vCode)){
    echo ("Enter verification Code");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code`='".$vCode."' ");
    $n = $rs->num_rows;

    if($n == 1){
        
        Database::iud("UPDATE `user` SET `password`='".$newPassword."' WHERE `email`='".$email."' ");
        echo("Password reset Success.");

    }else{
        echo("Invalid email or verification code");
    }

}


?>