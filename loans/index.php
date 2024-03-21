<?php 

 include_once("../config/config.php");
 include_once("../config/database.php");
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/loan.php"); 


//  get loans
 $loans = getLoans($con);
 

//  delete loans
if(isset($_GET['action'])&&$_GET['action']=='delete')
{
  $del = deleteLoan($con,$_GET['id']);
  if($del)
  {
    $_SESSION['success'] = "Book Loan has been Deleted Successfully";
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."loans");
  exit;
}

//  status updation of book
if(isset($_GET['action'])&&$_GET['action']=='status')
{
  $del = updateReturnStatus($con,$_GET['id'],$_GET['status']);
  if($del)
  {
    if($_GET['status']==1){
      $msg = "Book has been Returned";
    }
    else{
      $msg = "Book has not been Returned";
    }
    $_SESSION['success'] = $msg;
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."loans");
  exit;
}
 
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
            <h4 class="fw-bold text-uppercase">Manage Books Loans</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">All Books Loans</div>

                <div class="card-body">
                    <table id="example" class="table table-striped table-responsive" style="width:100%">
                        <thead class="table">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Loan Date</th>
                            <th scope="col">Return Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if($loans -> num_rows >0){
                              $i=1;
                              while($row = $loans->fetch_assoc()){
                          ?>
                          
                          <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            
                            <td><?php echo $row['book_title'] ?></td>
                            <td><?php echo $row['student_name'] ?></td>
                            <td><?php echo date("d-m-Y ",strtotime($row['loan_date'])) ?></td>
                            <td><?php echo date("d-m-Y ",strtotime($row['return_date'])) ?></td>
                           
                            <td>
                              <?php 
                              if($row['is_return']==1) {
                                echo "<span class='badge text-bg-success'>Returned</span>";
                              }
                              else {
                                echo "<span class='badge text-bg-warning'>Not returned</span>";
                              }
                              ?>
                            </td>
                            <td><?php echo date("d-m-Y h:i A",strtotime($row['created_at'])) ?></td>

                            <td><a href="<?php echo base_url?>loans/edit-loan.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>

                            <a onclick = "return confirm('Do You To Delete Record')" href="<?php echo base_url?>loans?action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            <?php 
                              if($row['is_return']==0) { ?>
                            <a href="<?php echo base_url?>loans?action=status&id=<?php echo $row['id'] ?>&status=1" class="btn btn-success btn-sm">Returned</a>
                            <?php } ?>

                            <!-- <?php 
                              if($row['is_return']==1) { ?>
                            <a href="<?php echo base_url?>loans?action=status&id=<?php echo $row['id'] ?>&status=0" class="btn btn-warning btn-sm">Not Returned</a>
                            <?php } ?> -->
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

