<?php


//function to store subscription details

function storeSubscription($con,$param){
    extract($param);

    // validation
    if(empty($title))
    {
        $result = array("error" => "Title is Required" );
        return $result;
    }else if(empty($amount))
    {
        $result = array("error" => "Amount is Required");
        return $result;
    }else if(empty($duration))
    {
        $result = array("error" => "Duration is Required");
        return $result;
    }


    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO subscription_plans (title,amount,duration)
      VALUES ('$title',$amount,$duration)";
        $result['success'] =  $con->query($sql);
        return $result;
    }
     

//function to get Subscriptions

function getSubscriptions($con){
$sql="select * from subscription_plans";
$result = $con->query($sql);
return $result;
}


// function to delete book 

function deleteSubscriptions($con,$id)
{
  $sql = "delete from subscription_plans where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update book status
function updatePlanStatus($con,$id,$status)
{
  $sql = "update subscription_plans set status = $status where id = $id";
  $result = $con->query($sql);
  return $result;
}


// function to get Plan detail
function getPlanById($con,$id)
{
  $sql = "select * from subscription_plans where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update plan
function updatePlan($con,$param){
    extract($param);

    // validation
    if(empty($title))
    {
        $result = array("error" => "Title is Required" );
        return $result;
    }else if(empty($amount))
    {
        $result = array("error" => "Amount is Required");
        return $result;
    }else if(empty($duration))
    {
        $result = array("error" => "Duration is Required");
        return $result;
    }



  $datetime = date("Y-m-d H:i:s");
  $sql = "UPDATE subscription_plans SET 
    title = '$title',
   amount = '$amount',
   duration ='$duration',
   updated_at = '$datetime'
   WHERE id = $id ";
  $result['success'] =  $con->query($sql);
  return $result;
  }

  function getStudents($con)
  {
    $sql="select id,name from students";
    $result = $con->query($sql);
    return $result; 
  }

  
  function getPlans($con)
  {
    $sql="select id,title from subscription_plans where status = 1";
    $result = $con->query($sql);
    return $result; 
  }

// function to create subscription by plan id and student id
  function createSubscription($con , $param)
  {
    extract($param);

    // validation
    if(empty($plan_id))
    {
        $result = array("error" => "Plan Selection is Required" );
        return $result;
    }else if(empty($student_id))
    {
        $result = array("error" => "Student Selection is Required");
        return $result;
    }


    $datetime = date("Y-m-d H:i:s");
    $start_date = date("Y-m-d");
    $end_date = date("Y-m-d");

  //  get duration from subscription_plans table
    $plan = getPlanById($con,$plan_id);
    if($plan -> num_rows > 0){
      $plan = mysqli_fetch_assoc($plan);
      $duration = $plan['duration'];

       // start date and end date calculation
      $start_time = strtotime($start_date);
      $end_date = date("Y-m-d",strtotime("+$duration month" , $start_time));
      $amount = $plan['amount'];

      $sql = "INSERT INTO subscriptions (student_id,plan_id,start_date,end_date,amount)
      VALUES ($student_id,$plan_id,'$start_date','$end_date',$amount)";
      $result['success'] =  $con->query($sql);
      return $result;
    }
    else{
      $result = array("error" => "Invalid Plan Selection");
        return $result;
    }
  }

  // function to get list of all plans subscribed by students

  function getPurchaseHistory($con,$from,$to){
    $sql="select s.*,p.title as plan_name , st.name as student_name ,p.amount as plan_amount
          from subscriptions s
          inner join subscription_plans p on p.id = s.plan_id
          inner join students st on st.id = s.student_id where s.id != 0";

    if(!empty($from))
    {
        $sql .= " AND s.start_date >= '$from' ";
    }

    if(!empty($to))
    {
        $sql .= " AND s.end_date <= '$to' ";
    }
    $sql .= " order by s.id desc";

    $result = $con->query($sql);
    return $result;
    }