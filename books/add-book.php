<?php 

 include_once("../config/config.php");
 include_once( dir_url ."config/database.php");
 include_once(dir_url . "include/middleware.php"); 
 include_once( dir_url ."models/book.php"); 

 
 //  Add book functionality

if(isset($_POST['publish'])){
  $res = storeBook($con,$_POST);
  if($res == true){
    $_SESSION['success'] = "Book has been created successfully";
    header("LOCATION:" .base_url."books");
  }else{
    $_SESSION['error'] = "Something went wrong,please try again";
    //header("LOCATION:" .base_url."books");
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
            <h4 class="fw-bold text-uppercase">Add Book</h4>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Fill the form</div>

                <div class="card-body">
                  <form method="post" action="<?php echo base_url?>books/add-book.php">

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
                        <?php while($row = $cats->fetch_assoc()){ ?>
                        <option value = "<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <button name="publish" type="submit" class="btn btn-success">
                      Publish
                    </button>
                    <a href = "<?php echo base_url?>books" class="btn btn-secondary">
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

