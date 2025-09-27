<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resources/logo/Green_Modern_Web_Design_Studio_Logo-removebg-preview.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Athletex | Home</title>
</head>

<body>
    <?php
    session_start();
    require "connection.php";
    if (!isset($_SESSION["userData"])) {
    ?>
        <!-- SignIn Model -->
        <div class="modal" tabindex="-1" id="srModel">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4 s rounded"></div>
                                <!-- Sign In Box -->
                                <div class="col-8" id="sBox">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="fs-5" style="color: #fc601d;">Be in touch with us,</p>
                                            <p class="fs-3 fw-bold text-black">Subscribe and receive news about Eris</p>
                                        </div>
                                        <?php

                                        $email = "";
                                        $password = "";

                                        if (isset($_COOKIE["email"])) {
                                            $email = $_COOKIE["email"];
                                        }

                                        if (isset($_COOKIE["password"])) {
                                            $password = $_COOKIE["password"];
                                        }

                                        ?>
                                        <div class="col-12">
                                            <input id="semail" type="text" class="form-control rounded-5 text-secondary" placeholder="Email" value="<?php echo ($email); ?>">
                                            <span class="d-none" id="e6" style="color: red;margin-left: 8px;"></span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <input id="spassword" type="password" class="form-control rounded-5 text-secondary" placeholder="Password" value="<?php echo ($password); ?>">
                                            <span class="d-none" id="e7" style="color: red;margin-left: 8px;"></span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="rememberme" />
                                                        <label class="form-check-label">Remember Me</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <a href="#" class="link-primary" onclick="forgotPasswordModal();">Forgot Password</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 mb-2">
                                            <div class="row">
                                                <div class="col-8">
                                                    <a href="#" class="link-primary" onclick="changeLoginBox();">Register</a>
                                                </div>
                                                <div class="col-4 d-grid">
                                                    <button class="btn text-light fw-bold rounded-5" style="background-color: #fc601d;" onclick="signIn();">Sign in</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sign In Box -->

                                <!-- Register Box -->
                                <div class="col-8 d-none" id="rBox">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="fs-5" style="color: #fc601d;">Be in touch with us,</p>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input id="fname" type="text" class="form-control rounded-5 text-secondary" placeholder="First Name">
                                                    <span class="d-none" id="e1" style="color: red;margin-left: 8px;"></span>
                                                </div>
                                                <div class="col-6">
                                                    <input id="lname" type="text" class="form-control rounded-5 text-secondary" placeholder="Last Name">
                                                    <span class="d-none" id="e2" style="color: red;margin-left: 8px;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <input id="email" type="text" class="form-control rounded-5 text-secondary" placeholder="Email">
                                            <span class="d-none" id="e3" style="color: red;margin-left: 8px;"></span>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <select id="actType" class="form-select text-secondary rounded-5">

                                                <?php
                                                $act_rs = Database::search("SELECT * FROM `account_type`");
                                                $act_num = $act_rs->num_rows;
                                                for ($i = 0; $i < $act_num; $i++) {
                                                    $act_data = $act_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo ($act_data["idaccount_type"]); ?>"><?php echo ($act_data["account_type"]); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input id="mobile" type="text" class="form-control rounded-5 text-secondary" placeholder="Mobile">
                                                    <span class="d-none" id="e4" style="color: red;margin-left: 8px;"></span>
                                                </div>
                                                <div class="col-6">
                                                    <input id="password" type="password" class="form-control rounded-5 text-secondary" placeholder="Password">
                                                    <span class="d-none" id="e5" style="color: red;margin-left: 8px;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 mb-2">
                                            <div class="row">
                                                <div class="col-8">
                                                    <a href="#" class="link-primary" onclick="changeLoginBox();">Sign in</a>
                                                </div>
                                                <div class="col-4 d-grid">
                                                    <button class="btn text-light fw-bold rounded-5" style="background-color: #fc601d;" onclick="register();">Register</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Register Box -->

                                <!-- forget_password Box -->
                                <div class="col-8 d-none" id="fBox">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="fs-3 fw-bold text-black">Reset Password</p>
                                            <p class="fs-5" style="color: #fc601d;" id="verificationCodeSend"></p>
                                        </div>
                                        <div class="col-12">
                                            <input id="newpassword" type="password" class="form-control rounded-5 text-secondary" placeholder="New password">
                                            <span class="d-none" id="e8" style="color: red;margin-left: 8px;"></span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <input id="retpassword" type="password" class="form-control rounded-5 text-secondary" placeholder="Re-type password">
                                            <span class="d-none" id="e9" style="color: red;margin-left: 8px;"></span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <input id="vCode" type="text" class="form-control rounded-5 text-secondary" placeholder="Verification code">
                                            <span class="d-none" id="e10" style="color: red;margin-left: 8px;"></span>
                                        </div>

                                        <div class="col-12 mt-3 mb-2">
                                            <div class="row text-end">
                                                <div class="col-8"></div>
                                                <div class="col-4 d-grid">
                                                    <button class="btn text-light fw-bold rounded-5" style="background-color: #fc601d;" onclick="ResetPassword();">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- forget_password Box -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SignIn Model -->
    <?php
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>

            <div class="col-12">
                <div class="row">

                    <div class="col-12">
                        <div class="row">
                            <div class="shopBg d-flex flex-row align-items-center d-none d-lg-block">

                                <div class="col-12 text-white p-3 d-none d-md-none d-lg-block">
                                    <div class="row g-2 gap-5">

                                        <span class="fw-bold" style="font-size: 60px;">Shop</span><br />
                                        <div class="col-1">
                                            <div class="row">
                                                <div class="col-1 me-3 align-content-center">
                                                    <img src="resources/menu (3).png" alt="">
                                                </div>
                                                <div class="col-1">
                                                    <span class="fw-bold fs-5" style="border-bottom: 2px solid orangered;">All</span>
                                                    <span style="color: rgba(255, 255, 255, .6);">Products</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <div class="row">
                                                <div class="col-1 me-3 align-content-center">
                                                    <img src="resources/swimmingNew.png" alt="">
                                                </div>
                                                <div class="col-1">
                                                    <span class="fw-bold fs-5">Swimming</span>
                                                    <span style="color: rgba(255, 255, 255, .6);">Products</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <div class="row">
                                                <div class="col-1 me-3 align-content-center">
                                                    <img src="resources/runningNew.png" alt="">
                                                </div>
                                                <div class="col-1">
                                                    <span class="fw-bold fs-5">Running</span>
                                                    <span style="color: rgba(255, 255, 255, .6);">Products</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <div class="row">
                                                <div class="col-1 me-3 align-content-center">
                                                    <img src="resources/runningNew.png" alt="">
                                                </div>
                                                <div class="col-1">
                                                    <span class="fw-bold fs-5">Cycling</span>
                                                    <span style="color: rgba(255, 255, 255, .6);">Products</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <div class="row">
                                                <div class="col-1 me-3 align-content-center">
                                                    <img src="resources/gymnasticsNew.png" alt="">
                                                </div>
                                                <div class="col-1">
                                                    <span class="fw-bold fs-5">Gymnastic</span>
                                                    <span style="color: rgba(255, 255, 255, .6);">Products</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <div class="row">
                                                <div class="col-1 me-3 align-content-center">
                                                    <img src="resources/tennis-racketNew.png" alt="">
                                                </div>
                                                <div class="col-1">
                                                    <span class="fw-bold fs-5">Tennis</span>
                                                    <span style="color: rgba(255, 255, 255, .6);">Products</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <div class="row">

                            <div class="col-3">
                                <div class="row">

                                    <div class="col-12">
                                        <span class="fw-bold fs-4">Size</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="row p-3 gap-2">
                                            <div class="col-2 d-flex flex-column align-items-center justify-content-center fw-bold border border-1" style="height: 30px;width: 30px;border-radius: 50%;background-color: #f9f2f2;cursor: pointer;">
                                                <span>XS</span>
                                            </div>
                                            <div class="col-2 d-flex flex-column align-items-center justify-content-center fw-bold border border-1" style="height: 30px;width: 30px;border-radius: 50%;background-color: #f9f2f2;cursor: pointer;">
                                                <span>S</span>
                                            </div>
                                            <div class="col-2 d-flex flex-column align-items-center justify-content-center fw-bold border border-1" style="height: 30px;width: 30px;border-radius: 50%;background-color: #f9f2f2;cursor: pointer;">
                                                <span>M</span>
                                            </div>
                                            <div class="col-2 d-flex flex-column align-items-center justify-content-center fw-bold border border-1" style="height: 30px;width: 30px;border-radius: 50%;background-color: #f9f2f2;cursor: pointer;">
                                                <span>L</span>
                                            </div>
                                            <div class="col-2 d-flex flex-column align-items-center justify-content-center fw-bold border border-1" style="height: 30px;width: 30px;border-radius: 50%;background-color: #f9f2f2;cursor: pointer;">
                                                <span>XL</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <span class="fw-bold fs-4">Price</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="range-slider">
                                                <input type="range" min="1000" max="50000" value="1000" class="slider" id="myRange">
                                                <div class="range-values mt-2">
                                                    <span>Rs.<span id="min-price-val"> 1000</span></span>
                                                    <span id="max-price-val">Rs. 50 000</span>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-4 mt-3 d-grid">
                                                            <button class="btn text-white" style="background-color: #fc601d;border-radius: 20px;" onclick="filter();">Filter</button>
                                                        </div>
                                                        <div class="col-5 mt-3 d-grid">
                                                            <button class="btn text-white" style="background-color: #fc601d;border-radius: 20px;" onclick="Clearfilter();">Clear filter</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-9">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row" style="display: flex;justify-content: space-between;">
                                            <div class="col-2">
                                                <a href="index.php" class="text-decoration-none text-black fw-bold" style="cursor: pointer;">Home </a><span class="text-secondary fw-bold"> / Shop</span>
                                            </div>
                                            <div class="col-3">
                                                <select class="form-select text-secondary" style="border-radius: 20px;" name="" id="">
                                                    <option value="0">Default sorting</option>
                                                    <option value="1">Sort by latest</option>
                                                    <option value="2">Sort by price: low to high</option>
                                                    <option value="3">Sort by price: high to low</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row justify-content-center" id="productdive">

                                                    <?php
                                                    $limit = 10;
                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_status_id`='1' ORDER BY `added_date` DESC LIMIT $limit OFFSET 0");
                                                    $product_num = $product_rs->num_rows;

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

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <div class="row">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link text-decoration-none" style="background-color: #fc601d;" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-12 d-block d-lg-none position-fixed bottom-0" style="z-index: 100;background-color: aliceblue;">
                        <div class="row">
                            <div class="col-12">
                                <div class="row p-3 g-2">

                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12 me-3 text-center">
                                                <img src="resources/menu (1).png" alt="">
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fw-bold" style="border-bottom: 2px solid orangered;">All</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12 me-3 text-center">
                                                <img src="resources/swimming.png" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fw-bold">Swimming</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12 me-3 text-center">
                                                <img src="resources/running-shoes (1).png" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fw-bold">Running</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12 me-3 text-center">
                                                <img src="resources/cycling.png" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fw-bold">Cycling</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12 me-3 text-center">
                                                <img src="resources/dancer.png" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fw-bold">Gymnastic</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-12 me-3 text-center">
                                                <img src="resources/tennis.png" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fw-bold">Tennis</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>