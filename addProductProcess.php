<?php
session_start();
require "connection.php";
$userID = $_SESSION["userData"]["user_id"];

$category = $_POST["c"];
$title = $_POST["t"];
$qty = $_POST["qty"];
$price = $_POST["p"];
$desc = $_POST["des"];
$dlivery = $_POST["d"];
$size = $_POST["s"];

if (empty($title)) {
    echo ("Enter tittle");
} else if (empty($price)) {
    echo ("Enter price");
} else if (!is_numeric($price)) {
    echo ("Invalid price");
} else if (empty($qty)) {
    echo ("Enter quantity");
} else if ($size == "0") {
    echo ("Select size");
} else if (empty($dlivery)) {
    echo ("Enter delivery charge");
} else if ($category == "0") {
    echo ("Select category");
} else if (empty($desc)) {
    echo ("Enter description");
} else {
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d");

    Database::iud("INSERT INTO `product` 
    (`price`,`qty`,`title`,`description`,`delivery_fee`,`added_date`,`product_status_id`,`user_user_id`,`category_category_id`) 
    VALUES ('" . $price . "','" . $qty . "','" . $title . "','" . $desc . "','" . $dlivery . "','" . $date . "','1','" . $userID . "','" . $category . "')");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);
    if ($length <= 3 && $length > 0) {
        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {
                $img_file = $_FILES["image" . $x];
                $file_extentions = $img_file["type"];
                if (in_array($file_extentions, $allowed_img_extentions)) {
                    $new_img_extention;
                    if ($file_extentions == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extentions == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extentions == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extentions == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }
                    $file_name = "resources//products//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img` (`img_path`,`product_product_id`) VALUES 
                    ('" . $file_name . "','" . $product_id . "')");
                } else {
                    echo ("Invalid image Type");
                }
            }
        }
        
    } else {
        echo ("Invalid image count");
    }

    Database::iud("INSERT INTO `product_has_sizes` (`product_product_id`,`sizes_sizes_id`) 
    VALUES ('" . $product_id . "','" . $size . "')");
    echo ("Product saved successfully");
}
