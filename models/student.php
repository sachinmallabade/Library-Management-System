<?php


//function to store Student

function storeStudent($con,$param){
    extract($param);
    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO students ( name , phone_no , email , address)
      VALUES ('$name','$phone_no','$email','$address')";
        return $con->query($sql);
    }
     



//function to get all Students
function getStudents($con)
{
  $sql = "select * from students order by id desc";
  $result = $con->query($sql);
  return $result;
}
 

// function to delete Student 

function deleteStudent($con,$id)
{
  $sql = "delete from students where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update Student status



// function to get detail
function getStudentById($con,$id)
{
  $sql = "select * from students where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update Student
function updateStudent($con,$param){
  extract($param);
  $datetime = date("Y-m-d H:i:s");
  $sql = "UPDATE students SET 
   name = '$name',
   phone_no = '$phone_no',
   email ='$email',
   address = '$address',
   updated_at = '$datetime'
   WHERE id = $id ";
  return $con->query($sql);
  }