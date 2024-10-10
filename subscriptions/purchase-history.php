<?php

include_once("../config/config.php");
include_once("../config/database.php");
include_once(dir_url . "include/middleware.php");
include_once(dir_url . "models/subscription.php");


//  Create Subscriptions functionality

if (isset($_POST['submit'])) 
{
        $res = createSubscription($con, $_POST);

        if (isset($res['success'])) {
            $_SESSION['success'] = "Subscribed To the Plan";
            header("LOCATION:" . base_url . "subscriptions/purchase-history.php");
            exit;
        } else {
            $_SESSION['error'] = $res['error'];
            header("LOCATION:" . base_url . "subscriptions/purchase-history.php");
            exit;
        }
} 

//  get Purchase History
$from ="";
if(isset($_GET['from'])){
    $from =$_GET['from'];
}

$to ="";
if(isset($_GET['to'])){
    $to =$_GET['to'];
}


$purchaseHistory = getPurchaseHistory($con,$from,$to);



include_once(dir_url . "include/header.php");
include_once(dir_url . "include/topbar.php");
include_once(dir_url . "include/sidebar.php");

?>



<!-- Main Content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- cards -->
        <div class="row dashboard-counts">

            <div class="col-md-12">
                <?php include_once(dir_url . "include/alerts.php");   ?>
                <h4 class="fw-bold text-uppercase">Purchase History
                    <button type="button" style="float: right;" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create Subscription
                    </button>

                </h4>

            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Subscription Purchase History </div>
                    <div class="card-body">
                        <!-- Search Form -->
                        <form method="get">
                        <div class="row mb-3">
                            
                            <div class="col-md-12">
                                <h4 class="fw-bold text-uppercase">Search</h4>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">From</label>
                                <input type="date" class="form-control" name="from" value="<?php echo $from ?>"/>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">To</label>
                                <input type="date" class="form-control" name="to" value="<?php echo $to ?>"/>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-secondary btn-primary text-white" name="search" type="submit" style="margin-top: 32px;">
                                    Search
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <!-- Table -->
                    <table id = "example" class="table table-striped table-responsive">
                        <thead class="table">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if($purchaseHistory -> num_rows >0){
                              $i=1;
                              while($row = $purchaseHistory->fetch_assoc()){
                          ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>

                                <td><?php echo $row['student_name'] ?></td>
                                <td>
                                <span class="badge text-bg-info me-1" ><?php echo $row['plan_name'] ?></span>
                                    <i class="fa-solid fa-indian-rupee-sign me-2"></i> 
                                    <?php echo $row['amount'] ?>
                                </td>
                                <td><?php echo date("d-m-Y",strtotime($row['start_date'])) ?></td>
                                <td><?php echo date("d-m-Y",strtotime($row['end_date'])) ?></td>
                                <td>
                                    <?php 
                                        $today = date("Y-m-d");
                                        if($today <= $row['end_date']){
                                    ?>
                                    <span class="badge text-bg-success">Active</span>
                                    <?php }else{ ?>
                                    <span class="badge text-bg-danger">Expired</span>
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
</main>
<!-- Main Content end -->
<?php include_once(dir_url . "include/footer.php"); ?>

<!-- Model To Create Subscription -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Subscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url ?>subscriptions/purchase-history.php">

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Select Student</label>
                                <?php
                                $students = getStudents($con);
                                ?>
                                <select name="student_id" class="form-control">
                                    <option value="">Please select </option>
                                    <?php while ($row = $students->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Select Plan</label>
                                <?php
                                $plans = getPlans($con);
                                ?>
                                <select name="plan_id" class="form-control">
                                    <option value="">Please select </option>
                                    <?php while ($row = $plans->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                    </div>
            

                    <div class="col-md-12">
                      <button name="submit" type="submit" class="btn btn-success">
                    Save
                    </button>
                     <a href="<?php echo base_url ?>students" class="btn btn-secondary">
                        Cancel
                        </a>
                        </div>

                     </div>
                </form>
           
                
</div>
</div>
</div>