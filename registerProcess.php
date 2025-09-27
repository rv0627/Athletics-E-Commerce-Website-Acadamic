<?php

require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$actType = $_POST["at"];
$mobile = $_POST["m"];
$pw = $_POST["p"];

if(empty($fname)){
    echo ("Enter first name.");
}else if(strlen($fname) > 50){
    echo ("First name must have less than 50 characters.");
}else if(empty($lname)){
    echo ("Enter last name.");
}else if(strlen($lname) > 50){
    echo ("Last name must have less than 50 characters.");
}else if(empty($email)){
    echo ("Enter email.");
}else if(strlen($email) > 100){
    echo ("Email must have less than 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid email");
}else if(empty($mobile)){
    echo ("Enter mobile.");
}else if(strlen($mobile) !=10){
    echo ("Mobile must have 10 characters.");
}else if(!preg_match("/07[1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid mobile");
}else if(empty($pw)){
    echo ("Enter password.");
}else if(strlen($pw) < 5 || strlen($pw) > 20){
    echo ("Password must be between 5 - 20 characters.");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."' ");
    $n = $rs->num_rows;

    if($n > 0){
        echo ("Same email or mobile already exists.");
    }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        Database::iud("INSERT INTO `user` (`first_name`,`last_name`,`email`,`password`,`mobile`,`account_type_idaccount_type`,`reg_date`,`user_status_id`) VALUES
        ('".$fname."','".$lname."','".$email."','".$pw."','".$mobile."','".$actType."','".$date."','1') ");


        echo ("Success");

    }

}

?>