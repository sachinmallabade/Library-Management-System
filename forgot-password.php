
<?php 

 include_once("config/config.php");
 include_once("config/database.php");
 include_once(dir_url . "models/auth.php");


    if(isset($_SESSION['is_user_login']))
    {
      header("LOCATION:" .base_url."dashboard.php");
      exit;
    }

  //  Forgot Password functionality

if(isset($_POST['submit'])){
  $res = forgotPassword($con,$_POST);
  
  if($res['status'] == true){
    $_SESSION['success'] = "Reset otp has been sent to your email";
    header("LOCATION:" .base_url."reset-password.php");
    exit;

  }else{
    $_SESSION['error'] = "Invalid Email";
    header("LOCATION:" .base_url."forgot-password.php");
    exit;
  } 
}
 
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="./assets/css/bootstrap.min.css"
      rel="stylesheet"
      
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <title>Login</title>
  </head>
  <body style="background: #96705B;">
  <div
      class="container d-flex align-items-center justify-content-center vh-100"
    >
      <div class="row">
        <div class="col-md-12 login-form">
          <div class="card mb-3" style="max-width: 850px">
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  src="./assets/images/library.avif"
                  class="img-fluid rounded-start"
                  alt="..."
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h1 class="card-title text-uppercase fw-bold">WOF Library</h1>
                  <?php  include_once(dir_url ."include/alerts.php");  ?>
                  <p class="card-text">Enter email</p>
                  <form method="post" action="<?php echo base_url?>forgot-password.php">
                    <div class="mb-3">
                      <label class="form-label"
                        >Email address</label
                      >
                      <input
                        type="email"
                        class="form-control"
                        name="email"
                      />
                    </div>
                    

                    <button type="submit" name="submit" class="btn btn-primary">
                      Submit
                    </button>
        
                  </form>

                  <hr />
                    <a
                      href="./index.php"
                      class="card-link link-underline-light"
                      >Back to Login</a
                    >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="./assets/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    

    <script
      src="./assets/js/0c924cf3e1.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
