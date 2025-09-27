<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>
    <header class="p-2 d-lg-block d-none pt-4 pb-4" style="background-color: #ffffff;">
        <div class="row align-items-center">
            <div class="col-2">
                <img src="resources/logo/athletex-logo.svg" alt="AthleteX Logo" class="img-fluid">
            </div>
            <nav class="col-6">
                <ul class="nav fw-bold">
                    <?php
                    if (isset($_SESSION["userData"])) {
                        $act = $_SESSION["userData"]["account_type_idaccount_type"];
                        if ($act == '2') {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#">My products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#"><i class="bi bi-chat-left-dots"></i></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="shop.php">Shop<i class="bi bi-chevron-down"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#">Contact Us</a>
                            </li>
                    <?php
                        }
                    }else{
                        ?>
                        <li class="nav-item">
                                <a class="nav-link text-black" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="shop.php">Shop<i class="bi bi-chevron-down"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#">Contact Us</a>
                            </li>
                        <?php
                    }

                    ?>
                </ul>
            </nav>
            <nav class="col-4">
                <ul class="nav justify-content-end fw-bold">
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION["userData"])) {
                        ?>
                            <a class="nav-link text-black" href="#"><?php echo ($_SESSION["userData"]["first_name"]) ?> &nbsp;<i class="bi bi-box-arrow-right fs-5" style="color: #fc601d;" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Sign out" onclick="signOut();"></i></a>

                        <?php
                        } else {
                        ?>
                            <a class="nav-link text-black" href="#" onclick="showSignModel();">Login / Register</a>
                        <?php
                        }
                        ?>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#"><i class="bi bi-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#"><i class="bi bi-heart"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#"><i class="bi bi-cart3"></i><span class="badge bg-danger" id="cartNum"></span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- small size header -->
    <header class="p-2 d-lg-none d-block pt-4 pb-4" style="background-color: #ffffff;">
        <div class="row align-items-center">
            <div class="col-2">

                <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-border-width fs-4"></i></button>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control fw-bold " placeholder="Search for products" style="border: none;">
                                </div>
                                <div class="col-2 p-2">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 text-center bg-light align-content-center" id="m" style="height: 80px; border-bottom: 2px solid orangered;cursor: pointer;" onclick="changeView();">
                                    <span class="fw-bold">Menu</span>
                                </div>
                                <div class="col-6 text-center bg-light align-content-center" id="c" style="height: 80px;cursor: pointer;" onclick="changeView();">
                                    <span class="fw-bold">Categories</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" id="mBox">
                            <div class="row fw-bold">
                                <?php
                                if (isset($_SESSION["userData"]["account_type_idaccount_type"]) == '2') {
                                ?>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <a href="myProducts.php">My products</a>
                                    </div>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <span>Contact Us</span>
                                    </div>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <span><i class="bi bi-chat-left-dots"></i> Message </span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <a class="text-decoration-none text-dark" href="index.php">Home</a>
                                    </div>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <a class="text-decoration-none text-dark" href="shop.php">Shop <i class="bi bi-chevron-right"></i></a>
                                    </div>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <span>Contact Us</span>
                                    </div>
                                    <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                        <span><i class="bi bi-heart"></i> Watchlist </span>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">

                                    <?php
                                    if (isset($_SESSION["userData"])) {
                                    ?>
                                        <span><i class="bi bi-person"></i>Welcome <?php echo ($_SESSION["userData"]["first_name"]) ?> &nbsp;<i class="bi bi-box-arrow-right fs-5" style="color: #fc601d;" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Sign out"></i></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span onclick="showSignModel();"><i class="bi bi-person"></i> Login / Register </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="cBox">
                            <div class="row fw-bold">
                                <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                    <img src="resources/swimming.png" alt="" class="img-fluid">&nbsp; <span>Swimming</span>
                                </div>
                                <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                    <img src="resources/running-shoes (1).png" alt="" class="img-fluid">&nbsp; <span>Running</span>
                                </div>
                                <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                    <img src="resources/cycling.png" alt="" class="img-fluid">&nbsp; <span>Cycling</span>
                                </div>
                                <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                    <img src="resources/dancer.png" alt="" class="img-fluid">&nbsp; <span>Gymnastic </span>
                                </div>
                                <div class="col-12 align-content-center" style="height: 50px; border-bottom: 1px solid #d7d7d7;cursor: pointer;">
                                    <img src="resources/tennis.png" alt="" class="img-fluid">&nbsp; <span>Tennis</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-8 text-center">
                <img src="resources/logo/athletex-logo.svg" alt="AthleteX Logo" class="img-fluid">
            </div>
            <div class="col-2 text-end">
                <i class="bi bi-cart3 fs-4"></i><span class="badge bg-danger" id="cartNum"></span>
            </div>
        </div>
    </header>

</body>

</html>