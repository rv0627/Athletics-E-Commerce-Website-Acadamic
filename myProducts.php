<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo/Green_Modern_Web_Design_Studio_Logo-removebg-preview.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Athletex | My products</title>
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

            <!-- carosal -->
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="col-12 align-content-center" style="background-color: #cfc8c2;height: 600px;">
                            <div class="row justify-content-center position-relative">
                                <div class="col-3 text-start align-content-center">
                                    <h1 class="fw-bold">BLAZE Weights of distribution</h1>
                                    <span class="text-secondary fw-bold d-none d-lg-block">Efficiently Manage Distribution Weights: Streamline Operations for Optimal Performance and Results. Maximize Performance.</span>
                                </div>
                                <div class="col-6 border rounded-circle b2 d-flex align-items-center justify-content-center" style="height: 500px;width: 500px;z-index: 99;">
                                    <img src="resources/c2.png" class="d-block position-absolute" alt="..." style="height: 500px; object-fit: cover; z-index: 100;">
                                </div>
                                <div class="col-3 text-end">
                                    <h1 class="fw-bold">Perchase the complete kit all at once.</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-12 align-content-center" style="background-color: #dacfeb;height: 600px;">
                            <div class="row justify-content-center position-relative">
                                <div class="col-3 text-start align-content-center">
                                    <h1 class="fw-bold">New tracksuit for women</h1>
                                    <span class="text-secondary fw-bold d-none d-lg-block">Stay stylish and comfortable with our newest women’s tracksuit collection, designed for active lifestyles.</span>
                                </div>
                                <div class="col-6 border rounded-circle b1 d-flex align-items-center justify-content-center" style="height: 500px;width: 500px;z-index: 99;">
                                    <img src="resources/c1.png" class="d-block position-absolute" alt="..." style="height: 500px; object-fit: cover; z-index: 100;">
                                </div>
                                <div class="col-3 text-end">
                                    <h1 class="fw-bold">Or you can buy the whole kit at once</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-12 align-content-center" style="background-color: #245364;height: 600px;">
                            <div class="row justify-content-center position-relative">
                                <div class="col-3 text-start align-content-center">
                                    <h1 class="fw-bold">agile Professional equipment</h1>
                                    <span class="text-secondary fw-bold d-none d-lg-block">Unleash the power of professional equipment: elevate your performance with precision and expertise. It's your performance.</span>
                                </div>
                                <div class="col-6 border rounded-circle b3 d-flex align-items-center justify-content-center" style="height: 500px;width: 500px;z-index: 99;">
                                    <img src="resources/c3.png" class="d-block position-absolute" alt="..." style="height: 500px; object-fit: cover; z-index: 100;">
                                </div>
                                <div class="col-3 text-end">
                                    <h1 class="fw-bold">Or you can purchase the entire set in one go.</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- carosal -->

            <!-- Popular products -->
            <div class="col-12 mt-5 mb-3">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold fs-3">My selling items</p>
                        <p class="text-secondary">Browse through our collection of must-haves</p>
                    </div>

                    <div class="col-12">
                        <div class="row justify-content-end p-3">
                            <div class="col-4 col-lg-2 d-grid newItem">
                                <a href="addItem.php" class="btn text-light fw-bold" style="background-color: #fc601d;"><i class="bi bi-bag-plus-fill"></i> New item</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row justify-content-center">

                            <?php
                            $product_rs = Database::search("SELECT * FROM `product` WHERE `product_status_id`='1' ORDER BY `added_date` DESC LIMIT 12 OFFSET 0");
                            $product_num = $product_rs->num_rows;

                            for ($p = 0; $p < $product_num; $p++) {
                                $product_data = $product_rs->fetch_assoc();

                            ?>
                                <div class="col-6 col-lg-3">
                                    <div class="row">
                                        <div class="col-12 viewOptionBox" style="position: relative;">
                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $product_data["product_id"] . "' ");
                                            $image_data = $img_rs->fetch_assoc();
                                            ?>
                                            <img src="<?php echo ($image_data["img_path"]) ?>" class="img-fluid " alt="">
                                            <div class="col-12 p-2 optionBox text-center text-light fw-bold fs-4" style="background-color: #fc601d;cursor: pointer;">
                                                <div class="row align-content-center">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="fd" checked onclick="changeStatus();" />
                                                        <label class="form-check-label text-light fw-bold ms-3" for="fd">
                                                            Make Your Product Active
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="optionBox" style="right: 20px;position: absolute;top: 80px;cursor: pointer;"><i class="bi bi-heart fs-4"></i></p>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <span class="fw-bold text-dark">Intense running shoes</span>
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
                                            <span class="fw-bold" style="color: #fc601d;">$<span>178.00</span></span>
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
            <!-- Popular products -->

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>