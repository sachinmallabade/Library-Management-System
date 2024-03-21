<?php


//function to store book

function storeBook($con,$param){
    extract($param);
    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO books (title,author,publication_year,isbn,category_id)
      VALUES ('$title','$author','$publication_year','$isbn',$category_id)";
        return $con->query($sql);
    }
     

//function to get categories

function getCategories($con){
$sql="select id,name from categories";
$result = $con->query($sql);
return $result;
}

//function to get all books
function getBooks($con)
{
  $sql = "select b.*,c.name as cat_name from books b left join categories c on c.id = b.category_id order by id desc";
  $result = $con->query($sql);
  return $result;
}
 

// function to delete book 

function deleteBook($con,$id)
{
  $sql = "delete from books where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update book status
function updateBookStatus($con,$id,$status)
{
  $sql = "update books set status = $status where id = $id";
  $result = $con->query($sql);
  return $result;
}


// function to get detail
function getBookById($con,$id)
{
  $sql = "select * from books where id = $id";
  $result = $con->query($sql);
  return $result;
}

// function to update book
function updateBook($con,$param){
  extract($param);
  $datetime = date("Y-m-d H:i:s");
  $sql = "UPDATE books SET title = '$title',
   author = '$author',
   publication_year ='$publication_year',
   isbn = '$isbn',
   category_id = '$category_id',
   updated_at = '$datetime'
   WHERE id = $id ";
  return $con->query($sql);
  }