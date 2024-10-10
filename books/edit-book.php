<?php 

 include_once("../config/config.php");
 include_once( dir_url ."config/database.php"); 
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/book.php"); 


 
 //  Update book functionality

if(isset($_POST['update'])){
  $res = updateBook($con,$_POST);
  if($res == true){
    $_SESSION['success'] = "Book has been Updated successfully";
    header("LOCATION:" .base_url."books");
  }else{
    $_SESSION['error'] = "Something went wrong,please try again";
    header("LOCATION:" .base_url."books/edit-book.php");
    exit;
  } 
}

//  Read get parameter to get book data
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $book = getBookById($con,$_GET['id']);
    if($book->num_rows > 0)
    {
        $book = mysqli_fetch_assoc($book);
    }
}
else{
    header("LOCATION: " . base_url . "books");
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
            <h4 class="fw-bold text-uppercase">Edit Book</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Fill the form</div>

                <div class="card-body">
                  <form method="post" action="<?php echo base_url?>books/edit-book.php">
                        <input type="hidden" name="id" value="<?php echo $book['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                  >Book Title</label
                                >
                                <input
                                  type="text"
                                  name="title"
                                  class="form-control"
                                  id="exampleInputEmail1"
                                  aria-describedby="emailHelp"
                                  value="<?php echo $book['title'] ?>"
                                  required
                                />
                                
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"
                              >ISBN Number</label
                            >
                            <input
                              type="text"
                              name="isbn"
                              class="form-control"
                              id="exampleInputPassword1"
                              value="<?php echo $book['isbn'] ?>"
                              required
                            />
                          </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"
                                  >Author Name</label
                                >
                                <input
                                  type="text"
                                  name="author"
                                  class="form-control"
                                  id="exampleInputPassword1"
                                  value="<?php echo $book['author'] ?>"
                                  required
                                />
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"
                                  >Publication Year</label
                                >
                                <input
                                  type="number"
                                  name="publication_year"
                                  class="form-control"
                                  id="exampleInputPassword1"
                                  value="<?php echo $book['publication_year'] ?>"
                                  required
                                />
                              </div>
                        </div>

                        <div class="col-md-6">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"
                          >Category/Course</label
                        >
                        <?php 
                        $cats = getCategories($con);
                        ?>
                        <select
                          name="category_id"
                          class="form-control"
                          
                          required
                        >
                        <option value = "">Please select </option>
                        <?php
                            $selected = ""; 
                            while($row = $cats->fetch_assoc()){ 
                                if($row['id']==$book['category_id'])
                                    $selected = "selected";
                        ?>
                        <option <?php echo $selected ?> value = "<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>

                    </div>
                    </div>
                    <div class="col-md-12">
                    <button name="update" type="submit" class="btn btn-success">
                      Update
                    </button>
                    <a href = "<?php echo base_url?>books" class="btn btn-secondary">
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

