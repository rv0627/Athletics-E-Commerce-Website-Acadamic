const popoverTriggerList = document.querySelectorAll(
  '[data-bs-toggle="popover"]'
);
const popoverList = [...popoverTriggerList].map(
  (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
);

function changeView() {
  var mBox = document.getElementById("mBox");
  var cBox = document.getElementById("cBox");
  var m = document.getElementById("m");
  var c = document.getElementById("c");

  mBox.classList.toggle("d-none");
  cBox.classList.toggle("d-none");

  if (mBox.classList.contains("d-none")) {
    m.style.borderBottom = ""; // Change to your desired border color
    c.style.borderBottom = "2px solid orangered";
    c.style.backgroundColor = "";
  } else if (cBox.classList.contains("d-none")) {
    m.style.borderBottom = "2px solid orangered"; // Reset to default or another color if needed
    c.style.borderBottom = "";
  }
}
var myModal;
window.addEventListener("load", function () {
  myModal = new bootstrap.Modal(document.getElementById("srModel"));
  myModal.show();
});

function showSignModel() {
  myModal = new bootstrap.Modal(document.getElementById("srModel"));
  myModal.show();
}

function changeLoginBox() {
  var sBox = document.getElementById("sBox");
  var rBox = document.getElementById("rBox");

  sBox.classList.toggle("d-none");
  rBox.classList.toggle("d-none");
}

function forgotPasswordModal() {
  var sBox = document.getElementById("sBox");
  var rBox = document.getElementById("rBox");
  var fBox = document.getElementById("fBox");

  var email = document.getElementById("semail");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        document.getElementById("e6").className = "d-none";
        document.getElementById("e6").innerHTML = text;
        document.getElementById("semail").style.borderColor = "";

        document.getElementById("verificationCodeSend").innerHTML =
          "Verification code has sent to your email. Please check your inbox";

        // alert("Verification code has sent to your email. Please check your inbox");

        // Add the 'd-none' class to sBox and rBox to hide them
        sBox.classList.add("d-none");
        rBox.classList.add("d-none");

        // Remove the 'd-none' class from fBox to show it
        fBox.classList.remove("d-none");
      } else {
        document.getElementById("e6").className = "d-block";
        document.getElementById("e6").innerHTML = text;
        document.getElementById("semail").style.borderColor = "red";
      }
    }
  };

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();
}

function register() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var actType = document.getElementById("actType");
  var mobile = document.getElementById("mobile");
  var password = document.getElementById("password");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("at", actType.value);
  form.append("m", mobile.value);
  form.append("p", password.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (
        text == "Enter first name." ||
        text == "First name must have less than 50 characters."
      ) {
        document.getElementById("e1").className = "d-block";
        document.getElementById("e1").innerHTML = text;
        document.getElementById("fname").style.borderColor = "red";

        document.getElementById("e2").className = "d-none";
        document.getElementById("e2").innerHTML = text;
        document.getElementById("lname").style.borderColor = "";
        document.getElementById("e3").className = "d-none";
        document.getElementById("e3").innerHTML = text;
        document.getElementById("email").style.borderColor = "";
        document.getElementById("e4").className = "d-none";
        document.getElementById("e4").innerHTML = text;
        document.getElementById("mobile").style.borderColor = "";
        document.getElementById("e5").className = "d-none";
        document.getElementById("e5").innerHTML = text;
        document.getElementById("password").style.borderColor = "";
      } else if (
        text == "Enter last name." ||
        text == "Last name must have less than 50 characters."
      ) {
        document.getElementById("e2").className = "d-block";
        document.getElementById("e2").innerHTML = text;
        document.getElementById("lname").style.borderColor = "red";

        document.getElementById("e1").className = "d-none";
        document.getElementById("e1").innerHTML = text;
        document.getElementById("fname").style.borderColor = "";
        document.getElementById("e3").className = "d-none";
        document.getElementById("e3").innerHTML = text;
        document.getElementById("email").style.borderColor = "";
        document.getElementById("e4").className = "d-none";
        document.getElementById("e4").innerHTML = text;
        document.getElementById("mobile").style.borderColor = "";
        document.getElementById("e5").className = "d-none";
        document.getElementById("e5").innerHTML = text;
        document.getElementById("password").style.borderColor = "";
      } else if (
        text == "Enter email." ||
        text == "Email must have less than 100 characters." ||
        text == "Invalid email"
      ) {
        document.getElementById("e3").className = "d-block";
        document.getElementById("e3").innerHTML = text;
        document.getElementById("email").style.borderColor = "red";

        document.getElementById("e2").className = "d-none";
        document.getElementById("e2").innerHTML = text;
        document.getElementById("lname").style.borderColor = "";
        document.getElementById("e1").className = "d-none";
        document.getElementById("e1").innerHTML = text;
        document.getElementById("fname").style.borderColor = "";
        document.getElementById("e4").className = "d-none";
        document.getElementById("e4").innerHTML = text;
        document.getElementById("mobile").style.borderColor = "";
        document.getElementById("e5").className = "d-none";
        document.getElementById("e5").innerHTML = text;
        document.getElementById("password").style.borderColor = "";
      } else if (
        text == "Enter mobile." ||
        text == "Mobile must have 10 characters." ||
        text == "Invalid mobile"
      ) {
        document.getElementById("e4").className = "d-block";
        document.getElementById("e4").innerHTML = text;
        document.getElementById("mobile").style.borderColor = "red";

        document.getElementById("e2").className = "d-none";
        document.getElementById("e2").innerHTML = text;
        document.getElementById("lname").style.borderColor = "";
        document.getElementById("e3").className = "d-none";
        document.getElementById("e3").innerHTML = text;
        document.getElementById("email").style.borderColor = "";
        document.getElementById("e1").className = "d-none";
        document.getElementById("e1").innerHTML = text;
        document.getElementById("fname").style.borderColor = "";
        document.getElementById("e5").className = "d-none";
        document.getElementById("e5").innerHTML = text;
        document.getElementById("password").style.borderColor = "";
      } else if (
        text == "Enter password." ||
        text == "Password must be between 5 - 20 characters."
      ) {
        document.getElementById("e5").className = "d-block";
        document.getElementById("e5").innerHTML = text;
        document.getElementById("password").style.borderColor = "red";

        document.getElementById("e2").className = "d-none";
        document.getElementById("e2").innerHTML = text;
        document.getElementById("lname").style.borderColor = "";
        document.getElementById("e3").className = "d-none";
        document.getElementById("e3").innerHTML = text;
        document.getElementById("email").style.borderColor = "";
        document.getElementById("e4").className = "d-none";
        document.getElementById("e4").innerHTML = text;
        document.getElementById("mobile").style.borderColor = "";
        document.getElementById("e1").className = "d-none";
        document.getElementById("e1").innerHTML = text;
        document.getElementById("fname").style.borderColor = "";
      } else if (text == "Same email or mobile already exists.") {
        alert(text);

        document.getElementById("e2").className = "d-none";
        document.getElementById("e2").innerHTML = text;
        document.getElementById("lname").style.borderColor = "";
        document.getElementById("e3").className = "d-none";
        document.getElementById("e3").innerHTML = text;
        document.getElementById("email").style.borderColor = "red";
        document.getElementById("e4").className = "d-none";
        document.getElementById("e4").innerHTML = text;
        document.getElementById("mobile").style.borderColor = "red";
        document.getElementById("e1").className = "d-none";
        document.getElementById("e1").innerHTML = text;
        document.getElementById("fname").style.borderColor = "";
        document.getElementById("e5").className = "d-none";
        document.getElementById("e5").innerHTML = text;
        document.getElementById("password").style.borderColor = "";
      } else if (text == "Success") {
        window.location = "index.php";
      }
    }
  };

  request.open("POST", "registerProcess.php", true);
  request.send(form);
}

function signIn() {
  var email = document.getElementById("semail");
  var password = document.getElementById("spassword");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (
        text == "Enter Email" ||
        text == "Email must have less than 100 characters." ||
        text == "Invalid email"
      ) {
        document.getElementById("e6").className = "d-block";
        document.getElementById("e6").innerHTML = text;
        document.getElementById("semail").style.borderColor = "red";

        document.getElementById("e7").className = "d-none";
        document.getElementById("spassword").style.borderColor = "";
      } else if (
        text == "Enter password" ||
        text == "Password must have between 5-20 characters."
      ) {
        document.getElementById("e7").className = "d-block";
        document.getElementById("e7").innerHTML = text;
        document.getElementById("spassword").style.borderColor = "red";

        document.getElementById("e6").className = "d-none";
        document.getElementById("semail").style.borderColor = "";
      } else if (text == "Invalid email or password") {
        alert(text);
        document.getElementById("semail").style.borderColor = "red";
        document.getElementById("spassword").style.borderColor = "red";

        document.getElementById("e6").className = "d-none";
        document.getElementById("e7").className = "d-none";
      } else if (text == "User deactivated.") {
        alert(text);

        document.getElementById("semail").style.borderColor = "";
        document.getElementById("spassword").style.borderColor = "";
        document.getElementById("e6").className = "d-none";
        document.getElementById("e7").className = "d-none";
      } else if (text == "Seller") {
        window.location = "myProducts.php";
        myModal.hide();

        document.getElementById("semail").style.borderColor = "";
        document.getElementById("spassword").style.borderColor = "";
        document.getElementById("e6").className = "d-none";
        document.getElementById("e7").className = "d-none";
      } else if (text == "Customer") {
        window.location = "index.php";
        myModal.hide();

        document.getElementById("semail").style.borderColor = "";
        document.getElementById("spassword").style.borderColor = "";
        document.getElementById("e6").className = "d-none";
        document.getElementById("e7").className = "d-none";
      }
    }
  };

  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

function ResetPassword() {
  var email = document.getElementById("semail");
  var newPassword = document.getElementById("newpassword");
  var reTypePassword = document.getElementById("retpassword");
  var vCode = document.getElementById("vCode");

  var form = new FormData();
  form.append("e", email.value);
  form.append("np", newPassword.value);
  form.append("rp", reTypePassword.value);
  form.append("v", vCode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (
        text == "Enter new password" ||
        text == "New password must have between 5-20 characters."
      ) {
        document.getElementById("newpassword").style.borderColor = "red";
        document.getElementById("e8").className = "d-block";
        document.getElementById("e8").innerHTML = text;

        document.getElementById("retpassword").style.borderColor = "";
        document.getElementById("e9").className = "d-none";
        document.getElementById("e9").innerHTML = text;
        document.getElementById("vCode").style.borderColor = "";
        document.getElementById("e10").className = "d-none";
        document.getElementById("e10").innerHTML = text;
      } else if (
        text == "Enter re-type password" ||
        text == "Password does not matched."
      ) {
        document.getElementById("retpassword").style.borderColor = "red";
        document.getElementById("e9").className = "d-block";
        document.getElementById("e9").innerHTML = text;

        document.getElementById("newpassword").style.borderColor = "";
        document.getElementById("e8").className = "d-none";
        document.getElementById("e8").innerHTML = text;
        document.getElementById("vCode").style.borderColor = "";
        document.getElementById("e10").className = "d-none";
        document.getElementById("e10").innerHTML = text;
      } else if (text == "Enter verification Code") {
        document.getElementById("vCode").style.borderColor = "red";
        document.getElementById("e10").className = "d-block";
        document.getElementById("e10").innerHTML = text;

        document.getElementById("newpassword").style.borderColor = "";
        document.getElementById("e8").className = "d-none";
        document.getElementById("e8").innerHTML = text;
        document.getElementById("retpassword").style.borderColor = "";
        document.getElementById("e9").className = "d-none";
        document.getElementById("e9").innerHTML = text;
      } else if (text == "Password reset Success.") {
        alert(text);
        var sBox = document.getElementById("sBox");
        var rBox = document.getElementById("rBox");
        var fBox = document.getElementById("fBox");

        // Add the 'd-none' class to sBox and rBox to hide them
        fBox.classList.add("d-none");
        rBox.classList.add("d-none");
        // Remove the 'd-none' class from fBox to show it
        sBox.classList.remove("d-none");
      } else {
        alert(text);
      }
    }
  };

  request.open("POST", "resetPassword.php", true);
  request.send(form);
}

function signOut() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if ((text = "Success")) {
        window.location = "index.php";
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "signoutProcess.php", true);
  request.send();
}

function changeProductImage() {
  var image = document.getElementById("imageuploader");
  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img" + x).src = url;
      }
    } else {
      alert("Please select 3 or less than 3 images.");
    }
  };
}

function addProduct() {
  var tittle = document.getElementById("tittle");
  var price = document.getElementById("price");
  var qty = document.getElementById("quantity");
  var size = document.getElementById("sizes");
  var delivery = document.getElementById("delivery");
  var category = document.getElementById("category");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("t", tittle.value);
  form.append("p", price.value);
  form.append("qty", qty.value);
  form.append("s", size.value);
  form.append("d", delivery.value);
  form.append("c", category.value);
  form.append("des", desc.value);

  var file_count = image.files.length;
  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Product saved successfully") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("POST", "addProductProcess.php", true);
  request.send(form);
}

function loadMore(limit, offset) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("productdive").innerHTML += text;
      document.getElementById("lb").className = "d-none";
      offset += limit;
    }
  };

  request.open(
    "GET",
    "loadmore.php?limit=" + limit + "&offset=" + offset,
    true
  );
  request.send();
}
function loadMore2(limit, offset) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("productdive").innerHTML += text;
      document.getElementById("lb2").className = "d-none";
      offset += limit;
    }
  };

  request.open(
    "GET",
    "loadmore.php?limit=" + limit + "&offset=" + offset,
    true
  );
  request.send();
}

var PriceSlider = document.getElementById("myRange");
var minPriceVal = document.getElementById("min-price-val");
var initialValue = PriceSlider.value;

function tt() {
  minPriceVal.innerText = PriceSlider.value;
}
PriceSlider.addEventListener("input", tt);
tt();

function filter() {
  var minPrice = 1000;
  var maxtPrice = PriceSlider.value;
  alert(minPrice + " " + maxtPrice);
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      alert(text);
    }
  };

  request.open(
    "GET",
    "pricefilter.php?min=" + minPrice + "&max=" + maxtPrice,
    true
  );
  request.send();
}
function Clearfilter(){
   PriceSlider.value = initialValue;
   minPriceVal.innerText = initialValue;
}