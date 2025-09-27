<?php session_start();
require "connection.php";

if (isset($_SESSION["userData"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo/Green_Modern_Web_Design_Studio_Logo-removebg-preview.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


        <title>Athletex | New item</title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <?php include "header.php"; ?>

                <div class="col-12 text-start">
                    <p class="text-dark fw-bold fs-1">New item</p>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center p-3">
                        <div class="col-4 col-lg-2 d-grid newItem">
                            <input type="file" class="d-none" id="imageuploader" multiple accept=".jpg, .jpeg, .png, .svg" />
                            <label for="imageuploader" class="btn text-light fw-bold" onclick="changeProductImage();" style="background-color: #fc601d;"><i class="bi bi-bag-plus-fill"></i> Select images</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <p class="text-secondary fw-bold">Access image type : /jpg, /jpeg, /png, /svg+xml</p>
                    <p class="text-secondary fw-bold">Only 3 images you can select</p>
                </div>

                <div class="col-12 mt-3">
                    <div class="row justify-content-center gap-3 p-2">
                        <div class="col-12 col-lg-4 d-flex justify-content-center border border-primary rounded">
                            <img src="resources/image-gallery.png" style="height: 300px;" class="img-fluid" alt="" id="img0">
                        </div>
                        <div class="col-12 col-lg-4 d-flex justify-content-center border border-primary rounded">
                            <img src="resources/image-gallery.png" style="height: 300px;" class="img-fluid" alt="" id="img1">
                        </div>
                        <div class="col-12 col-lg-4 d-flex justify-content-center border border-primary rounded">
                            <img src="resources/image-gallery.png" style="height: 300px;" class="img-fluid" alt="" id="img2">
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-12 col-lg-4 mt-2 mt-lg-0">
                            <input id="tittle" type="text" class="form-control rounded-5 text-secondary" placeholder="Tittle">
                        </div>
                        <div class="col-12 col-lg-4 mt-2 mt-lg-0">
                            <input id="price" type="text" class="form-control rounded-5 text-secondary" placeholder="Price">
                        </div>
                        <div class="col-12 col-lg-4 mt-2 mt-lg-0">
                            <input id="quantity" type="number" min="0" class="form-control rounded-5 text-secondary" placeholder="Quantity">
                        </div>
                        <div class="col-12 col-lg-4 mt-2 mt-lg-3">
                            <select id="sizes" class="form-select text-secondary rounded-5 text-center">

                            <option value="0">Select size</option>
                                <?php
                                $s_rs = Database::search("SELECT * FROM `sizes`");
                                $s_num = $s_rs->num_rows;
                                for ($i = 0; $i < $s_num; $i++) {
                                    $s_data = $s_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($s_data["sizes_id"]); ?>"><?php echo ($s_data["sizes"]); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4 mt-2 mt-lg-3">
                            <input id="delivery" type="number" min="0" class="form-control rounded-5 text-secondary" placeholder="Delivery fee">
                        </div>
                        <div class="col-12 col-lg-4 mt-2 mt-lg-3">
                            <select id="category" class="form-select text-secondary rounded-5 text-center">

                            <option value="0">Select category</option>
                                <?php
                                $c_rs = Database::search("SELECT * FROM `category`");
                                $c_num = $c_rs->num_rows;
                                for ($i = 0; $i < $c_num; $i++) {
                                    $c_data = $c_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($c_data["category_id"]); ?>"><?php echo ($c_data["category_name"]); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 mt-2 mt-lg-3">
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Description" cols="30" rows="10" id="desc"></textarea>
                            </div>
                        </div>

                        <div class="col-12 mt-4 mb-4">
                            <div class="row justify-content-center p-3">
                                <div class="col-4 d-grid newItem">
                                   <button class="btn text-light fw-bold" style="background-color: #fc601d;" onclick="addProduct();"><i class="bi bi-bag-plus-fill"></i> Add item</button>
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

<?php
} else {
    header("Location:myProducts.php");
}
?>