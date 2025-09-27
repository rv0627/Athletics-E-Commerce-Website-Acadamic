<?php
session_start();
require "connection.php";

// Check if the 'limit' and 'offset' parameters are set and are numbers
if (isset($_GET["limit"]) && is_numeric($_GET["limit"]) && isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
    $limit = $_GET["limit"];
    $offset = $_GET["offset"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_status_id`='1' ORDER BY `added_date` DESC LIMIT $limit OFFSET $offset");
    $product_num = $product_rs->num_rows;

    $new_offset = (int)$offset + 4;

    for ($p = 0; $p < $product_num; $p++) {
        $product_data = $product_rs->fetch_assoc();
?>

        <div class="col-6 col-lg-3 mt-5">
            <div class="row">
                <div class="col-12 viewOptionBox" style="position: relative;">
                    <?php
                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $product_data["product_id"] . "' ");
                    $image_data = $img_rs->fetch_assoc();
                    ?>
                    <img src="<?php echo ($image_data["img_path"]) ?>" class="img-fluid pimg" alt="">
                    <div class="col-12 p-2 optionBox text-center text-light fw-bold fs-4" style="background-color: #fc601d;cursor: pointer;">
                        <div class="row align-content-center">
                            <?php
                            if ($product_data["qty"] > 0) {
                            ?>
                                <p>Add to cart &nbsp; <i class="bi bi-cart3"></i></p>
                            <?php
                            } else {
                            ?>
                                <p>Out of stock</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION["userData"])) {
                        $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_product_id`='" . $product_data["product_id"] . "' AND 
                    `user_user_id`='" . $_SESSION["userData"]["user_id"] . "'");
                        $w_num = $w_rs->num_rows;
                        if ($w_num == 1) {
                    ?>
                            <p class="optionBox" style="right: 20px;position: absolute;top: 80px;cursor: pointer;"><i class="bi bi-heart-fill text-danger fs-4"></i></p>
                        <?php
                        } else {
                        ?>
                            <p class="optionBox" style="right: 20px;position: absolute;top: 80px;cursor: pointer;"><i class="bi bi-heart fs-4"></i></p>
                        <?php
                        }
                    } else {
                        ?>
                        <p class="optionBox" style="right: 20px;position: absolute;top: 80px;cursor: pointer;"><i class="bi bi-heart fs-4"></i></p>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-12 text-center mt-2">
                    <span class="fw-bold text-dark"><?php echo ($product_data["title"]) ?></span>
                </div>
                <div class="col-12 text-center">
                    <span class="badge">
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                    </span>
                </div>
                <div class="col-12 text-center">
                    <span class="fw-bold" style="color: #fc601d;">Rs. <span><?php echo ($product_data["price"]) ?>.00</span></span>
                </div>
            </div>
        </div>
    <?php
    }

    $html = ob_get_clean();

    if ($product_num > 0) {
        echo $html;
        ?>
    <div class="col-12 mt-5" id="lb2">
        <div class="row justify-content-center p-3">
            <div class="col-4 col-lg-2 d-grid newItem">
                <button class="btn text-light fw-bold" style="background-color: #fc601d;" onclick="loadMore2(4,<?php echo($new_offset); ?>);"><i class="bi bi-bag-plus-fill"></i> Load more</button>
            </div>
        </div>
    </div>
    <?php
    } else {
        // No more products to load
        echo "";
    }
    ?>
    
<?php

} else {
    die("Invalid parameters.");
}
