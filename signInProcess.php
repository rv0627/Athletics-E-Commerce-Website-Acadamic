<?php

session_start();
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if(empty($email)){
    echo ("Enter Email");
}else if(strlen($email) > 100){
    echo ("Email must have less than 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid email");
}else if(empty($password)){
    echo ("Enter password");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Password must have between 5-20 characters.");
}else{
    
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."' ");
    $n = $rs->num_rows;

    if($n == 1){

       
        $data = $rs->fetch_assoc();
        $_SESSION["userData"] = $data;

        if($data["account_type_idaccount_type"] == "2"){
            echo ("Seller");
        }else{
            echo ("Customer");
        }

        if($data["user_status_id"] != 2){
            if($rememberme == "true"){

                setcookie("email",$email,time()+(60*60*24*365));
                setcookie("password",$password,time()+(60*60*24*365));
    
            }else{
    
                setcookie("email","", -1);
                setcookie("password","", -1);
    
            }
        }else{
            echo("User deactivated.");
        }

    }else{
        echo("Invalid email or password");
    }

}

?>