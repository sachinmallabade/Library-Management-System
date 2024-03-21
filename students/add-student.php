<?php 

 include_once("../config/config.php");
 include_once( dir_url ."config/database.php"); 
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/student.php"); 

 
 //  Add student functionality

if(isset($_POST['submit'])){
  $res = storeStudent($con,$_POST);
  if($res == true){
    $_SESSION['success'] = "Student has been created successfully";
    header("LOCATION:" .base_url."students");
    exit;
  }else{
    $_SESSION['error'] = "Something went wrong,please try again";
    header("LOCATION:" .base_url."students/add-student.php");
    exit;
  } 
}
 ?>


<?php 
 include_once( dir_url ."include/header.php"); 
 include_once( dir_url ."include/topbar.php"); 
 include_once( dir_url ."include/sidebar.php"); 
 ?>
    <!-- Main Content start -->
    <main class="mt-1 pt-3">

      <div class="container-fluid">
        <!-- cards -->
        <div class="row dashboard-counts">
          <div class="col-md-12">
            <h4 class="fw-bold text-uppercase">Add Student</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Fill the form</div>

                <div class="card-body">
                  <form method="post" action="<?php echo base_url?>students/add-student.php">

                  <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"
                                  >Full Name</label
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  name = "name"
                                  aria-describedby="emailHelp"
                                  required
                                />
                                
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label  class="form-label"
                              >Email</label
                            >
                            <input
                              type="email"
                              class="form-control"
                              name = "email"
                              required
                            />
                          </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label"
                                  >Phone No</label
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  name = "phone_no"
                                  required
                                />
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label"
                                  >Address</label
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  name = "address"
                                  required
                                />
                              </div>
                        </div>

                        
                    </div>
                    </div>
                    <div class="col-md-12">
                    <button name="submit" type="submit" class="btn btn-success">
                      Save
                    </button>
                    <a href = "<?php echo base_url?>students" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
                
                </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Main Content end -->
    <?php include_once( dir_url ."include/footer.php"); ?>

