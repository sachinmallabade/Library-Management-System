<?php


//function to store book

function storeLoan($con,$param){
    extract($param);

    // validation
    if(empty($book_id))
    {
        $result = array("error" => "Book Selection is Required" );
        return $result;
    }else if(empty($student_id))
    {
        $result = array("error" => "Student Selection is Required");
        return $result;
    }



    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO book_loans (book_id,student_id,loan_date,return_date)
      VALUES ($book_id,$student_id,'$loan_date','$return_date')";
        $result['success'] =  $con->query($sql);
        return $result;
    }
     

//function to get students

function getStudents($con){
$sql="select id,name from students";
$result = $con->query($sql);
return $result;
}


//function to get books

function getBooks($con){
    $sql="select id,title from books";
    $result = $con->query($sql);
    return $result;
    }


//function to get all Loans
function getLoans($con)
{
  $sql =  $sql = "select l.*, b.title as book_title, s.name as student_name 
  from book_loans l
  inner join books b on b.id = l.book_id
  inner join students s on s.id = l.student_id
  order by l.id desc;
";;

  $result = $con->query($sql);
  

  return $result;
}
 

// function to delete book 

function deleteLoan($con,$id)
{
  $sql = "delete from book_loans where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update book status
function updateReturnStatus($con,$id,$status)
{
  $sql = "update book_loans set is_return = $status where id = $id";
  $result = $con->query($sql);
  return $result;
}


// function to get detail
function getLoanById($con,$id)
{
  $sql = "select * from book_loans where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update loan
function updateLoan($con,$param){
    extract($param);

    // validation
    if(empty($book_id))
    {
        $result = array("error" => "Book Selection is Required" );
        return $result;
    }else if(empty($student_id))
    {
        $result = array("error" => "Student Selection is Required");
        return $result;
    }



  $datetime = date("Y-m-d H:i:s");
  $sql = "UPDATE book_loans SET 
    book_id = '$book_id',
   student_id = '$student_id',
   loan_date ='$loan_date',
   return_date = '$return_date',
   updated_at = '$datetime'
   WHERE id = $id ";
  $result['success'] =  $con->query($sql);
  return $result;
  }