<?php 

 include_once("../config/config.php");
 include_once("../config/database.php");
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/book.php"); 


//  get books
 $books = getBooks($con);

//  delete books
if(isset($_GET['action'])&&$_GET['action']=='delete')
{
  $del = deleteBook($con,$_GET['id']);
  if($del)
  {
    $_SESSION['success'] = "Book has been Deleted Successfully";
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."books");
  exit;
}

//  status updation of book
if(isset($_GET['action'])&&$_GET['action']=='status')
{
  $del = updateBookStatus($con,$_GET['id'],$_GET['status']);
  if($del)
  {
    if($_GET['status']==1){
      $msg = "Book has been Successfully activated";
    }
    else{
      $msg = "Book has been Successfully deactivated";
    }
    $_SESSION['success'] = $msg;
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."books");
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
            <h4 class="fw-bold text-uppercase">Manage Books</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">All Books</div>

                <div class="card-body">
                    <table id="example" class="table table-striped table-responsive" style="width:100%">
                        <thead class="table">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Publication Year</th>
                            <th scope="col">Author Name</th>
                            <th scope="col">ISBN No</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if($books -> num_rows >0){
                              $i=1;
                              while($row = $books->fetch_assoc()){
                          ?>
                          <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['publication_year'] ?></td>
                            <td><?php echo $row['author'] ?></td>
                            <td><?php echo $row['isbn'] ?></td>
                            <td><?php echo $row['cat_name'] ?></td>
                            <td>
                              <?php 
                              if($row['status']==1) {
                                echo "<span class='badge text-bg-success'>Active</span>";
                              }
                              else {
                                echo "<span class='badge text-bg-warning'>Inactive</span>";
                              }
                              ?>
                            </td>
                            <td><?php echo date("d-m-Y h:i A",strtotime($row['created_at'])) ?></td>

                            <td><a href="<?php echo base_url?>books/edit-book.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>

                            <a onclick = "return confirm('Do You To Delete Record')" href="<?php echo base_url?>books?action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            <?php 
                              if($row['status']==0) { ?>
                            <a href="<?php echo base_url?>books?action=status&id=<?php echo $row['id'] ?>&status=1" class="btn btn-success btn-sm">Active</a>
                            <?php } ?>

                            <?php 
                              if($row['status']==1) { ?>
                            <a href="<?php echo base_url?>books?action=status&id=<?php echo $row['id'] ?>&status=0" class="btn btn-warning btn-sm">Inactive</a>
                            <?php } ?>
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

