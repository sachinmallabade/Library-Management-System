<?php
include_once("config/config.php");
include_once(dir_url . "config/database.php");
include_once(dir_url . "include/middleware.php");
include_once(dir_url . "models/auth.php");

include_once(dir_url . "include/header.php");
include_once(dir_url . "include/topbar.php");
include_once(dir_url . "include/sidebar.php");
$user = $_SESSION['user'];

 // Change Password functionality

 if(isset($_POST['password_submit'])){
    $res = changePassword($con,$_POST);
    
    if($res['status'] == true){
      $_SESSION['success'] = $res['message'];
    //   header("LOCATION:" .base_url ."my-profile.php");
    //   exit;
  
    }else{
      $_SESSION['error'] = $res['message'];
    //   header("LOCATION:" .base_url."my-profile.php");
    //   exit;
    } 
  }

  // update profile functionality

 if(isset($_POST['profile_submit'])){
    $res = updateProfile($con,$_POST);
    
    if($res['status'] == true){
      $_SESSION['success'] = $res['message'];
   
  
    }else{
      $_SESSION['error'] = $res['message'];
    
    } 
  }


?>

<!--Main Container Start-->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <!--Cards-->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">My Profile</h4>
                <?php include_once(dir_url . "include/alerts.php"); ?>
            </div>

            <!--Account info form-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Account Information
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url ?>my-profile.php">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $user['name'] ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $user['email'] ?>"/> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_no" value="<?php echo $user['phone_no'] ?>"/> 
                                    </div>
                                </div>

                               

                                <div class="col-md-12">
                                    <button type="submit" name="profile_submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Change password form-->
            <div class="col-md-6">
                <div class="card" style="min-height:457px;">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url ?>my-profile.php">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" required name="current_pass"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" required name="new_pass" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" required name="conf_pass" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="password_submit" class="btn btn-success">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once(dir_url ."include/footer.php"); ?>