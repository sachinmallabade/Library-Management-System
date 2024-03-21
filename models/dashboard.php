<?php


//function to get categories

function getCategories($con){
$sql="select id,name from categories";
$result = $con->query($sql);
return $result;
}



//function to get system counts
function getCounts($con)
{
  $counts = array(
    'total_books' => 0,
    'total_students' => 0,
    'total_loans' => 0,
    'total_amount' => 0
  );

//   get book count
  $sql = "select count(id) as total_books from books";
  $result = $con->query($sql);
  if($result->num_rows > 0){
    $books = mysqli_fetch_assoc($result);
    $counts['total_books'] = $books['total_books'];
  }

  //   get student count
  $sql = "select count(id) as total_students from students";
  $result = $con->query($sql);
  if($result->num_rows > 0){
    $books = mysqli_fetch_assoc($result);
    $counts['total_students'] = $books['total_students'];
  }

   //   get loan count
   $sql = "select count(id) as total_loans from book_loans";
   $result = $con->query($sql);
   if($result->num_rows > 0){
     $books = mysqli_fetch_assoc($result);
     $counts['total_loans'] = $books['total_loans'];
   }

   //   get total revenue
   $sql = "select sum(amount) as total_amount from subscriptions";
   $result = $con->query($sql);
   if($result->num_rows > 0){
     $books = mysqli_fetch_assoc($result);
     $counts['total_amount'] = $books['total_amount'];
   }

  return $counts;
}
 


// function to get detail of each tab
function getTabData($con)
{
  $tabs = array(

    'students' => array(),
    'loans' => array(),
    'subscriptions' => array()
  );


  //   get recent students 
  $sql = "select * from students order by id desc limit 5";
  $result = $con->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $tabs['students'][] = $row; 
    }
  }

  //   get recent loans 
  $sql = "select l.*, b.title as book_title, s.name as student_name 
  from book_loans l
  inner join books b on b.id = l.book_id
  inner join students s on s.id = l.student_id
  order by l.id desc limit 5";
  $result = $con->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $tabs['loans'][] = $row; 
    }
  }

  //   get recent subscriptions 
  $sql = "select s.*, p.title as plan_name, st.name as student_name 
  from subscriptions s
  inner join subscription_plans p on p.id = s.plan_id
  inner join students st on st.id = s.student_id 
  order by s.id desc limit 5";
  $result = $con->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $tabs['subscriptions'][] = $row; 
    }
  }


  return $tabs;
}


