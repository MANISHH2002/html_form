<?php
require('connect.php');

if (isset($_POST['submit'])) {
    $first = $_POST['fname'];
    $last = $_POST['lname'];
    $collage = $_POST['collagename'];
    $mail = $_POST['email'];
    $mbnumber = $_POST['monumber'];
    $addone = $_POST['addressone'];
    $addtwo = $_POST['addresstwo'];
    $ct = $_POST['city'];
    $stt = $_POST['state'];
    $zip = $_POST['zip'];
    $corse = $_POST['courses'];
    $exprience = $_POST['exprience'];
    
    // Validation and sanitization
    if (!empty($first) && !empty($last) && !empty($collage)  && !empty($mail) && !empty($mbnumber) && !empty($addone) && !empty($addtwo) && !empty($ct) && !empty($stt) && !empty($zip) && !empty($corse)) {
        // Validate email format
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            // Prevent SQL injection
            $mail = mysqli_real_escape_string($con, $mail);
            // Check if email already exists
            $checkEmail = mysqli_query($con, "SELECT * FROM uptable WHERE email='$mail'");
            if (mysqli_num_rows($checkEmail) > 0) {
                echo "<p style='color:red'>Email already exists <i class='fa-solid fa-face-sad-tear' style='color:yellow;font-size:30px;'></i></p>";
            } else {
              $sql = mysqli_query($con, "INSERT INTO `uptable`(`first_name`, `last_name`, `collage_name`, `email`, `mobile_number`, `address`, `address2`, `city`, `state`, `zip`, `course`, `exprience`) VALUES ('$first','$last','$collage','$mail','$mbnumber','$addone','$addtwo','$ct','$stt','$zip','$corse','$exprience')");

                if ($sql) {
                    echo "<p style='color:green'>Successfully submitted <i class='fa-solid fa-face-smile-wink' style='color:blue;font-size:30px;'></i></p>";
                } else {
                    echo "<p style='color:red'>Failed to submit <i class='fa-solid fa-face-sad-cry' style='color:red;font-size:30px;'></i></p>";
                }
            }
        } else {
            echo "<p style='color:red'>Invalid email format</p>";
        }
    } else {
        echo "<h1 style='background-color:orange;padding:10px;color:white;text-align:center'>Please submit required fields</h1>";
    }

}

$select = mysqli_query($con, "SELECT * FROM uptable");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <title>Document</title>
  <link href="upflair.css" rel="stylesheet">
  <link href="assets/bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
     integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>

  <section class="index">
    <div class="container-fluied">
      <div class="backimg">
        <div class="formstyle">
          <form class="row g-3" method="post">
            <div class="row g-3">
              <div class="col">
                <label for="">First Name</label>
                <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="fname">
              </div>
              <div class="col">
                <label for="">Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name " name="lname">
              </div>

              <div class="col">
                <label for="">College Name</label>
                <input type="text" class="form-control" placeholder="College Name" aria-label="collage name" name="collagename">
              </div>
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
            </div>
            <div class="col-md-6">
              <label for="inputnumber" class="form-label">Contect Number</label>
              <input type="text" class="form-control" id="inputnumber"value="+91" name="monumber" placeholder="Contect Number">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="addressone">
            </div>
            <div class="col-12">
              <label for="inputAddress2" class="form-label">Address 2</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="addresstwo">
            </div>
            <div class="col-md-6">
              <label for="inputCity" class="form-label">City</label>
              <select id="state" class="form-select" name="city">
                <option selected>city</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="inputState" class="form-label">State</label>
              <select onchange="print_city('state', this.selectedIndex);" id="s" class="form-select" name="state">
              </select>
            </div>
            <div class="col-md-2">
              <label for="inputZip" class="form-label">Zip</label>
              <input type="text" class="form-control"  name="zip" id="inputZip" placeholder="zip">
            </div>
            
            <div class="col-md-4">
              <label for="inputcourse" class="form-label">Courses</label>
              <select id="inputcourse" class="form-select" name="courses">
                <option selected>web designer</option>
                <option>web developer</option>
                <option>AI</option>
                <option>front end</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="inputduration" class="form-label">do you have any exprience</label><br>
              <p id="inputyes" class="btn btn-secondary" name="yes">Yes</p>
              <p id="inputno" class="btn btn-secondary" name="no">No</p>

              <p id="experience_error" class="text-danger">You don't have experience</p>

            <div class="col-md-12" id="experience_id">
              <label for="experience" class="form-label">Experience</label>
              <input type="text" class="form-control" id="experience" placeholder="Experience"  name="exprience" value="no exprience">
            </div>
          </div>
            

            <div class="col-12">
              <button type="submit" class="btn btn-primary" name="submit">submit</button>
            </div>
          </form>
          
            
         
        </div>
      </div>
    </div>
  </section>

  
  <script src="upflair.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
      print_state("s");
   </script>
   <script>
    
    var yesbtn = document.getElementById('inputyes');
    var nobtn = document.getElementById('inputno');
    var exp = document.getElementById('experience_id');
    var errore = document.getElementById('experience_error');
    $(exp).hide();
    $(errore).hide();
    
    $(yesbtn).click( () => {
      $(exp).show();
      $(errore).hide();
    });

    $(nobtn).click( () => {
      $(exp).hide();
      $(errore).show();
    });
    // $(document).ready(function(){
    //   $('#experience_id').hide();
    //   $('#experience_error').hide();
    //   $('#inputyes').click(function(){
    //     $('experience_error').show("");
        
    //   });
    // });
      
  </script>
</body>

</html>