<?php 
include 'db.php';
session_start();
  
  //validasi role (staff and admin only)
  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }
  else{//sudah login
    //jika member
    if($_SESSION['member']['role_member']!== 'staff' AND $_SESSION['member']['role_member']!== 'admin'){
      header("location:index.php");
    }
  }

  $id_category = $_GET['id'];
  $result= $conn->query("SELECT * FROM category WHERE id_category = '$id_category'");
  $row=$result->fetch_assoc();
  $image_name_old= $row['image_category'];
    if(file_exists("assets/image_category/$image_name_old")){                  
      unlink("assets/image_category/$image_name_old");       
    }
  $delete= $conn->query("DELETE FROM category WHERE id_category = '$id_category'");
  if($delete){
    echo "<script>alert('category berhasil dihapus');</script>";
    echo "<script>location='mcategory.php';</script>";
  }
  else{
    $conn->error;
  }
?>