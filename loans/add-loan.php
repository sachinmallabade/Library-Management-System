<?php 

 include_once("../config/config.php");
 include_once( dir_url ."config/database.php"); 
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/loan.php"); 

 
 //  Add Loan functionality

if(isset($_POST['submit'])){
  $res = storeLoan($con,$_POST);
  
  if(isset($res['success'])){
    $_SESSION['success'] = "Book Loan has been created successfully";
    header("LOCATION:" .base_url."loans");
    echo"<pre";print_r($_POST);
    exit;
  }else{
    $_SESSION['error'] = $res['error'];
    header("LOCATION:" .base_url."loans/add-loan.php");
    echo"<pre";print_r($_POST);
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
          <?php  include_once(dir_url ."include/alerts.php");  ?>
            <h4 class="fw-bold text-uppercase">Add Loan</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Fill the form</div>

                <div class="card-body">
                  <form method="post" action="<?php echo base_url?>loans/add-loan.php">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"
                                  >Select Book</label>
                                  <?php 
                            $books = getBooks($con);
                                ?>
                            <select
                            name="book_id"
                            class="form-control"
                            
                            >
                        <option value = "">Please select </option>
                        <?php while($row = $books->fetch_assoc()){ ?>
                        <option value = "<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                        <?php } ?>
                        </select>
                          </div>
                        </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                            <label  class="form-label"
                              >Select Student</label
                            >
                            <?php 
                        $students = getStudents($con);
                        ?>
                        <select
                          name="student_id"
                          class="form-control"
                          
                        >
                        <option value = "">Please select </option>
                        <?php while($row = $students->fetch_assoc()){ ?>
                        <option value = "<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                        </select>
                          </div>
                        </div>
                  
                  
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label"
                                  >Loan Date</label
                                >
                                <input
                                  type="date"
                                  class="form-control"
                                  name = "loan_date"
                                  
                                />
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label  class="form-label"
                                  >Return/Due Date</label
                                >
                                <input
                                  type="date"
                                  class="form-control"
                                  name = "return_date"
                                  
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

