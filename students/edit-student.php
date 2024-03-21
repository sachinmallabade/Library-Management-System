

<?php 

 include_once("../config/config.php");
 include_once( dir_url ."config/database.php"); 
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/student.php"); 


 
 //  Update Student functionality

if(isset($_POST['update'])){
  $res = updateStudent($con,$_POST);
  if($res == true){
    $_SESSION['success'] = "Student has been Updated successfully";
    header("LOCATION:" .base_url."students");
  }else{
    $_SESSION['error'] = "Something went wrong,please try again";
    header("LOCATION:" .base_url."students/edit-Student.php");
    exit;
  } 
}

//  Read get parameter to get Student data
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $Student = getStudentById($con,$_GET['id']);
    if($Student->num_rows > 0)
    {
        $Student = mysqli_fetch_assoc($Student);
    }
}
else{
    header("LOCATION: " . base_url . "Students");
    exit;
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
            <h4 class="fw-bold text-uppercase">Edit Student</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Fill the form</div>

                <div class="card-body">
                  <form method="post" action="<?php echo base_url?>Students/edit-Student.php">
                        <input type="hidden" name="id" value="<?php echo $Student['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                  >Student Name</label
                                >
                                <input
                                  type="text"
                                  name="name"
                                  class="form-control"
                                  id="exampleInputEmail1"
                                  aria-describedby="emailHelp"
                                  value="<?php echo $Student['name'] ?>"
                                  required
                                />
                                
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"
                              >Email</label
                            >
                            <input
                              type="email"
                              name="email"
                              class="form-control"
                              id="exampleInputPassword1"
                              value="<?php echo $Student['email'] ?>"
                              required
                            />
                          </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"
                                  >Phone No</label
                                >
                                <input
                                  type="text"
                                  name="phone_no"
                                  class="form-control"
                                  id="exampleInputPassword1"
                                  value="<?php echo $Student['phone_no'] ?>"
                                  required
                                />
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"
                                  > Address</label
                                >
                                <input
                                  type="text"
                                  name="address"
                                  class="form-control"
                                  id="exampleInputPassword1"
                                  value="<?php echo $Student['address'] ?>"
                                  required
                                />
                              </div>
                        </div>
                      
                    </div>
                    </div>
                    <div class="col-md-12">
                    <button name="update" type="submit" class="btn btn-success">
                      Update
                    </button>
                    <a href = "<?php echo base_url?>students" class="btn btn-secondary">
                        Back
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

