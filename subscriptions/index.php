<?php 

 include_once("../config/config.php");
 include_once("../config/database.php");
 include_once(dir_url . "include/middleware.php");
 include_once( dir_url ."models/subscription.php"); 


  //  Add Subscriptions functionality

if(isset($_POST['submit'])){
    if($_POST['id'] == '')
    {
    $res = storeSubscription($con,$_POST);
    
    if(isset($res['success'])){
      $_SESSION['success'] = "Subscription has been created Successfully";
      header("LOCATION:" .base_url."subscriptions");
      exit;
    }else{
      $_SESSION['error'] = $res['error'];
      header("LOCATION:" .base_url."subscriptions");
      exit;
    } 
    }
    else
    { 
        $res = updatePlan($con,$_POST);

        if(isset($res['success'])){
          $_SESSION['success'] = "Plan has been Updated successfully";
          header("LOCATION:" .base_url."subscriptions");
          exit;
        }else{
          $_SESSION['error'] = $res['error'];
          header("LOCATION:" .base_url."subscriptions");
          exit;
        
      }
    }
}

//  get subscriptions
 $subs = getSubscriptions($con);

//  delete subscriptions
if(isset($_GET['action'])&&$_GET['action']=='delete')
{
  $del = deleteSubscriptions($con,$_GET['id']);
  if($del)
  {
    $_SESSION['success'] = "Subscription Record has been Deleted Successfully";
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."subscriptions");
  exit;
}

//  status updation of Plan
if(isset($_GET['action'])&&$_GET['action']=='status')
{
  $del = updatePlanStatus($con,$_GET['id'],$_GET['status']);
  if($del)
  {
    if($_GET['status']==1){
      $msg = "Plan has been Activated Successfully";
    }
    else{
      $msg = "Plan has been Dectivated Successfully";
    }
    $_SESSION['success'] = $msg;
  }
  else{
    $_SESSION['error'] = "Something went wrong!!";
  }
  header("LOCATION: " .base_url."subscriptions");
  exit;
}

//  Updation of Plan
if(isset($_GET['action'])&&$_GET['action']=='edit' && isset($_GET['id']) && $_GET['id'] > 0)
{
    $plan = getPlanById($con,$_GET['id']);
    if($plan->num_rows > 0)
    {
        $plan = mysqli_fetch_assoc($plan);
    }
    
}
else
{
    $plan = array('title' => '' , 'id' => '','amount' => '');
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
          <?php  include_once(dir_url ."include/alerts.php");   ?>
            <h4 class="fw-bold text-uppercase">Subscription Plan</h4>
          </div>


          <div class="col-md-8">
             <div class="card">
                 <div class="card-header">All Plans</div>
                     <div class="card-body">
                        <table id="example"  class="table table-striped table-responsive">
                        <thead class="table">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Status</th>
                            
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if($subs -> num_rows >0){
                              $i=1;
                              while($row = $subs->fetch_assoc()){
                          ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?php echo $row['title'] ?></td>
                            <td><i class="fa-solid fa-indian-rupee-sign me-2"></i><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['duration'] ?> months</td>
                            <td>
                              <?php 
                              if($row['status']==1) {
                                echo "<span class='badge text-bg-success'>Active</span>";
                              }
                              else {
                                echo "<span class='badge text-bg-warning'>Inactive </span>";
                              }
                              ?>
                            </td>
                            <td><?php echo date("d-m-Y h:i A",strtotime($row['created_at'])) ?></td>

                            <td>
                              <a href="<?php echo base_url?>subscriptions?action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>

                            <a onclick = "return confirm('Do You To Delete Record')" href="<?php echo base_url?>subscriptions?action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            <?php 
                              if($row['status']==0) { ?>
                            <a href="<?php echo base_url?>subscriptions?action=status&id=<?php echo $row['id'] ?>&status=1" class="btn btn-success btn-sm">Active</a>
                            <?php } ?>

                             <?php 
                              if($row['status']==1) { ?>
                            <a href="<?php echo base_url?>subscriptions?action=status&id=<?php echo $row['id'] ?>&status=0" class="btn btn-warning btn-sm">Inactive</a>
                            <?php } ?> 
                              </td>

                          </tr>
                          <?php }}?>
                        </tbody>
                      </table>
                     </div>
                </div>
          </div>
        
          
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Fill the form</div>
                        <div class="card-body">
                
                  <form method="post" action="<?php echo base_url?>subscriptions/index.php">
                  <input type="hidden" name="id" value="<?php echo $plan['id'] ?>">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label  class="form-label"
                                  >Title</label
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  aria-describedby="emailHelp"
                                  name = "title"
                                  value="<?php echo $plan['title'] ?>"
                                />
                                
                              </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                            <label  class="form-label"
                              >Amount</label
                            >
                            <input
                              type="text"
                              class="form-control"
                              name = "amount"
                              value="<?php echo $plan['amount'] ?>"
                            />
                          </div>
                        </div>
                    
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label  class="form-label"
                                    >Duration</label>
                                <select
                                class="form-control"
                                name="duration"
                                
                                >
                                 <option value = "">Please select </option>
                                 <?php 
                                
                                 for($i = 1;$i < 13;$i++){
                                    $selected = "";
                                    if($i == $plan['duration'])
                                        $selected = "selected";

                                    ?>
                                 <option <?php echo $selected ?> value = "<?php echo $i ?>"><?php echo $i ?> month(s) </option>
                                <?php }?>
                                </select>
                             </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-success">
                        Save
                        </button>

                        <?php if($plan['id'] == ''){ ?>
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
                        <?php }else {?>
                          <a href="<?php echo base_url?>subscriptions/index.php" class="btn btn-secondary">
                            Cancel
                        </a>
                        <?php }?>
                    </div>
                </form>
                        </div>
                </div>
            </div>
     
            
        </div>
      </div>   
    </main>
    <!-- Main Content end -->
    <?php include_once(dir_url ."include/footer.php"); ?>

