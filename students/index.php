<?php 

 include_once("../config/config.php");
 include_once("../config/database.php");
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/Student.php"); 


//  get Students
 $Students = getStudents($con);

//  delete Students
if(isset($_GET['action'])&&$_GET['action']=='delete')
{
  $del = deleteStudent($con,$_GET['id']);
  if($del)
  {
    $_SESSION['success'] = "Student has been Deleted Successfully";
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."Students");
  exit;
}

//  status updation of Student

 
 include_once(dir_url ."include/header.php"); 
 include_once(dir_url ."include/topbar.php"); 
 include_once(dir_url ."include/sidebar.php"); 
 
 ?>



    <!-- Main Content start -->
    <main class="mt-1 pt-3">
      <div class="container-fluid">
        <!-- cards -->
        <div class="row dashboard-counts">
          <div class="col-md-12">
            <?php  include_once(dir_url ."include/alerts.php");  ?>
            <h4 class="fw-bold text-uppercase">Manage Students</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">All Students</div>

                <div class="card-body">
                    <table id="example" class="table table-striped table-responsive" style="width:100%">
                        <thead class="table">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Email Id</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Address</th>
                            
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if($Students -> num_rows >0){
                              $i=1;
                              while($row = $Students->fetch_assoc()){
                          ?>
                          <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['phone_no'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                              
                            <td><?php echo date("d-m-Y h:i A",strtotime($row['created_at'])) ?></td>

                            <td><a href="<?php echo base_url?>Students/edit-Student.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>

                            <a onclick = "return confirm('Do You To Delete Record')" href="<?php echo base_url?>Students?action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                           
                          </td>
                          </tr>
                            <?php }}?>
                        
                        </tbody>
                      </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Main Content end -->
    <?php include_once(dir_url ."include/footer.php"); ?>

