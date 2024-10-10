<?php 

 include_once("config/config.php");
 include_once("config/database.php");
 include_once(dir_url . "include/middleware.php");
 include_once(dir_url ."models/dashboard.php");

$counts = getCounts($con);
$tabs = getTabData($con);
 
 include_once(dir_url ."include/header.php"); 
 include_once(dir_url ."include/topbar.php"); 
 include_once(dir_url ."include/sidebar.php"); ?>
 <!-- Main Content start -->
 <main class="mt-1 pt-3">
   <div class="container-fluid">
     <!-- cards -->
     <div class="row dashboard-counts">
       <div class="col-md-12">
         <h4 class="fw-bold text-uppercase">Dashboard</h4>
         <p>Statistics of the System</p>
       </div>

       <div class="col-md-3">
         <div class="card" style="width: 18rem">
           <div class="card-body text-center">
             <h5 class="card-title text-uppercase text-muted">
               Total Books
             </h5>
             <h1><?php echo $counts['total_books'] ?></h1>
             <a href="<?php echo base_url?>books" class="card-link link-underline-light">View more</a>
           </div>
         </div>
       </div>

       <div class="col-md-3">
         <div class="card" style="width: 18rem">
           <div class="card-body text-center">
             <h5 class="card-title text-uppercase text-muted">
               Total Students
             </h5>
             <h1><?php echo $counts['total_students'] ?></h1>
             <a href="<?php echo base_url?>students" class="card-link link-underline-light">View more</a>
           </div>
         </div>
       </div>

       <div class="col-md-3">
         <div class="card" style="width: 18rem">
           <div class="card-body text-center">
             <h5 class="card-title text-uppercase text-muted">
               Total Revenue
             </h5>
             <h1><?php echo $counts['total_amount'] ?></h1>
             <a href="<?php echo base_url?>subscriptions/purchase-history.php" class="card-link link-underline-light">View more</a>
           </div>
         </div>
       </div>

       <div class="col-md-3">
         <div class="card" style="width: 18rem">
           <div class="card-body text-center">
             <h5 class="card-title text-uppercase text-muted">
               Total Books Loan
             </h5>
             <h1><?php echo $counts['total_loans'] ?></h1>
             <a href="<?php echo base_url?>loans" class="card-link link-underline-light">View more</a>
           </div>
         </div>
       </div>
     </div>

     <!-- tabs -->
     <div class="row mt-5 dashboard-tabs">
       <div class="col-md-12">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
           <li class="nav-item" role="presentation">
             <button
               class="nav-link active text-uppercase"
               id="home-tab"
               data-bs-toggle="tab"
               data-bs-target="#home-tab-pane"
               type="button"
               role="tab"
               aria-controls="home-tab-pane"
               aria-selected="true"
             >
               New Students
             </button>
           </li>
           <li class="nav-item" role="presentation">
             <button
               class="nav-link text-uppercase"
               id="profile-tab"
               data-bs-toggle="tab"
               data-bs-target="#profile-tab-pane"
               type="button"
               role="tab"
               aria-controls="profile-tab-pane"
               aria-selected="false"
             >
               Recent Loans
             </button>
           </li>
           <li class="nav-item" role="presentation">
             <button
               class="nav-link text-uppercase"
               id="contact-tab"
               data-bs-toggle="tab"
               data-bs-target="#contact-tab-pane"
               type="button"
               role="tab"
               aria-controls="contact-tab-pane"
               aria-selected="false"
             >
               Recent Subscriptions
             </button>
           </li>
         </ul>
         <div class="tab-content" id="myTabContent">
           <div
             class="tab-pane fade show active"
             id="home-tab-pane"
             role="tabpanel"
             aria-labelledby="home-tab"
             tabindex="0"
           >
             <table class="table">
               <thead class="table-dark">
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Email Id</th>
                   <th scope="col">Phone No</th>
                   <th scope="col">Address</th>
                   <th scope="col">Created At</th>
                 </tr>
               </thead>
               <tbody>
                <?php
                    $i = 1 ;
                    foreach($tabs['students'] as $row) {
                ?>
                 <tr>
                   <th scope="row"><?php echo $i++ ?></th>
                   
                   <td><?php echo $row['name'] ?></td>
                   <td><?php echo $row['email'] ?></td>
                   <td><?php echo $row['phone_no'] ?></td>
                   <td><?php echo $row['address'] ?></td>
                   <td><?php echo date("d-m-Y h:i A",strtotime($row['created_at'])) ?></td>
                 </tr>

                 <?php }?>
               
               </tbody>
             </table>
           </div>

           <div
             class="tab-pane fade"
             id="profile-tab-pane"
             role="tabpanel"
             aria-labelledby="profile-tab"
             tabindex="0"
           >
           <table class="table">
             <thead class="table-dark">
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">Book Name</th>
                 <th scope="col">Student Name</th>
                 <th scope="col">Loan Date</th>
                 <th scope="col">Due Date</th>
                 <th scope="col">Created At</th>
                 <th scope="col">Status</th>
               </tr>
             </thead>
             <tbody>
             <?php
                    $i = 1 ;
                    foreach($tabs['loans'] as $row) {
                ?>
               <tr>
                 <th scope="row"><?php echo $i++?></th>
                 
                 <td><?php echo $row['book_title'] ?></td>
                 <td><?php echo $row['student_name'] ?></td>
                 <td><?php echo date("d-m-Y h:i A",strtotime($row['loan_date'])) ?></td>
                 <td><?php echo date("d-m-Y h:i A",strtotime($row['return_date'])) ?></td>
                 <td><?php echo date("d-m-Y h:i A",strtotime($row['created_at'])) ?></td>
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
               </tr>
            <?php } ?>
             
             </tbody>
           </table>
           </div>
           <div
             class="tab-pane fade"
             id="contact-tab-pane"
             role="tabpanel"
             aria-labelledby="contact-tab"
             tabindex="0"
           >
           <table class="table">
             <thead class="table-dark">
                
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
                    $i = 1 ;
                    foreach($tabs['subscriptions'] as $row) {
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
                <?php } ?>
             
             
             </tbody>
           </table>
           </div>
           <div
             class="tab-pane fade"
             id="disabled-tab-pane"
             role="tabpanel"
             aria-labelledby="disabled-tab"
             tabindex="0"
           >
             ...
           </div>
         </div>
       </div>
     </div>
   </div>
 </main>
 <!-- Main Content end -->
 <?php include_once(dir_url ."include/footer.php"); ?>